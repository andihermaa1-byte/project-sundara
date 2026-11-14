<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CardActivityLog;
use App\Models\Category;
use App\Models\ClassRoom;
use App\Models\LearningSession;
use App\Models\Question;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function summary(Request $request)
    {
        $classes = ClassRoom::all(['id', 'name', 'academic_year']);
        $totalStudents = Student::count();
        $studentsWithRfid = Student::whereNotNull('rfid_uid')->count();
        $rfidCoverage = $totalStudents > 0 ? round(($studentsWithRfid / $totalStudents) * 100) : 0;

        // Distribusi Penguasaan Siswa
        $menguasai = Student::where('mastery_status', 'menguasai')->count();
        $cukup     = Student::where('mastery_status', 'cukup')->count();
        $belum     = Student::where('mastery_status', 'belum')->count();

        $pctMenguasai = $totalStudents > 0 ? round(($menguasai / $totalStudents) * 100) : 0;
        $pctCukup     = $totalStudents > 0 ? round(($cukup / $totalStudents) * 100) : 0;
        $pctBelum     = $totalStudents > 0 ? max(0, 100 - $pctMenguasai - $pctCukup) : 0;

        // Hitung Soal per Kategori
        $categories = Category::withCount('questions')->get()->pluck('questions_count', 'name');

        // 4 Sesi Terbaru
        $recentSessions = LearningSession::with(['student.classRoom', 'question'])
            ->latest('created_at')
            ->take(4)
            ->get()
            ->map(function ($session) {
                $name = $session->student->name ?? 'Siswa';
                $parts = explode(' ', $name);
                $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));

                $statusLabel = $session->score >= 85 ? 'Menguasai' : ($session->score >= 65 ? 'Cukup Menguasai' : 'Belum Menguasai');

                return [
                    'id'       => $session->id,
                    'initials' => $initials,
                    'name'     => $name,
                    'class'    => $session->student->classRoom->name ?? '-',
                    'time'     => $session->created_at->isToday()
                        ? 'Hari ini, ' . $session->created_at->format('H:i') . ' WIB'
                        : ($session->created_at->isYesterday()
                            ? 'Kemarin, ' . $session->created_at->format('H:i') . ' WIB'
                            : $session->created_at->format('d M, H:i') . ' WIB'),
                    'word'     => $session->question->word_target ?? '-',
                    'aksara'   => $session->question->sundanese_text ?? '',
                    'score'    => $session->feedback_note ? "{$session->score}% ({$session->feedback_note})" : "{$session->score}%",
                    'duration' => $session->duration_seconds ? "{$session->duration_seconds}s" : null,
                    'status'   => $statusLabel,
                ];
            });

        // Siswa yang Perlu Latihan
        $remedialStudents = Student::with('classRoom')
            ->where('mastery_status', 'belum')
            ->take(4)
            ->get()
            ->map(function ($student) {
                $parts = explode(' ', $student->name);
                $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));

                return [
                    'id'       => $student->id,
                    'initials' => $initials,
                    'name'     => $student->name,
                    'class'    => 'Kelas ' . ($student->classRoom->name ?? '-'),
                    'focus'    => $student->weakness_focus ?? 'Rarangkén & Ngalagena',
                ];
            });

        return response()->json([
            'status' => 'success',
            'data'   => [
                'classes' => [
                    'total' => $classes->count(),
                    'list'  => $classes->pluck('name'),
                    'year'  => $classes->first()->academic_year ?? '2026/2027',
                ],
                'students' => [
                    'total'         => $totalStudents,
                    'rfid_coverage' => $rfidCoverage,
                    'menguasai'     => ['count' => $menguasai, 'pct' => $pctMenguasai],
                    'cukup'         => ['count' => $cukup,     'pct' => $pctCukup],
                    'belum'         => ['count' => $belum,     'pct' => $pctBelum],
                ],
                'questions' => [
                    'total'      => Question::count(),
                    'pengenalan' => $categories['Pengenalan'] ?? 0,
                    'swara'      => $categories['Swara'] ?? 0,
                    'ngalagena'  => $categories['Ngalagena'] ?? 0,
                    'campur'     => $categories['Campur'] ?? 0,
                ],
                'total_card_logs'   => CardActivityLog::count(),
                'recent_sessions'   => $recentSessions,
                'remedial_students' => $remedialStudents,
            ],
        ]);
    }
}