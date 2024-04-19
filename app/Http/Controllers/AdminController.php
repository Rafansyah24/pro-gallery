<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index_dashboard()
    {
        // Mengambil semua pengguna dengan peran admin dari database
        $admins = User::where('role', 'admin')->get();

        // Menampilkan halaman dashboard admin dan meneruskan data pengguna ke dalam view
        return view('dashboard.dashboard', ['admins' => $admins]);
    }
}
