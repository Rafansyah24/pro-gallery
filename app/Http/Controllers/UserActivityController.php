<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserActivityExport;
use Spatie\Activitylog\Models\Activity;

class UserActivityController extends Controller
{
    public function showActivityLog()
    {
        // Ambil data aktivitas pengguna dari database
        $activities = Activity::latest()->get();


        // Kirim data aktivitas pengguna ke tampilan
        return view('dashboard.data_log', compact('activities'));
    }


    public function exportUserActivity()
    {
        // Dapatkan ID pengguna yang saat ini masuk
        $userId = auth()->id();
        // $comment = auth()->user()->id;

        // Dapatkan semua log aktivitas yang berhubungan dengan pengguna dengan ID tersebut
        $userActivities = Activity::where('causer_id', $userId)
            ->where('causer_type', 'App\Models\User')
            ->get();

        // Ekspor data aktivitas pengguna ke dalam file Excel
        return Excel::download(new UserActivityExport($userActivities), 'user_activity.xlsx');
    }


    public function exportAllUserActivity()
    {
    // Pastikan pengguna yang melakukan aksi ini adalah admin
    if (auth()->user()->role !== 'admin') {
        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengakses fitur ini.');
    }

    // Dapatkan semua log aktivitas dari semua pengguna
    $allUserActivities = Activity::all();

    // Ekspor data aktivitas semua pengguna ke dalam file Excel
    return Excel::download(new UserActivityExport($allUserActivities), 'all_user_activity.xlsx');
    }
    // Anda bisa menambahkan lebih banyak metode di sini untuk menangani operasi lain terkait aktivitas pengguna

}
