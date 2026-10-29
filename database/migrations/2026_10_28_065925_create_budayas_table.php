<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budayas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')
                ->constrained('kategoris')
                ->restrictOnDelete();
            $table->string('judul', 200);
            $table->string('slug', 220)->unique();
            $table->text('ringkasan');
            $table->longText('deskripsi');
            $table->string('gambar')->nullable();
            $table->string('asal_lokasi')->nullable();
            $table->string('status', 20)->default('draft')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budayas');
    }
};