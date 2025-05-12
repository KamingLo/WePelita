<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuridOrangTua extends Model
{
    use HasFactory;

    protected $table = 'murid_orang_tua';
    protected $primaryKey = 'murid_orang_tua_id';

    protected $fillable = [
        'murid_id',
        'orang_tua_id',
    ];

    public function murid()
    {
        return $this->belongsTo(Murid::class, 'murid_id');
    }

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class, 'orang_tua_id');
    }
}
