<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id('absensi_id');
            $table->foreignId('murid_id')->constrained('murid', 'murid_id')->onDelete('cascade');
            $table->string('kehadiran');
            $table->string('tanggal_absensi');
        });

        Schema::create('pelajaran', function (Blueprint $table){
            $table->id('pelajaran_id');
            $table->foreignId('guru_id')->constrained('guru', 'guru_id')->onDelete('cascade');
            $table->string('namaPelajaran');
        });

        
        Schema::create('nilai', function (Blueprint $table){
            $table->id('nilai_id');
            $table->foreignId('murid_id')->constrained('murid', 'murid_id')->onDelete('cascade');
            $table->foreignId('pelajaran_id')->constrained('pelajaran', 'pelajaran_id')->onDelete('cascade');
            $table->string('semester');
            $table->string('tahun_ajaran');
            $table->string('nilai_uts');
            $table->string('nilai_uas');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
                
        Schema::create('jadwal_pelajaran', function (Blueprint $table){
            $table->id('jadwal_id');
            $table->foreignId('pelajaran_id')->constrained('pelajaran', 'pelajaran_id')->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelas', 'kelas_id')->onDelete('cascade');
            $table->string('hari');
            $table->string('waktu_mulai');
            $table->string('waktu_selesai');
        });
    }
};
