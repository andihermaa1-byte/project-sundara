<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRfidCardsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rfid_cards', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique(); // Contoh: UID_KA, 04A3892B, dll.
            $table->string('name'); // Contoh: Ka, Panghulu, A, dll.
            $table->string('char_sundanese'); // Contoh: ᮊ
            $table->enum('type', ['ngalagena', 'swara', 'rarangken']); // Jenis aksara
            $table->string('latin'); // Contoh: ka, i, panghulu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rfid_cards');
    }
}