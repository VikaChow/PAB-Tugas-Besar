<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nrp',
        'name',
        'email',
        'password',
        'role',
        'department_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi: User bernaung di bawah satu Departemen/Prodi
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Relasi: User (Mahasiswa) bisa memiliki banyak pengajuan surat
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}