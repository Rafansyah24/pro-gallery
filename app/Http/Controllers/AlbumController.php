<?php

namespace App\Http\Controllers;

use App\Exports\AlbumsExport;
use App\Models\Foto;
use App\Models\Album;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; 



class AlbumController extends Controller
{
    public function index_create()
    {
        return view('album.createalbum');
    }

    

    public function create_album(Request $request)
    {
          // Validasi data yang dikirimkan
          $validated = $request->validate([
            'nama_album' => 'required|string',
            'desc' => 'nullable|string',
            'photo' => 'required|image|mimes:png,jpg,jpeg|max:20480',
        ]);

        // Simpan foto ke dalam penyimpanan Laravel
        $path = $request->file('photo')->store('photos', 'public');

        $album = Album::create([
            'user_id' => auth()->id(), // Ambil ID pengguna yang sedang login
            'nama_album' => $validated['nama_album'],
            'desc' => $validated['desc'],
            'photo' => $path, // Simpan foto ke dalam direktori 'photos'
        ]);

        // Redirect pengguna ke halaman yang sesuai setelah foto berhasil disimpan
        return redirect()->route('profile')->with('success', 'Album created successfully.');
    }

    public function hapus_album($id)
    {
         // Cari album berdasarkan ID
         $album = Album::find($id);

         // Jika album tidak ditemukan, kembalikan response not found
         if (!$album) {
             return response()->json(['message' => 'Album not found'], 404);
         }
 
         // Hapus album
         $album->delete();
 
        // Redirect pengguna ke halaman yang sesuai setelah foto berhasil disimpan
        return redirect()->route('profile')->with('success', 'Album Delete successfully.');
    }


    public function exportAlbumToExcel()
    {
        // Dapatkan nama pengguna dari pengguna yang saat ini login
        $username = auth()->user()->username;

        // Dapatkan ID pengguna dari nama pengguna
        $userId = User::where('username', $username)->value('id');

        // Dapatkan data album yang dimiliki oleh pengguna dengan ID yang diperoleh
        $albums = Album::where('user_id', $userId)->get();

        // Tambahkan kolom baru "username" ke setiap item album
        foreach ($albums as $album) {
            $album->username = $username;
        }

        // Ekspor data album ke dalam file Excel
        return Excel::download(new AlbumsExport($albums), 'albums.xlsx');
    }

}