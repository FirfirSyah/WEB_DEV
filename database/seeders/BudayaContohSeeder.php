<?php

namespace Database\Seeders;

use App\Models\Budaya;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BudayaContohSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Kategori::all() as $kategori) {
            for ($i = 1; $i <= 2; $i++) {
                $judul = "[CONTOH] Data Uji {$kategori->nama} {$i}";

                $budaya = Budaya::updateOrCreate(
                    ['slug' => Str::slug($judul)],
                    [
                        'kategori_id' => $kategori->id,
                        'judul'       => $judul,
                        'ringkasan'   => 'Data contoh untuk menguji tampilan katalog. Bukan informasi budaya yang sebenarnya.',
                        'deskripsi'   => 'Ini adalah data contoh (placeholder) untuk menguji tampilan, pencarian, filter, dan pagination. Isinya bukan fakta budaya Sambas. Ganti atau hapus data ini setelah informasi budaya yang terverifikasi tersedia.',
                        'status'      => 'published',
                    ]
                );

                $budaya->sumbers()->updateOrCreate(
                    ['judul_sumber' => '[CONTOH] Sumber belum diverifikasi'],
                    ['catatan' => 'Placeholder. Ganti dengan sumber rujukan yang nyata.']
                );
            }
        }
    }
}