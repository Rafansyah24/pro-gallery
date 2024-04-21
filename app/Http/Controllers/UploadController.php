<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function index_upload()
    {
         $album = Album::where('user_id', Auth::id())->pluck('nama_album', 'id');
        return view('upload.upload', compact('album'));
    }

    public function uploadFoto(Request $request)
    {
    // Validasi permintaan
    $request->validate([
        'judul_foto' => 'required|string',
        'desc' => 'nullable|string',
        'file_foto' => 'required|image|mimes:png,jpg,jpeg|max:20480',
        'album_id' => ['required', 'exists:albums,id', function ($attribute, $value, $fail) {
            if (!auth()->user()->albums->contains('id', $value)) {
                $fail('The selected album is not owned by the authenticated user.');
            }
        }],
    ]);   

    // Simpan foto ke dalam penyimpanan Laravel
    $path = $request->file('file_foto')->store('photos', 'public');

    // Simpan foto ke dalam basis data
    $photo = new Foto();
    $photo->album_id = $request->album_id;
    $photo->user_id = Auth::id(); // Menggunakan ID pengguna yang sedang login
    $photo->judul_foto = $request->judul_foto;
    $photo->desc = $request->desc;
    $photo->file_foto = $path;
    $photo->save();

    // Redirect atau kembali ke halaman yang sesuai
    return redirect()->route('home')->with('success', 'Foto Berhasil Di Upload');
    }

    public function dataFoto()
    {
        $dfoto = Foto::all();
        return view('dashboard.data_foto', compact('dfoto'));
    }

    public function dataReport()
    {
        return view('dashboard.data_report');
    }

}