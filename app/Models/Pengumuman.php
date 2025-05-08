<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'judul_pengumuman', 'isi_pengumuman', 'lampiran'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
