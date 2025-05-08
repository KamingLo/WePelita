<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = ['murid_id', 'kehadiran', 'tanggal_absensi'];

    public function murid()
    {
        return $this->belongsTo(Murid::class, 'murid_id');
    }
}
