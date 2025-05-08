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
}
