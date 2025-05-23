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
            $table -> foreignId('profile_id')->constrained('profile', 'profile_id')->onDelete('cascade');
            $table -> string('tujuan_postingan');
            $table -> string('path_postingan');
            $table -> string('judul_postingan');
            $table -> timestamp('created_at')->useCurrent();
        });

        Schema::create('komentar', function (Blueprint $table) {
            $table -> id('komentar_id');
            $table -> foreignId('postingan_id')->constrained('admin', 'admin_id')->onDelete('cascade');
            $table -> foreignId('profile_id')->constrained('profile', 'profile_id')->onDelete('cascade');
            $table -> string('isi_komentar');
            $table -> timestamp('created_at')->useCurrent();
        });
    }
};

