<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    use HasFactory;

    protected $table = 'postingan';
    protected $primaryKey = 'postingan_id';
    protected $fillable = ['profile_id', 'tipe', 'judul', 'isi', 'lampiran'];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'postingan_id');
    }
}