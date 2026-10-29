<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sumber_budayas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('budaya_id')
                ->constrained('budayas')
                ->cascadeOnDelete();
            $table->string('judul_sumber', 255);
            $table->string('penulis_lembaga', 255)->nullable();
            $table->unsignedSmallInteger('tahun')->nullable();
            $table->string('url', 500)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sumber_budayas');
    }
};