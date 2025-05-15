<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAjar extends Model
{
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'tahun_ajaran_id';
    protected $fillable = ['tahun_ajaran', 'semester', 'status'];
    public $timestamps = false;

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_tahun', 'tahun_ajaran_id', 'kelas_id');
    }
}
