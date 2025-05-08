<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = ['murid_id', 'pelajaran_id', 'semester', 'tahun_ajaran', 'nilai_uts', 'nilai_uas'];

    public function murid()
    {
        return $this->belongsTo(Murid::class, 'murid_id');
    }

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id');
    }
}
