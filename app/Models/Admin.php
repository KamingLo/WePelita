<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    public $timestamps = false; 
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    protected $fillable = ['profile_id'];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class, 'admin_id');
    }

    public function blog()
    {
        return $this->hasMany(Blog::class, 'admin_id');
    }
}
