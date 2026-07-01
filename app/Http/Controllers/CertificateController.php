<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $eligible = $user->hasCompletedLevel(3);
        $certificate = $user->certificates()->latest('issued_at')->first();
        $finalScore = (int) round($user->lessons()->wherePivot('completed', true)->avg('score') ?? 0);

        return view('member.dashboard.sertifikasi', compact('user', 'eligible', 'certificate', 'finalScore'));
    }

    /** Issue a certificate once all levels are completed. */
    public function issue()
    {
        $user = Auth::user();

        abort_unless($user->hasCompletedLevel(3), 403, 'Selesaikan semua level terlebih dahulu.');

        $certificate = $user->certificates()->latest('issued_at')->first();

        if (! $certificate) {
            $finalScore = (int) round($user->lessons()->wherePivot('completed', true)->avg('score') ?? 0);
            $certificate = Certificate::create([
                'user_id' => $user->id,
                'certificate_number' => 'LINGU-' . now()->format('Y') . '-' . strtoupper(Str::random(6)),
                'level' => 3,
                'final_score' => $finalScore,
                'issued_at' => now(),
            ]);
        }

        return redirect()->route('dashboard.sertifikasi')
            ->with('status', 'Selamat! Sertifikat kamu telah diterbitkan.');
    }
}
