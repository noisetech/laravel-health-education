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
        Schema::create('pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade')->comment('ID penanya (user biasa)');
            $table->foreignId('doctor_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade')->comment('ID dokter yang menjawab');
            $table->text('pertanyaan');
            $table->text('jawaban')->nullable();
            $table->enum('status', ['menunggu jawaban', 'telah dijawab', 'pertanyaan telah ditutup'])->default('menunggu jawaban');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertanyaan');
    }
};
