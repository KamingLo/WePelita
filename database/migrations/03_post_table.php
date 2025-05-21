<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table){
            $table -> id('pengumuman_id');
            $table -> foreignId('admin_id')->constrained('admin', 'admin_id')->onDelete('cascade');
            $table -> string('judul_pengumuman');
            $table -> text('isi_pengumuman');
            $table -> string('lampiran');
            $table -> timestamp('created_at')->useCurrent();
        });

        Schema::create('blog', function (Blueprint $table) {
            $table -> id('blog_id');
            $table -> foreignId('admin_id')->constrained('admin', 'admin_id')->onDelete('cascade');
            $table -> string('judul_blog');
            $table -> text('judul_blog');
            $table -> string('isi_blog');
            $table -> timestamp('created_at')->useCurrent();
        });
    }
};

