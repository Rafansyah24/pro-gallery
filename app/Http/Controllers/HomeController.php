<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Like;
use App\Models\User;
use App\Models\Komentar;
use App\Models\Report;
use App\Models\Violation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    public function index_home()
    {
        $photos = Foto::all();
        
        return view('landingpage.landing_page', compact('photos'));
    }

    public function index_report()
    {
        $foto = Foto::all();
        
        return view('landingpage.report', compact('foto'));
    }


    public function show_foto($id)
    {
        $foto = Foto::findOrFail($id);
        $reports = Violation::all();

        
        $totalLikes = $foto->likes()->count();

        if ($foto->album) {
            $user = $foto->album->user;

            if ($user) {
                $userName = $user->username;
                $userProfileImage = $user->image;
            }
        }

        $komentar = $foto->komentar;
        
        return view('landingpage.detailfoto', compact('foto', 'user','userName', 'userProfileImage','komentar', 'totalLikes' ,'reports'));
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

        $message = 'Added comment to photo successfully.';
        activity()
        ->performedOn(Foto::find($request['foto_id']))
        ->causedBy(Auth::user())
        ->log($message);

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

        $message = $existingLike ? 'Photo unliked successfully.' : 'Photo liked successfully.';
        activity()
            ->performedOn(Foto::find($request['foto_id']))
            ->causedBy(Auth::user())
            ->log($message);

        

        return redirect()->back()->with('success', $message);
    }


    public function search(Request $request) 
    {
        $search = $request->input('search');

        $photos = Foto::where('judul_foto', 'like', '%' . $search . '%')->get();
        $users = User::where('username', 'like', '%' . $search . '%')->get();

        return view('landingpage.landing_page', compact('photos', 'users', 'search'));
    }


    public function laporFoto(Request $request, $foto_id) 
    {
        $request->validate([
            'report_id' => 'required|exists:reports,id', // Pastikan report_id yang dikirimkan valid
        ]);
    
        // Dapatkan report berdasarkan report_id yang dipilih
        $report = Violation::findOrFail($request->report_id);
    
        $reportPhoto = new Violation();
        $reportPhoto->foto_id = $foto_id;
        $reportPhoto->description = $report->category; // Isi keterangan dengan report_type
        $reportPhoto->save();
    
        return redirect()->back()->with('success', 'Foto telah ditambahkan ke laporan.');
    }
    
}
