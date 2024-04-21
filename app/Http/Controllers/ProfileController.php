<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index_profile()
    {
        $user = auth()->user();
        $albums = $user->albums;
        $totalAlbumsCount = $user->albums->count();
        // foreach ($albums as $album) {
        //     $album->encrypted_id = Crypt::encrypt($album->id);
        // }
        $totalPhotosCount = 0;
        foreach ($user->albums as $album) {
            $totalPhotosCount += $album->Foto()->count();
        }
        $totalLikesCount = 0;

        foreach ($user->albums as $album) {
            foreach ($album->foto as $photo) {
                $totalLikesCount += $photo->likes()->count();
            }
        }

        $photos = auth()->user()->Foto()->get(); 
        // dd($photos);


        $isOwnProfile = auth()->check() && auth()->user()->id === $user->id;
        return view("profile.profile", compact('user', 'albums', 'isOwnProfile', 'totalAlbumsCount', 'totalPhotosCount', 'totalLikesCount', 'photos'));
    }

    public function editProfile()
    {
        return view('profile.editProfile');
    }

    public function updateProfile(Request $request)
    {
        //validasi
        $request->validate([
            'username' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users',
            'image' => 'image|mimes:jpeg,png,jpg|max:20480',
            'nama_lengkap' => 'required|max:255',
            'alamat' => 'required|max:255',
        ]);

        $user = Auth::user();

        $user->username = $request->username;
        $user->email = $request->email;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->alamat = $request->alamat;
        if ($request->hasFile('image')) {
            if ($user->image !== 'assets/profile/profile_default.jpg') {
                Storage::delete('public/' . $user->image);
            }
    
            $imagePath = $request->file('image')->store('public/image');
            $user->image = str_replace('public/', '', $imagePath);
        }
    
        // dd($user);

        $user->save();

        return redirect()->route('profile')->with('success', 'Ubah Profile berhasil');
    }
    

    public function show_album(Album $album ,$id)
    {
        $user = auth()->user();
        $album = Album::findOrFail($id);
        if ($album->user_id !== $user->id){
            'dsad';
        }
        $photos = $album->foto;
        return view('album.detailalbum', compact('user', 'album', 'photos'));
    }

    public function showProfile($username)
    {
            $user = User::where('username', $username)->firstOrFail();
            $albums = $user->albums;
            $totalAlbumsCount = $user->albums->count();
            // foreach ($albums as $album) {
            //     $album->encrypted_id = Crypt::encrypt($album->id);
            // }
            $totalPhotosCount = 0;
            foreach ($user->albums as $album) {
                $totalPhotosCount += $album->Foto()->count();
            }
            $totalLikesCount = 0;
    
            foreach ($user->albums as $album) {
                foreach ($album->Foto as $photo) {
                    $totalLikesCount += $photo->likes()->count();
                }
            }
            $photos = $album->Foto;
            
            $isOwnProfile = auth()->check() && auth()->user()->id === $user->id;
            return view("profile.profile", compact('user', 'albums', 'isOwnProfile', 'totalAlbumsCount', 'totalPhotosCount', 'totalLikesCount', 'photos'));
        
    }



    public function deletePhoto($id)
    {
        // Temukan foto berdasarkan ID
        $photo = Foto::find($id);

        // Pastikan foto ditemukan
        if (!$photo) {
            return redirect()->back()->with('error', 'Foto tidak ditemukan.');
        }

        // Pastikan pengguna yang sedang masuk adalah pemilik foto
        if ($photo->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus foto ini.');
        }

        // Hapus foto dari basis data
        $photo->delete();

        // Berikan respons bahwa foto berhasil dihapus
        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }

}
