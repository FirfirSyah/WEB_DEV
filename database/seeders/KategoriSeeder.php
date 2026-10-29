<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $daftar = [
            'Sejarah dan Asal-Usul',
            'Adat Istiadat dan Tradisi',
            'Kesenian dan Tarian',
            'Kuliner Tradisional',
            'Pakaian Adat',
            'Kerajinan dan Motif Tradisional',
            'Situs dan Tempat Bersejarah',
        ];

        foreach ($daftar as $nama) {
            Kategori::updateOrCreate(
                ['slug' => Str::slug($nama)],
                ['nama' => $nama]
            );
        }
    }
}