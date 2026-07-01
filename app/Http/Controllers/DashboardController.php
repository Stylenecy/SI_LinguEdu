<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalLessons = Lesson::published()->count();
        $completed = $user->completedLessons()->count();
        $percent = $totalLessons > 0 ? (int) round($completed / $totalLessons * 100) : 0;
        $currentLevel = $this->currentLevel($user);

        return view('member.dashboard.index', compact(
            'user', 'totalLessons', 'completed', 'percent', 'currentLevel'
        ));
    }

    public function laporan()
    {
        $user = Auth::user();

        $totalLessons = Lesson::published()->count();
        $completedLessons = $user->lessons()
            ->wherePivot('completed', true)
            ->orderByPivot('completed_at', 'desc')
            ->get();
        $completed = $completedLessons->count();
        $percent = $totalLessons > 0 ? (int) round($completed / $totalLessons * 100) : 0;
        $avgScore = (int) round($user->lessons()->wherePivot('completed', true)->avg('score') ?? 0);
        $currentLevel = $this->currentLevel($user);

        return view('member.dashboard.laporan', compact(
            'user', 'totalLessons', 'completed', 'percent', 'avgScore', 'currentLevel', 'completedLessons'
        ));
    }

    /** Highest level fully completed + 1 (capped at 3); 1 if nothing done. */
    private function currentLevel($user): int
    {
        $level = 1;
        for ($l = 1; $l <= 3; $l++) {
            if ($user->hasCompletedLevel($l)) {
                $level = min($l + 1, 3);
            }
        }
        return $level;
    }
}
