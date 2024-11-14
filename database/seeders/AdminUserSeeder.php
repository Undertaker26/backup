<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'student_id' => 'none',
            'username' => 'Admin',
            'course' => 'none',
            'status' => 'alumni',
            'email' => 'admin@example.com',
            'usertype' => 'admin',
            'password' => Hash::make('admin2024qweRty'),       
    
        ]);
    }
}
