<?php

namespace Database\Seeders;

use App\Models\Violation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ViolationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Menambahkan beberapa contoh jenis pelanggaran
         $types = [
            'Konten Tidak Pantas',
            'Pelanggaran Hak Cipta',
            'Spam',
            // Tambahkan lebih banyak jenis pelanggaran jika diperlukan
        ];

        foreach ($types as $type) {
            Violation::create([
                'category' => $type,
            ]);
        }
    }
}