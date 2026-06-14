<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'user_id',
        'department_id',
        'type',
        'description',
        'status',
        'file_path'
    ];

    // Relasi balik ke Mahasiswa pemilik surat
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi balik ke Prodi terkait
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}