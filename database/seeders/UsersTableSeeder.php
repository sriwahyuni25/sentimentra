<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Shani Indira Natio',
            'email' => 'shaninatio@gmail.com',
            'password' => Hash::make('password'),
        ]);
        // Tambahkan data user lainnya sesuai kebutuhan
    }
}
