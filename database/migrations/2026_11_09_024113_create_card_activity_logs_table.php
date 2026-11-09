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
    Schema::create('card_activity_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('learning_session_id')->constrained('learning_sessions')->onDelete('cascade');
        $table->integer('slot_position'); // Nomor Slot 1-12
        $table->string('card_uid');      // UID Kartu RFID
        $table->boolean('is_correct')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_activity_logs');
    }
};
