<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    public $timestamps = false; 
    protected $table = 'guru';
    protected $primaryKey = 'guru_id';
    protected $fillable = ['profile_id', 'gelar', 'status_menikah', 'status_kerja', 'nuptk'];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}
