<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use BeyondCode\Comments\Traits\HasComments;
use BeyondCode\Comments\Contracts\Commentator;

// Model untuk menyimpan data akun pengguna (admin, guru, murid, atau orang tua)
class Profile extends Authenticatable implements Commentator
{
    use Notifiable, HasFactory, HasComments;

    protected $primaryKey = 'profile_id';
    protected $table = 'profiles';

    protected $fillable = [
        'name', 'email', 'alamat', 'avatar', 'jenis_kelamin', 'tanggal_lahir',
        'tempat_lahir', 'pendidikan', 'password', 'no_telp',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
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

    public function needsCommentApproval($model): bool
    {
        return false;
    }

}
