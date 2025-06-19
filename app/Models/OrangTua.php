<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model untuk menyimpan data orang tua dengan murid
class OrangTua extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'orang_tua';
    protected $primaryKey = 'orang_tua_id';
    protected $fillable = ['profile_id', 'profesi'];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
    
    public function muridKelas()
    {
        return $this->belongsToMany(
            MuridKelas::class,
            'murid_orang_tua',
            'orang_tua_id',
            'murid_kelas_id'
        );
    }
}