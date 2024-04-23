<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;



class AuthController extends Controller
{
    public function register()
    {
        return view('login.register');
    }

    public function registerStore(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|unique:users|max:255',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users',
            'nama_lengkap' => 'required|max:255',
            'alamat' => 'required|max:255',
        ]);

        $defaultImage = 'assets/profile/profile_default.jpg';

        $data['password'] = bcrypt($data['password']);
        $data['image'] = $defaultImage;

        // dd($data);

        User::create($data);

        return redirect()->route('login')->with('success', 'Registrasi berhasil');
    }
  
    public function login()
    {
        return view('login.login');
    }

    public function loginStore(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|max:255',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($data)) {
            activity()
                ->causedBy(Auth::user())
                ->log('User successfully logged in.');
            // Check if the authenticated user is an admin
            if (Auth::user()->role === 'admin') {
                // If the user is an admin, redirect to the admin dashboard
                return redirect()->route('dashboard.dashboard')->with('success', 'Login berhasil');
            } else {
                // If the user is not an admin, redirect to the user dashboard or any other route you prefer
                return redirect()->route('home')->with('success', 'Login berhasil');
            }
        } else {
            // If authentication fails, redirect back to the login page with an error message
            return redirect()->route('login')->with('error', 'Username atau password salah.');
        }
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out!');
    }
}
