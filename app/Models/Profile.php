<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use BeyondCode\Comments\Traits\HasComments;
use BeyondCode\Comments\Contracts\Commentator;

class Profile extends Authenticatable
{
    use Notifiable, HasComments;

    protected $primaryKey = 'profile_id';

    protected $table = 'profiles';

    protected $fillable = [
        'name', 'email', 'alamat', 'foto', 'jenis_kelamin', 'tanggal_lahir',
        'tempat_lahir', 'pendidikan', 'password', 'no_telp',
    ];

    protected $hidden = [
        'password',
    ];

    public function guru() {
        return $this->hasOne(Guru::class, 'profile_id');
    }

    public function murid() {
        return $this->hasOne(Murid::class, 'profile_id');
    }

    public function orangTua() {
        return $this->hasOne(OrangTua::class, 'profile_id');
    }

    public function admin() {
        return $this->hasOne(Admin::class, 'profile_id');
    }
}
