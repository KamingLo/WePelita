<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'murid';
    protected $primaryKey = 'murid_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['profile_id', 'kelas_tahun_id', 'nis', 'nisn', 'asal_sekolah'];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function orangTua()
    {
        return $this->belongsToMany(
            OrangTua::class,
            'murid_orang_tua',
            'murid_id',
            'orang_tua_id'
        );
    }

    public function kelasTahun()
    {
        return $this->belongsTo(KelasTahun::class, 'kelas_tahun_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'murid_id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'murid_id');
    }
}