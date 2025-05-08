<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'kelas';
    protected $primaryKey = 'kelas_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['jurusan_id', 'nama_kelas', 'tahun_ajaran'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'jurusan_id');
    }

    public function murid()
    {
        return $this->hasMany(Murid::class, 'kelas_id');
    }

    public function jadwalPelajaran()
    {
        return $this->hasMany(JadwalPelajaran::class, 'kelas_id');
    }
}
