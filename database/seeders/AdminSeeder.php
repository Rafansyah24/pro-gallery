<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'password' => bcrypt('12345678'), // sesuaikan dengan kata sandi yang Anda inginkan
            'email' => 'admin@example.com',
            'nama_lengkap' => 'Admin',
            'alamat' => 'Alamat Admin',
            'role' => 'admin', // atur role ke 'admin'
        ]);
    }
}
