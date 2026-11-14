<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah UID Kartu RFID & Status Penguasaan pada tabel students
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'rfid_uid')) {
                $table->string('rfid_uid')->nullable()->unique()->after('name');
            }
            if (!Schema::hasColumn('students', 'mastery_status')) {
                $table->enum('mastery_status', ['menguasai', 'cukup', 'belum'])->default('belum')->after('rfid_uid');
            }
            if (!Schema::hasColumn('students', 'weakness_focus')) {
                $table->string('weakness_focus')->nullable()->after('mastery_status');
            }
        });

        // 2. Tambah teks aksara Sunda pada tabel questions
        Schema::table('questions', function (Blueprint $table) {
            if (!Schema::hasColumn('questions', 'sundanese_text')) {
                $table->string('sundanese_text')->nullable()->after('word_target');
            }
        });

        // 3. Tambah relasi soal & skor pada tabel learning_sessions
        Schema::table('learning_sessions', function (Blueprint $table) {
            if (!Schema::hasColumn('learning_sessions', 'question_id')) {
                $table->foreignId('question_id')->nullable()->after('student_id')->constrained('questions')->nullOnDelete();
            }
            if (!Schema::hasColumn('learning_sessions', 'score')) {
                $table->unsignedTinyInteger('score')->default(0)->after('status');
            }
            if (!Schema::hasColumn('learning_sessions', 'duration_seconds')) {
                $table->unsignedSmallInteger('duration_seconds')->default(0)->after('score');
            }
            if (!Schema::hasColumn('learning_sessions', 'feedback_note')) {
                $table->string('feedback_note')->nullable()->after('duration_seconds');
            }
        });
    }

    public function down(): void
    {
        Schema::table('learning_sessions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('question_id');
            $table->dropColumn(['score', 'duration_seconds', 'feedback_note']);
        });
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('sundanese_text');
        });
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['rfid_uid', 'mastery_status', 'weakness_focus']);
        });
    }
};