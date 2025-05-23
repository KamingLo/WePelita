<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    use HasFactory;

    public $timestamps = false; 
    protected $table = 'postingan';
    protected $primaryKey = 'postingan_id';
    protected $fillable = ['profile_id', 'tujuan_postingan','path_postingan', 'judul_postingan', 'created_at'];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}
