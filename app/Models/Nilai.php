<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model untuk menyimpan nilai siswa berdasarkan pelajaran dan kelas
class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';  
    protected $primaryKey = 'nilai_id'; 
    public $timestamps = false;  
    protected $fillable = ['murid_kelas_id', 'pelajaran_id','nilai_tugas', 'nilai_uts', 'nilai_uas'];

    public function muridkelas()
    {
        return $this->belongsTo(MuridKelas::class, 'murid_kelas_id');
    }

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id');
    }
}
