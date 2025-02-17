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
        Schema::create('artikel', function (Blueprint $table) {
            $table->id();
            $table->string('gambar');
            $table->foreignId('kategori_artikel_id')->constrained('kategori_artikel')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tag_artikel_id')->constrained('tag_artikel')->onUpdate('cascade')->onDelete('cascade');
            $table->string('judul');
            $table->longText('isi');
            $table->enum('status', ['publish', 'draft'])->default('draft');
            $table->string('create_by');
            $table->string('update_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};
