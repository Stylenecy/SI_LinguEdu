<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Package;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedUsers();
        $this->seedPackages();
        $this->seedCurriculum();
    }

    private function seedUsers(): void
    {
        User::updateOrCreate(
            ['email' => 'adminlinguedu@gmail.com'],
            ['name' => 'Admin LinguEdu', 'role' => 'admin', 'password' => 'admin1234']
        );

        User::updateOrCreate(
            ['email' => 'siswa@linguedu.com'],
            ['name' => 'Budi Siswa', 'role' => 'user', 'password' => 'password']
        );
    }

    private function seedPackages(): void
    {
        $packages = [
            ['name' => 'Free Trial', 'description' => 'Akses materi Level 1 (Beginner) gratis selamanya.', 'price' => 0, 'language' => 'English', 'duration_days' => 3650],
            ['name' => 'Premium Bulanan', 'description' => 'Akses semua level + kuis + sertifikat selama 30 hari.', 'price' => 49000, 'language' => 'English', 'duration_days' => 30],
            ['name' => 'Premium Tahunan', 'description' => 'Akses penuh 1 tahun, hemat 40%, plus bimbingan tutor.', 'price' => 349000, 'language' => 'English', 'duration_days' => 365],
        ];

        foreach ($packages as $p) {
            Package::updateOrCreate(['name' => $p['name']], $p);
        }
    }

    private function seedCurriculum(): void
    {
        foreach ($this->curriculum() as $i => $l) {
            $lesson = Lesson::updateOrCreate(
                ['slug' => Str::slug($l['title'])],
                [
                    'level' => $l['level'],
                    'title' => $l['title'],
                    'description' => $l['description'],
                    'theory' => $l['theory'],
                    'video_url' => $l['video'] ?? 'Kvb4gfoMprM',
                    'image_url' => $l['image'],
                    'order' => $i,
                    'is_published' => true,
                ]
            );

            $lesson->questions()->delete();
            foreach ($l['questions'] as $qi => $q) {
                Question::create([
                    'lesson_id' => $lesson->id,
                    'question' => $q[0],
                    'option_a' => $q[1],
                    'option_b' => $q[2],
                    'option_c' => $q[3],
                    'option_d' => $q[4],
                    'correct_option' => $q[5],
                    'explanation' => $q[6] ?? null,
                    'order' => $qi,
                ]);
            }
        }
    }

    /** English-learning curriculum: 3 levels. */
    private function curriculum(): array
    {
        $img = fn ($id) => "https://images.unsplash.com/photo-$id?auto=format&fit=crop&w=800&q=80";

        return [
            // ===================== LEVEL 1 — BEGINNER =====================
            [
                'level' => 1,
                'title' => 'Greetings & Introductions',
                'description' => 'Belajar menyapa dan memperkenalkan diri dalam bahasa Inggris.',
                'image' => $img('1503676260728-1c00da094a0b'),
                'theory' => "<p>In English, greetings change with the time of day and how formal you are.</p>
                    <ul>
                        <li><b>Good morning</b> — before noon.</li>
                        <li><b>Good afternoon</b> — from noon to ~6 p.m.</li>
                        <li><b>Good evening</b> — after 6 p.m.</li>
                        <li><b>Hi / Hey</b> — informal, any time.</li>
                    </ul>
                    <p>To introduce yourself: <i>\"Hi, my name is Budi. Nice to meet you.\"</i> The usual reply is <i>\"Nice to meet you too.\"</i></p>",
                'questions' => [
                    ['Which greeting is correct at 8 a.m.?', 'Good night', 'Good morning', 'Good evening', 'Goodbye', 'b', '\"Good morning\" is used before noon.'],
                    ['How do you introduce yourself?', 'My name Budi', 'I am name Budi', 'My name is Budi', 'Name me Budi', 'c', 'Use \"My name is ...\".'],
                    ['Someone says \"Nice to meet you.\" You reply:', 'Nice to meet you too', 'Good night', 'You are welcome', 'No problem', 'a'],
                    ['Which greeting is the most informal?', 'Good evening', 'Good afternoon', 'Hey', 'How do you do', 'c'],
                ],
            ],
            [
                'level' => 1,
                'title' => 'Numbers & Telling Time',
                'description' => 'Angka, jam, dan cara menyebut waktu.',
                'image' => $img('1501139083538-0139583c060f'),
                'theory' => "<p>Numbers: one, two, three ... ten. Tens: twenty, thirty, forty.</p>
                    <p>Telling time: <i>\"It's half past seven\"</i> = 7:30. <i>\"It's a quarter to nine\"</i> = 8:45. <i>\"It's a quarter past six\"</i> = 6:15.</p>",
                'questions' => [
                    ['How do you say 7:30?', 'Half to seven', 'Half past seven', 'Quarter past seven', 'Seven and half', 'b'],
                    ['What number comes after nineteen?', 'Twenty', 'Twelve', 'Ninety', 'Twenty-one', 'a'],
                    ['\"A quarter to nine\" means:', '9:15', '8:45', '9:45', '8:15', 'b', 'Quarter to = 15 minutes before the hour.'],
                    ['Which is spelled correctly?', 'Fourty', 'Forty', 'Fortty', 'Fourthy', 'b'],
                ],
            ],
            [
                'level' => 1,
                'title' => 'Present Simple Tense',
                'description' => 'Kalimat sehari-hari dengan present simple.',
                'image' => $img('1456513080510-7bf3a84b82f8'),
                'theory' => "<p>Use the present simple for habits and facts. Add <b>-s</b> for he/she/it.</p>
                    <p><i>I work. She work<b>s</b>. They play. He play<b>s</b>.</i></p>
                    <p>Negatives use <b>do not / does not</b>: <i>I don't like tea. He doesn't drink coffee.</i></p>",
                'questions' => [
                    ['Choose the correct sentence.', 'She go to school', 'She goes to school', 'She going to school', 'She gone to school', 'b', 'Add -s for he/she/it.'],
                    ['Complete: \"They ___ football every Sunday.\"', 'plays', 'playing', 'play', 'played', 'c'],
                    ['Negative of \"He likes tea\":', 'He not like tea', 'He doesn\'t likes tea', 'He don\'t like tea', 'He doesn\'t like tea', 'd'],
                    ['Which is a fact in present simple?', 'Water boils at 100°C', 'Water boiling now', 'Water boiled', 'Water will boil', 'a'],
                ],
            ],

            // ===================== LEVEL 2 — INTERMEDIATE =====================
            [
                'level' => 2,
                'title' => 'Past Simple & Storytelling',
                'description' => 'Menceritakan kejadian masa lampau.',
                'image' => $img('1455390582262-044cdead277a'),
                'theory' => "<p>Regular verbs add <b>-ed</b>: <i>walk → walked</i>. Many common verbs are irregular: <i>go → went, eat → ate, see → saw</i>.</p>
                    <p>Questions use <b>did</b> + base verb: <i>Did you go? Yes, I did.</i></p>",
                'questions' => [
                    ['Past of \"go\":', 'goed', 'gone', 'went', 'going', 'c', '\"Go\" is irregular: went.'],
                    ['Complete: \"Yesterday I ___ a great movie.\"', 'watch', 'watched', 'watching', 'watches', 'b'],
                    ['Question form: \"___ you eat breakfast?\"', 'Do', 'Does', 'Did', 'Done', 'c'],
                    ['Past of \"see\":', 'seed', 'saw', 'seen', 'sawed', 'b'],
                ],
            ],
            [
                'level' => 2,
                'title' => 'Comparatives & Superlatives',
                'description' => 'Membandingkan benda dan orang.',
                'image' => $img('1454165804606-c3d57bc86b40'),
                'theory' => "<p>Short adjectives: add <b>-er / -est</b>: <i>tall → taller → tallest</i>.</p>
                    <p>Long adjectives: use <b>more / most</b>: <i>beautiful → more beautiful → most beautiful</i>.</p>
                    <p>Irregular: <i>good → better → best</i>, <i>bad → worse → worst</i>.</p>",
                'questions' => [
                    ['Comparative of \"good\":', 'gooder', 'better', 'best', 'more good', 'b'],
                    ['\"This book is ___ than that one.\"', 'interesting', 'most interesting', 'more interesting', 'interestinger', 'c'],
                    ['Superlative of \"tall\":', 'taller', 'tallest', 'most tall', 'the taller', 'b'],
                    ['Choose the correct sentence.', 'She is the most fast runner', 'She is the fastest runner', 'She is faster runner', 'She is more fast runner', 'b'],
                ],
            ],
            [
                'level' => 2,
                'title' => 'Modal Verbs',
                'description' => 'Can, must, should, dan penggunaannya.',
                'image' => $img('1434030216411-0b793f4b4173'),
                'theory' => "<p><b>Can</b> = ability/permission. <b>Must</b> = obligation. <b>Should</b> = advice. <b>Might</b> = possibility.</p>
                    <p>Modals are followed by the <i>base verb</i>: <i>You should rest.</i> (not \"should to rest\").</p>",
                'questions' => [
                    ['\"You ___ see a doctor.\" (advice)', 'must', 'should', 'can', 'might', 'b', '\"Should\" gives advice.'],
                    ['Which is correct?', 'She can to swim', 'She can swims', 'She can swim', 'She cans swim', 'c'],
                    ['\"Students ___ wear a uniform.\" (rule)', 'might', 'could', 'must', 'would', 'c'],
                    ['\"It ___ rain later, take an umbrella.\"', 'must', 'might', 'should', 'can', 'b'],
                ],
            ],

            // ===================== LEVEL 3 — ADVANCED =====================
            [
                'level' => 3,
                'title' => 'Present Perfect Tense',
                'description' => 'Pengalaman dan kejadian yang masih relevan.',
                'image' => $img('1488190211105-8b0e65b80b4e'),
                'theory' => "<p>Form: <b>have/has + past participle</b>. Use for experiences and recent actions with present relevance.</p>
                    <p><i>I have visited Japan. She has finished her homework.</i></p>
                    <p>Use <b>for</b> (duration) and <b>since</b> (starting point): <i>I have lived here for 3 years / since 2023.</i></p>",
                'questions' => [
                    ['Choose the present perfect.', 'I visit Bali', 'I visited Bali', 'I have visited Bali', 'I am visiting Bali', 'c'],
                    ['\"She ___ finished her work.\"', 'have', 'has', 'had', 'is', 'b'],
                    ['\"I have lived here ___ 2020.\"', 'for', 'since', 'from', 'during', 'b', 'Use \"since\" with a starting point.'],
                    ['Past participle of \"eat\":', 'ate', 'eated', 'eaten', 'eating', 'c'],
                ],
            ],
            [
                'level' => 3,
                'title' => 'Conditionals (If-Clauses)',
                'description' => 'Mengungkapkan kemungkinan dan pengandaian.',
                'image' => $img('1457369804613-52c61a468e7d'),
                'theory' => "<p><b>Zero:</b> If you heat ice, it melts (facts).</p>
                    <p><b>First:</b> If it rains, I will stay home (real future).</p>
                    <p><b>Second:</b> If I were rich, I would travel (unreal present).</p>",
                'questions' => [
                    ['First conditional: \"If it rains, I ___ home.\"', 'stay', 'stayed', 'will stay', 'would stay', 'c'],
                    ['Second conditional: \"If I ___ you, I would apologize.\"', 'am', 'was', 'were', 'be', 'c', 'Use \"were\" for all subjects in the second conditional.'],
                    ['Zero conditional: \"If you heat water, it ___.\"', 'boiled', 'boils', 'will boil', 'would boil', 'b'],
                    ['Which sentence is correct?', 'If I will see her, I tell her', 'If I see her, I will tell her', 'If I saw her, I will tell her', 'If I see her, I told her', 'b'],
                ],
            ],
            [
                'level' => 3,
                'title' => 'Idioms & Natural Expressions',
                'description' => 'Ungkapan idiomatik agar terdengar natural.',
                'image' => $img('1521737711867-e3b97375f902'),
                'theory' => "<p>Idioms don't translate literally:</p>
                    <ul>
                        <li><b>Break the ice</b> — start a conversation.</li>
                        <li><b>Piece of cake</b> — very easy.</li>
                        <li><b>Hit the books</b> — study hard.</li>
                        <li><b>Under the weather</b> — feeling sick.</li>
                    </ul>",
                'questions' => [
                    ['\"Piece of cake\" means:', 'Delicious', 'Very easy', 'Expensive', 'Sweet', 'b'],
                    ['\"I\'m feeling under the weather.\" =', 'I am happy', 'I am busy', 'I am sick', 'I am cold outside', 'c'],
                    ['\"Break the ice\" means to:', 'Start a conversation', 'Break something', 'Make it cold', 'End a meeting', 'a'],
                    ['\"Hit the books\" means to:', 'Throw books', 'Study hard', 'Buy books', 'Read for fun', 'b'],
                ],
            ],
        ];
    }
}
