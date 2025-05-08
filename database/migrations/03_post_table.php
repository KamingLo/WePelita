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
            $table -> string('isi_pengumuman');
            $table -> binary('lampiran');
            $table -> timestamp('created_at')->useCurrent();
        });

        Schema::create('kegiatan', function (Blueprint $table) {
            $table -> id('kegiatan_id');
            $table -> foreignId('admin_id')->constrained('admin', 'admin_id')->onDelete('cascade');
            $table -> string('judul_kegiatan');
            $table -> string('isi_kegiatan');
            $table -> binary('lampiran');
            $table -> timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void{
        Schema::dropIfExists('pengumuman');
        Schema::dropIfExists('kegiatan');
    }
};

