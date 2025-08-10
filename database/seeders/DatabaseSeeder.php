<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat role jika belum ada
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $pustakawanRole = Role::firstOrCreate(['name' => 'pustakawan']);

        // Buat user Admin jika belum ada
        if (!User::where('email', 'anjani@gmail.com')->exists()) {
            $admin = User::create([
                'name'     => 'Admin',
                'email'    => 'anjani@gmail.com',
                'password' => Hash::make('11221122'),
            ]);
            $admin->assignRole($adminRole);
        }

        // Buat user Pustakawan jika belum ada
        if (!User::where('email', 'pustakawan@example.com')->exists()) {
            $pustakawan = User::create([
                'name'     => 'Pustakawan',
                'email'    => 'pustakawan@example.com',
                'password' => Hash::make('12345678'), // kalau tidak bisa 12345678, gunakan pass: password
            ]);
            $pustakawan->assignRole($pustakawanRole);
        }

        // Data kelas
        $kelas = [
            ['kode' => 'I', 'nama' => 'Satu'],
            ['kode' => 'II', 'nama' => 'Dua'],
            ['kode' => 'III', 'nama' => 'Tiga'],
            ['kode' => 'IV', 'nama' => 'Empat'],
            ['kode' => 'V', 'nama' => 'Lima'],
            ['kode' => 'VI', 'nama' => 'Enam'],
        ];

        foreach ($kelas as $k) {
            Kelas::firstOrCreate($k);
        }

        // Data kategori
        $kategori = [
            ['nama' => 'Fiksi'],
            ['nama' => 'Non Fiksi'],
        ];

        foreach ($kategori as $k) {
            Kategori::firstOrCreate($k);
        }
    }
}
