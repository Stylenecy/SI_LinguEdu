@extends('dashboard.main')

@section('title', 'Materi Pembelajaran')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background-color: #f8f9fa;
    }
    .level-buttons {
        text-align: center;
        margin-bottom: 30px;
    }
    .level-buttons .btn {
        margin: 5px;
        border-radius: 25px;
        padding: 10px 25px;
    }
    .card {
        transition: transform .2s, box-shadow .2s;
        border-radius: 15px;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.15);
    }
    .locked {
        filter: grayscale(1);
        opacity: 0.6;
        cursor: not-allowed;
    }
    .progress {
        height: 8px;
        border-radius: 10px;
    }
</style>

<div class="container py-4">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary">🎓 Materi Pembelajaran</h2>
        <p class="text-muted mb-0">Selesaikan setiap materi di tiap level untuk membuka level berikutnya!</p>
    </div>

    <div class="level-buttons">
        <button class="btn btn-primary" id="btnLevel1">Level 1</button>
        <button class="btn btn-outline-secondary" id="btnLevel2" disabled>Level 2 🔒</button>
        <button class="btn btn-outline-secondary" id="btnLevel3" disabled>Level 3 🔒</button>
    </div>

    <!-- LEVEL 1 -->
    <div class="row" id="level1">
        @php
        $materiLevel1 = [
            ['title' => 'Introduction to Programming', 'desc' => 'Pengenalan dasar tentang logika dan konsep pemrograman.', 'img' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=800&q=80', 'progress' => 100],
            ['title' => 'Variables & Data Types', 'desc' => 'Mengenal tipe data dan cara menyimpan informasi.', 'img' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80', 'progress' => 100],
            ['title' => 'Operators & Expressions', 'desc' => 'Memahami cara kerja operator dan ekspresi dalam program.', 'img' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=800&q=80', 'progress' => 100],
            ['title' => 'Conditional Statements', 'desc' => 'Menggunakan IF, ELSE, dan SWITCH untuk keputusan program.', 'img' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80', 'progress' => 100],
            ['title' => 'Loops', 'desc' => 'Membuat perulangan menggunakan FOR, WHILE, dan DO WHILE.', 'img' => 'https://images.unsplash.com/photo-1581090700227-1e37b190418e?auto=format&fit=crop&w=800&q=80', 'progress' => 100],
            ['title' => 'Functions', 'desc' => 'Membuat kode yang efisien dengan fungsi.', 'img' => 'https://images.unsplash.com/photo-1593642632559-0c8e5b7f6d9b?auto=format&fit=crop&w=800&q=80', 'progress' => 100],
        ];
        @endphp

        @foreach ($materiLevel1 as $m)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="{{ $m['img'] }}" class="card-img-top" alt="{{ $m['title'] }}">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $m['title'] }}</h5>
                    <p class="text-muted">{{ $m['desc'] }}</p>
                    <div class="progress mb-3">
    <div class="progress-bar bg-success" style="width: <?php echo $m['progress']; ?>%;"></div>
</div>

                    <button class="btn btn-success w-100">Mulai Belajar</button>
                </div>
            </div>
        </div>
        @endforeach

        <div class="text-center mt-3">
            <button class="btn btn-primary" id="btnCompleteLevel1">✅ Tandai Level 1 Selesai</button>
        </div>
    </div>

    <!-- LEVEL 2 -->
    <div class="row d-none" id="level2">
        @php
        $materiLevel2 = [
            ['title' => 'Object-Oriented Basics', 'desc' => 'Elementary English as a Second Language.', 'img' => 'https://images.unsplash.com/photo-1593642634367-d91a135587b5?auto=format&fit=crop&w=800&q=80', 'progress' => 60],
            ['title' => 'Constructors', 'desc' => 'EF Language Travel.', 'img' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80', 'progress' => 40],
            ['title' => 'Encapsulation', 'desc' => 'EF Language Abroad.', 'img' => 'https://images.unsplash.com/photo-1591696205602-2f950c417cb9?auto=format&fit=crop&w=800&q=80', 'progress' => 20],
            ['title' => 'Inheritance', 'desc' => 'EF Language Year Aboard.', 'img' => 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?auto=format&fit=crop&w=800&q=80', 'progress' => 0],
            ['title' => 'Polymorphism', 'desc' => 'EF University Preparation.', 'img' => 'https://images.unsplash.com/photo-1547658718-dde1b3023ef0?auto=format&fit=crop&w=800&q=80', 'progress' => 0],
            ['title' => 'Abstraction', 'desc' => 'EF Language Aboard 2.', 'img' => 'https://images.unsplash.com/photo-1532619187608-e5375cab36aa?auto=format&fit=crop&w=800&q=80', 'progress' => 0],
        ];
        @endphp

        @foreach ($materiLevel2 as $m)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm {{ $m['progress'] == 0 ? 'locked' : '' }}">
                <img src="{{ $m['img'] }}" class="card-img-top" alt="{{ $m['title'] }}">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $m['title'] }}</h5>
                    <p class="text-muted">{{ $m['desc'] }}</p>
                    <div class="progress mb-3">
    <div class="progress-bar bg-success" style="width: <?php echo $m['progress']; ?>%;"></div>
</div>

                    @if ($m['progress'] > 0)
                        <button class="btn btn-success w-100">Lanjutkan</button>
                    @else
                        <button class="btn btn-secondary w-100" disabled>🔒 Terkunci</button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    const btnLevel1 = document.getElementById('btnLevel1');
    const btnLevel2 = document.getElementById('btnLevel2');
    const btnLevel3 = document.getElementById('btnLevel3');
    const level1 = document.getElementById('level1');
    const level2 = document.getElementById('level2');
    const completeBtn = document.getElementById('btnCompleteLevel1');

    completeBtn.addEventListener('click', () => {
        alert('🎉 Selamat! Level 1 sudah selesai.');
        btnLevel2.disabled = false;
        btnLevel2.classList.remove('btn-outline-secondary');
        btnLevel2.classList.add('btn-primary');
    });

    btnLevel1.addEventListener('click', () => {
        level1.classList.remove('d-none');
        level2.classList.add('d-none');
    });

    btnLevel2.addEventListener('click', () => {
        if (!btnLevel2.disabled) {
            level1.classList.add('d-none');
            level2.classList.remove('d-none');
        }
    });
</script>
@endsection
