<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'orang_tua';
    protected $primaryKey = 'orang_tua_id';
    protected $fillable = ['profile_id'];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}
