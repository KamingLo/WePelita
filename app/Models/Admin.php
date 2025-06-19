<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model untuk menyimpan data admin
class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    protected $fillable = ['profile_id'];
    public $timestamps = false;

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}