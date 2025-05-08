<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    public $timestamps = false; // Jika tidak ada kolom created_at dan updated_at
    protected $table = 'jurusan';
    protected $primaryKey = 'jurusan_id'; // WAJIB
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama_jurusan'];

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'jurusan_id');
    }
}
