<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';
    protected $primaryKey = 'profile_id'; // Penting!
    protected $fillable = ['name', 'email', 'nik', 'password', 'no_telp'];

    public function guru()
    {
        return $this->hasOne(Guru::class, 'profile_id');
    }

    public function orangTua()
    {
        return $this->hasOne(OrangTua::class, 'profile_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'profile_id');
    }

    public function murid()
    {
        return $this->hasOne(Murid::class, 'profile_id');
    }
}
?>