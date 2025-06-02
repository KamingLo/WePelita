<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    use HasFactory;

    protected $table = 'postingan';

    protected $primaryKey = 'postingan_id';

    protected $fillable = [
        'profile_id',
        'kelas_tahun_id',
        'tipe',
        'judul',
        'isi', 
        'lampiran',
    ];

    /**
     * Relasi dengan model Profile (pengguna yang membuat postingan).
     */
    public function profile()
    {
        // Sesuaikan foreign key jika berbeda dari konvensi Laravel
        return $this->belongsTo(Profile::class, 'profile_id', 'profile_id');
    }

    /**
     * Relasi dengan model Komentar (komentar pada postingan ini).
     */
    public function komentar()
    {
        // Sesuaikan foreign key jika berbeda dari konvensi Laravel
        return $this->hasMany(Komentar::class, 'postingan_id', 'postingan_id');
    }

    /**
     * Relasi dengan model KelasTahun (jika postingan ini terkait dengan kelas/tahun tertentu).
     */
    public function kelasTahun()
    {
        // Sesuaikan foreign key jika berbeda dari konvensi Laravel
        return $this->belongsTo(KelasTahun::class, 'kelas_tahun_id', 'kelas_tahun_id');
    }
}