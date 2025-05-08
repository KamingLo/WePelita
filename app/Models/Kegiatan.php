<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'judul_kegiatan', 'isi_kegiatan', 'lampiran'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
