<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    /** Show the quiz for a lesson. */
    public function show(string $slug)
    {
        $lesson = Lesson::published()->with('questions')->where('slug', $slug)->firstOrFail();

        if ($lesson->questions->isEmpty()) {
            return redirect()->route('member.theory', $lesson->slug)
                ->with('status', 'Materi ini belum memiliki kuis.');
        }

        return view('member.dashboard.kuis', compact('lesson'));
    }

    /** Grade the submission, persist progress, redirect to result. */
    public function submit(Request $request, string $slug)
    {
        $lesson = Lesson::published()->with('questions')->where('slug', $slug)->firstOrFail();
        $user = Auth::user();

        $answers = $request->input('answers', []); // [question_id => 'a'|'b'|...]
        $total = $lesson->questions->count();
        $correct = 0;
        $review = [];

        foreach ($lesson->questions as $q) {
            $given = $answers[$q->id] ?? null;
            $isCorrect = $given !== null && strtolower($given) === strtolower($q->correct_option);
            if ($isCorrect) {
                $correct++;
            }
            $review[] = [
                'question' => $q->question,
                'given' => $given,
                'correct' => $q->correct_option,
                'is_correct' => $isCorrect,
                'explanation' => $q->explanation,
            ];
        }

        $score = $total > 0 ? (int) round($correct / $total * 100) : 0;
        $passed = $score >= 70;

        // Persist progress: mark completed only when passed; always keep best score.
        $existing = $user->lessons()->where('lesson_id', $lesson->id)->first();
        $bestScore = max($score, $existing?->pivot->score ?? 0);
        $alreadyDone = (bool) ($existing?->pivot->completed ?? false);

        $user->lessons()->syncWithoutDetaching([
            $lesson->id => [
                'completed' => $alreadyDone || $passed,
                'score' => $bestScore,
                'completed_at' => ($alreadyDone || $passed) ? now() : null,
            ],
        ]);

        return view('member.dashboard.kuis-hasil', [
            'lesson' => $lesson,
            'score' => $score,
            'correct' => $correct,
            'total' => $total,
            'passed' => $passed,
            'review' => $review,
        ]);
    }
}
