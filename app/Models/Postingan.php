<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    public $timestamps = false; 
    protected $table = 'postingan';
    protected $primaryKey = 'postingan_id';
    protected $fillable = ['profile_id', 'path_postingan', 'judul_postingan', 'created_at'];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}
