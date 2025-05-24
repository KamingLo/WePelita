<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('postingan', function (Blueprint $table){
            $table -> id('postingan_id');
            $table -> foreignId('profile_id')->constrained('profiles', 'profile_id')->onDelete('cascade');
            $table -> string('tipe_postingan');
            $table -> string('tujuan_postingan');
            $table -> string('path_postingan'); // storge/hohh 
            $table -> string('judul_postingan');
            $table -> string('lampiran')->nullable(); // tampilan foto dalam postingan
            $table -> timestamp('created_at')->useCurrent();
        });

        Schema::create('komentar', function (Blueprint $table) {
            $table -> id('komentar_id');
            $table -> foreignId('postingan_id')->constrained('postingan', 'postingan_id')->onDelete('cascade');
            $table -> foreignId('profile_id')->constrained('profiles', 'profile_id')->onDelete('cascade');
            $table -> string('isi_komentar');
            $table -> timestamp('created_at')->useCurrent();
        });
    }
};

