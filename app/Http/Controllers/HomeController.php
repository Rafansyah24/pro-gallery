<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Like;
use App\Models\User;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index_home()
    {
        $photos = Foto::all();
        
        return view('landingpage.landing_page', compact('photos'));
    }

    public function show_foto($id)
    {
        $foto = Foto::findOrFail($id);

        
        $totalLikes = $foto->likes()->count();

        if ($foto->album) {
            $user = $foto->album->user;

            if ($user) {
                $userName = $user->username;
                $userProfileImage = $user->image;
            }
        }

        $komentar = $foto->komentar;
        
        return view('landingpage.detailfoto', compact('foto', 'user','userName', 'userProfileImage','komentar', 'totalLikes'));
    }
    
    public function storeKomentar(Request $request)
    {
        $request->validate([
            'foto_id' => 'required|exists:fotos,id',
            'isi_komentar' => 'required|string|max:255',
        ]);

        $comment = new Komentar();
        $comment->foto_id = $request['foto_id'];
        $comment->user_id = auth()->user()->id;
        $comment->isi_komentar = $request['isi_komentar'];
        $comment->save();
        // dd($comment);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    public function like(Request $request)
    {
        $request->validate([
            'foto_id' => 'required|exists:fotos,id',
        ]);

        $userId = Auth::id();
        $fotoId = $request->foto_id;

        $existingLike = Like::where('user_id', $userId)
            ->where('foto_id', $fotoId)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            $message = 'Photo unliked successfully.';
        } else {
            Like::create([
                'user_id' => $userId,
                'foto_id' => $fotoId,
            ]);
            $message = 'Photo liked successfully.';
        }

        

        return redirect()->back()->with('success', $message);}

    
}
