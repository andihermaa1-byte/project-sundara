<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('questions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
        $table->string('word_target'); // Contoh: KAMANA
        $table->json('rfid_sequence'); // Urutan UID/kode tap: ["KA", "MA", "NA"]
        $table->enum('difficulty', ['mudah', 'sedang', 'sulit'])->default('mudah');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
