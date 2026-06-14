<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $if = Department::create(['name' => 'Teknik Informatika']);
        $si = Department::create(['name' => 'Sistem Informasi']);

        // Mahasiswa Teknik Informatika
        User::create([
            'nrp' => '2272001',
            'name' => 'Vika (Mhs IF)',
            'email' => 'vika@mahasiswa.com',
            'password' => Hash::make('12345678'),
            'role' => 'mahasiswa',
            'department_id' => $if->id,
        ]);

        // Mahasiswa Sistem Informasi
        User::create([
            'nrp' => '2273001',
            'name' => 'Eli (Mhs SI)',
            'email' => 'Eli@mahasiswa.com',
            'password' => Hash::make('12345678'),
            'role' => 'mahasiswa',
            'department_id' => $si->id,
        ]);

        // Kaprodi Teknik Informatika
        User::create([
            'nrp' => 'D00123',
            'name' => 'Dosen Kaprodi IF',
            'email' => 'kaprodi_if@dosen.com',
            'password' => Hash::make('12345678'),
            'role' => 'kaprodi',
            'department_id' => $if->id,
        ]);

        // Kaprodi Sistem Informasi
        User::create([
            'nrp' => 'D00456',
            'name' => 'Dosen Kaprodi SI',
            'email' => 'kaprodi_si@dosen.com',
            'password' => Hash::make('12345678'),
            'role' => 'kaprodi',
            'department_id' => $si->id,
        ]);

        // Staf TU / Manager Teknik Informatika
        User::create([
            'nrp' => 'T00789',
            'name' => 'Staf TU / Manager IF',
            'email' => 'tu_if@admin.com',
            'password' => Hash::make('12345678'),
            'role' => 'tu',
            'department_id' => $if->id,
        ]);

        // Staf TU / Manager Sistem Informasi
        User::create([
            'nrp' => 'T00101',
            'name' => 'Staf TU / Manager SI',
            'email' => 'tu_si@admin.com',
            'password' => Hash::make('12345678'),
            'role' => 'tu',
            'department_id' => $si->id,
        ]);
    }
}