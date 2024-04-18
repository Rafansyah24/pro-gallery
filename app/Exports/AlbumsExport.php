<?php

namespace App\Exports;

use App\Models\Album;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AlbumsExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Dapatkan data album yang dimiliki oleh pengguna yang saat ini login
        $userId = auth()->id();
        $albums = Album::where('user_id', $userId)->get();

        // Ubah data album menjadi array untuk diekspor
        $data = [];
        foreach ($albums as $album) {
            $data[] = [
                'User ID' => $album->user_id,
                'Username' => $album->user->username,
                'Album Name' => $album->nama_album,
                'Description' => $album->desc,
                'Photo' => $album->photo,
            ];
        }

        // Kembalikan koleksi data yang akan diekspor
        return collect($data);
    }

    public function headings(): array
    {
        return [
            'User ID',
            'Username',
            'Album',
            'Description',
            'Photo',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style untuk heading kolom
            1 => ['font' => ['bold' => true]],
            // Misalnya, untuk memberi warna latar belakang pada heading kolom
            'A1:E1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'B0E0E6']]]
        ];
    }
}
