<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('postingan', function (Blueprint $table) {
            $table->id('postingan_id');
            $table->foreignId('kelas_tahun_id')->nullable()->constrained('kelas_tahun', 'kelas_tahun_id')->onDelete('cascade');
            $table->foreignId('profile_id')->constrained('profiles', 'profile_id')->onDelete('cascade');
            $table->enum('tipe', ['pengumuman', 'blog']);
            $table->string('judul');
            $table->text('isi');
            $table->string('lampiran')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postingan');
    }
};