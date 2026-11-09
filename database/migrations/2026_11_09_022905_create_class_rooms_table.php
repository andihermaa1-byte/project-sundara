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
    Schema::create('class_rooms', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Contoh: Kelas 1A, Kelas 2B
        $table->string('academic_year')->nullable(); // Contoh: 2026/2027
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_rooms');
    }
};

