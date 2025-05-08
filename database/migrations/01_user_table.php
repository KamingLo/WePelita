<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id('profile_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('nik');
            $table->string('password');
            $table->string('no_telp');
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::create('guru', function (Blueprint $table) {
            $table->id('guru_id');
            $table->foreignId('profile_id')->constrained('profiles', 'profile_id')->onDelete('cascade');
        });
        

        Schema::create('orang_tua', function (Blueprint $table){
            $table -> id('orang_tua_id');
            $table->foreignId('profile_id')->constrained('profiles', 'profile_id')->onDelete('cascade');
        });

        Schema::create('admin', function (Blueprint $table){
            $table->id('admin_id');
            $table->foreignId('profile_id')->constrained('profiles', 'profile_id')->onDelete('cascade');
        });

        Schema::create('kelas', function (Blueprint $table){
            $table -> id('kelas_id');
            $table -> string('nama_kelas');
            $table -> string('tahun_ajaran');
        });

        Schema::create('murid', function (Blueprint $table){
            $table->id('murid_id');
            $table->foreignId('profile_id')->constrained('profiles', 'profile_id')->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelas', 'kelas_id')->onDelete('cascade');
            $table->foreignId('orang_tua_id')->constrained('orang_tua', 'orang_tua_id')->onDelete('cascade');
            $table->string('nis');
            $table->string('nisn');
            $table->string('Status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
        Schema::dropIfExists('pengumuman');
        Schema::dropIfExists('jadwal_pelajaran');
        Schema::dropIfExists('nilai');
        Schema::dropIfExists('pelajaran');
        Schema::dropIfExists('absensi');
        Schema::dropIfExists('murid');
        Schema::dropIfExists('kelas');
        Schema::dropIfExists('admin');
        Schema::dropIfExists('orang_tua');
        Schema::dropIfExists('guru');
        Schema::dropIfExists('profile');
    }
};
