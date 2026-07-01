<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    /** Lesson list grouped by level, with per-lesson progress + level unlock state. */
    public function index()
    {
        $user = Auth::user();

        $lessons = Lesson::published()->orderBy('level')->orderBy('order')->get();
        $completedIds = $user->completedLessons()->pluck('lessons.id')->all();

        $byLevel = $lessons->groupBy('level');

        // A level is unlocked if it's level 1, or the previous level is fully completed.
        $unlocked = [1 => true, 2 => $user->hasCompletedLevel(1), 3 => $user->hasCompletedLevel(2)];

        return view('member.dashboard.materi', compact('byLevel', 'completedIds', 'unlocked'));
    }

    /** Video + intro for a single lesson. */
    public function video(string $slug)
    {
        $lesson = Lesson::published()->where('slug', $slug)->firstOrFail();
        $this->authorizeLevel($lesson);

        return view('member.dashboard.video', compact('lesson'));
    }

    /** Theory/reading for a single lesson, with the "start quiz" CTA. */
    public function theory(string $slug)
    {
        $lesson = Lesson::published()->where('slug', $slug)->firstOrFail();
        $this->authorizeLevel($lesson);

        return view('member.dashboard.teori', compact('lesson'));
    }

    /** Block access to a lesson whose level is still locked. */
    private function authorizeLevel(Lesson $lesson): void
    {
        $user = Auth::user();
        $unlocked = match ((int) $lesson->level) {
            1 => true,
            2 => $user->hasCompletedLevel(1),
            3 => $user->hasCompletedLevel(2),
            default => false,
        };

        abort_unless($unlocked, 403, 'Selesaikan level sebelumnya untuk membuka materi ini.');
    }
}
