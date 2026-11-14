<?php

namespace Database\Seeders;

use App\Models\CardActivityLog;
use App\Models\Category;
use App\Models\ClassRoom;
use App\Models\LearningSession;
use App\Models\Question;
use App\Models\Student;
use Illuminate\Database\Seeder;

class SundaraDemoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Kategori Aksara Sunda
        $catPengenalan = Category::firstOrCreate(['name' => 'Pengenalan'], ['description' => 'Pengenalan bentuk dasar huruf Aksara Sunda']);
        $catSwara      = Category::firstOrCreate(['name' => 'Swara'],      ['description' => 'Aksara vokal mandiri (A, I, U, E, O, É, Eu)']);
        $catNgalagena  = Category::firstOrCreate(['name' => 'Ngalagena'],  ['description' => 'Aksara konsonan dasar (Ka-Ga-Nga, dst.)']);
        $catCampur     = Category::firstOrCreate(['name' => 'Campur'],     ['description' => 'Kombinasi Ngalagena, Swara, dan Rarangkén']);

        // 2. 4 Kelas Aktif
        $classNames = ['VII-A', 'VII-B', 'VIII-A', 'VIII-B'];
        $classes = [];
        foreach ($classNames as $name) {
            $classes[$name] = ClassRoom::firstOrCreate(
                ['name' => $name],
                ['academic_year' => '2026/2027']
            );
        }

        // 3. Siswa Utama & Siswa Remedial (Sesuai Mockup)
        $namedStudents = [
            ['num' => '2607001', 'name' => 'Aditya Pratama',  'class' => 'VII-A', 'uid' => 'RFID-A101', 'status' => 'menguasai', 'weakness' => null],
            ['num' => '2607002', 'name' => 'Siti Nurhaliza',  'class' => 'VII-A', 'uid' => 'RFID-A102', 'status' => 'cukup',     'weakness' => 'Rarangkén (Pamepet)'],
            ['num' => '2607003', 'name' => 'Rizky Fauzan',    'class' => 'VII-B', 'uid' => 'RFID-B201', 'status' => 'belum',     'weakness' => 'Rarangkén (Panyuku & Pamepet)'],
            ['num' => '2607004', 'name' => 'Dewi Anggraeni',  'class' => 'VII-A', 'uid' => 'RFID-A103', 'status' => 'menguasai', 'weakness' => null],
            ['num' => '2607005', 'name' => 'Budi Santoso',    'class' => 'VII-A', 'uid' => 'RFID-A104', 'status' => 'belum',     'weakness' => 'Rarangkén (Panyecek & Panglayar)'],
            ['num' => '2607006', 'name' => 'Nabila Putri',    'class' => 'VII-B', 'uid' => 'RFID-B202', 'status' => 'belum',     'weakness' => 'Aksara Ngalagena (ᮓ, ᮔ, ᮑ)'],
            ['num' => '2607007', 'name' => 'Dimas Pratama',   'class' => 'VII-A', 'uid' => 'RFID-A105', 'status' => 'belum',     'weakness' => 'Aksara Swara & Rarangkén'],
        ];

        $studentModels = [];
        foreach ($namedStudents as $s) {
            $studentModels[$s['name']] = Student::updateOrCreate(
                ['student_number' => $s['num']],
                [
                    'class_room_id'  => $classes[$s['class']]->id,
                    'name'           => $s['name'],
                    'rfid_uid'       => $s['uid'],
                    'mastery_status' => $s['status'],
                    'weakness_focus' => $s['weakness'],
                ]
            );
        }

        // Lengkapi hingga 32 siswa per kelas (total 128 siswa)
        $counter = 8;
        foreach ($classNames as $cName) {
            $existingCount = Student::where('class_room_id', $classes[$cName]->id)->count();
            for ($i = $existingCount + 1; $i <= 32; $i++) {
                $status = $i <= 18 ? 'menguasai' : ($i <= 29 ? 'cukup' : 'belum');
                Student::firstOrCreate(
                    ['student_number' => '2607' . str_pad($counter, 3, '0', STR_PAD_LEFT)],
                    [
                        'class_room_id'  => $classes[$cName]->id,
                        'name'           => "Siswa {$cName} #{$i}",
                        'rfid_uid'       => 'RFID-' . str_replace('-', '', $cName) . '-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                        'mastery_status' => $status,
                        'weakness_focus' => $status === 'belum' ? 'Rarangkén & Ngalagena' : null,
                    ]
                );
                $counter++;
            }
        }

        // 4. Bank Soal (Total 72 Soal: 14 Pengenalan, 18 Swara, 26 Ngalagena, 14 Campur)
        $sampleQuestions = [
            ['cat' => $catNgalagena->id,  'word' => 'KAMANA',      'sunda' => 'ᮊᮙᮔ',     'seq' => ['UID_KA', 'UID_MA', 'UID_NA'], 'diff' => 1],
            ['cat' => $catCampur->id,     'word' => 'BANDUNG',     'sunda' => 'ᮘᮔ᮪ᮓᮥᮀ',   'seq' => ['UID_BA', 'UID_NA', 'UID_PAMAEH', 'UID_DA', 'UID_PANYUKU', 'UID_PANYECEK'], 'diff' => 2],
            ['cat' => $catCampur->id,     'word' => 'PANGALENGAN', 'sunda' => 'ᮕᮍᮜᮨᮍᮔ᮪', 'seq' => ['UID_PA', 'UID_NGA', 'UID_LA', 'UID_PAMEPET', 'UID_NGA', 'UID_NA', 'UID_PAMAEH'], 'diff' => 3],
            ['cat' => $catCampur->id,     'word' => 'SUMEDANG',    'sunda' => 'ᮞᮥᮙᮨᮓᮀ',   'seq' => ['UID_SA', 'UID_PANYUKU', 'UID_MA', 'UID_PAMEPET', 'UID_DA', 'UID_PANYECEK'], 'diff' => 2],
        ];

        $qModels = [];
        foreach ($sampleQuestions as $sq) {
            $qModels[$sq['word']] = Question::firstOrCreate(
                ['word_target' => $sq['word']],
                [
                    'category_id'    => $sq['cat'],
                    'sundanese_text' => $sq['sunda'],
                    'rfid_sequence'  => $sq['seq'],
                    'difficulty'     => $sq['diff'],
                ]
            );
        }

        $targets = [
            [$catPengenalan->id, 'PENGENALAN', 14, 1],
            [$catSwara->id,      'SWARA',      18, 1],
            [$catNgalagena->id,  'NGALAGENA',  26, 2],
            [$catCampur->id,     'CAMPUR',     14, 3],
        ];

        foreach ($targets as [$catId, $prefix, $targetCount, $diff]) {
            $current = Question::where('category_id', $catId)->count();
            for ($i = $current + 1; $i <= $targetCount; $i++) {
                Question::create([
                    'category_id'    => $catId,
                    'word_target'    => "{$prefix} #{$i}",
                    'sundanese_text' => 'ᮞᮥᮔ᮪ᮓᮛ',
                    'rfid_sequence'  => ['UID_SA', 'UID_PANYUKU', 'UID_NA', 'UID_PAMAEH', 'UID_DA', 'UID_RA'],
                    'difficulty'     => $diff,
                ]);
            }
        }

        // 5. Sesi Pembelajaran & Log Kartu (4 Sesi Terbaru)
        if (LearningSession::count() === 0) {
            $sessions = [
                [
                    'code'     => 'SES-2026-001',
                    'student'  => $studentModels['Aditya Pratama']->id,
                    'question' => $qModels['KAMANA']->id,
                    'score'    => 95,
                    'duration' => 42,
                    'note'     => null,
                    'time'     => now()->subMinutes(15),
                ],
                [
                    'code'     => 'SES-2026-002',
                    'student'  => $studentModels['Siti Nurhaliza']->id,
                    'question' => $qModels['BANDUNG']->id,
                    'score'    => 70,
                    'duration' => 58,
                    'note'     => 'Perlu Rarangkén',
                    'time'     => now()->subMinutes(30),
                ],
                [
                    'code'     => 'SES-2026-003',
                    'student'  => $studentModels['Rizky Fauzan']->id,
                    'question' => $qModels['PANGALENGAN']->id,
                    'score'    => 40,
                    'duration' => 75,
                    'note'     => null,
                    'time'     => now()->subDay()->setTime(14, 15),
                ],
                [
                    'code'     => 'SES-2026-004',
                    'student'  => $studentModels['Dewi Anggraeni']->id,
                    'question' => $qModels['SUMEDANG']->id,
                    'score'    => 90,
                    'duration' => 46,
                    'note'     => null,
                    'time'     => now()->subDay()->setTime(13, 50),
                ],
            ];

            foreach ($sessions as $s) {
                $ls = LearningSession::create([
                    'session_code'     => $s['code'],
                    'student_id'       => $s['student'],
                    'question_id'      => $s['question'],
                    'status'           => 'completed',
                    'score'            => $s['score'],
                    'duration_seconds' => $s['duration'],
                    'feedback_note'    => $s['note'],
                    'started_at'       => $s['time']->copy()->subSeconds($s['duration']),
                    'ended_at'         => $s['time'],
                    'created_at'       => $s['time'],
                ]);

                // Contoh 1 log aktivitas kartu RFID per sesi
                CardActivityLog::create([
                    'learning_session_id' => $ls->id,
                    'slot_position'       => 1,
                    'card_uid'            => 'UID_KA',
                    'is_correct'          => $s['score'] >= 70,
                ]);
            }
        }
    }
}