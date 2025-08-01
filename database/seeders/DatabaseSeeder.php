<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Kelas;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name'     => 'Admin',
            'email'    => 'anjani@gmail.com',
            'password' => Hash::make('11221122'),
        ]);

        $kelas = [
            ['kode' => 'I', 'nama' => 'Satu'],
            ['kode' => 'II', 'nama' => 'Dua'],
            ['kode' => 'III', 'nama' => 'Tiga'],
            ['kode' => 'IV', 'nama' => 'Empat'],
            ['kode' => 'V', 'nama' => 'Lima'],
            ['kode' => 'VI', 'nama' => 'Enam'],
        ];

        foreach ($kelas as $k) {
            Kelas::create($k);
        }

        $kategori = [
            ['nama' => 'Fiksi'],
            ['nama' => 'Non Fiksi'],
        ];

        foreach ($kategori as $k) {
            Kategori::create($k);
        }
    }
}
