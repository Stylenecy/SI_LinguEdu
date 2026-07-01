<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Lesson;
use App\Models\Package;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'users' => User::where('role', 'user')->count(),
            'lessons' => Lesson::count(),
            'questions' => Question::count(),
            'certificates' => Certificate::count(),
            'packages' => Package::where('is_active', true)->count(),
        ];

        $recentUsers = User::where('role', 'user')->latest()->take(5)->get();
        $lessonsByLevel = Lesson::selectRaw('level, count(*) as total')->groupBy('level')->pluck('total', 'level');

        return view('Admin.dashboard', compact('stats', 'recentUsers', 'lessonsByLevel'));
    }

    // ---------- Users ----------
    public function users()
    {
        $users = User::withCount(['lessons as completed_count' => fn ($q) => $q->wherePivot('completed', true)])
            ->orderBy('role')
            ->orderBy('name')
            ->get();

        return view('Admin.Pages.users', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'role' => ['required', 'in:user,admin'],
            'password' => ['required', 'min:6'],
        ]);

        User::create($data);

        return back()->with('status', 'User berhasil ditambahkan.');
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return back()->with('status', 'User dihapus.');
    }

    // ---------- Lessons (Materi) ----------
    public function materi()
    {
        $lessons = Lesson::withCount('questions')->orderBy('level')->orderBy('order')->get();
        return view('Admin.Pages.materi', compact('lessons'));
    }

    public function storeMateri(Request $request)
    {
        $data = $request->validate([
            'level' => ['required', 'integer', 'min:1', 'max:3'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'theory' => ['nullable', 'string'],
            'video_url' => ['nullable', 'string', 'max:255'],
            'image_url' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
        ]);

        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['order'] = $data['order'] ?? (Lesson::where('level', $data['level'])->max('order') + 1);
        Lesson::create($data);

        return back()->with('status', 'Materi berhasil ditambahkan.');
    }

    public function destroyMateri(Lesson $materi)
    {
        $materi->delete();
        return back()->with('status', 'Materi dihapus.');
    }

    // ---------- Quiz (Kuis) ----------
    public function kuis()
    {
        $lessons = Lesson::with('questions')->orderBy('level')->orderBy('order')->get();
        return view('Admin.Pages.kuis', compact('lessons'));
    }

    public function storeKuis(Request $request)
    {
        $data = $request->validate([
            'lesson_id' => ['required', 'exists:lessons,id'],
            'question' => ['required', 'string'],
            'option_a' => ['required', 'string', 'max:255'],
            'option_b' => ['required', 'string', 'max:255'],
            'option_c' => ['nullable', 'string', 'max:255'],
            'option_d' => ['nullable', 'string', 'max:255'],
            'correct_option' => ['required', 'in:a,b,c,d'],
            'explanation' => ['nullable', 'string', 'max:255'],
        ]);

        $data['order'] = Question::where('lesson_id', $data['lesson_id'])->max('order') + 1;
        Question::create($data);

        return back()->with('status', 'Soal kuis ditambahkan.');
    }

    public function destroyKuis(Question $kuis)
    {
        $kuis->delete();
        return back()->with('status', 'Soal dihapus.');
    }

    // ---------- Packages (Paket) ----------
    public function paket()
    {
        $packages = Package::orderBy('price')->get();
        return view('Admin.Pages.paket', compact('packages'));
    }

    public function storePaket(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'language' => ['required', 'string', 'max:255'],
            'duration_days' => ['required', 'integer', 'min:1'],
        ]);

        Package::create($data);

        return back()->with('status', 'Paket ditambahkan.');
    }

    public function destroyPaket(Package $paket)
    {
        $paket->delete();
        return back()->with('status', 'Paket dihapus.');
    }

    // ---------- Certificates (Sertifikasi) ----------
    public function sertifikasi()
    {
        $certificates = Certificate::with('user')->latest('issued_at')->get();
        return view('Admin.Pages.sertifikasi', compact('certificates'));
    }

    private function uniqueSlug(string $title): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;
        while (Lesson::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }
}
