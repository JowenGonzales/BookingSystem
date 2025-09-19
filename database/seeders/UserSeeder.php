<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Staff::create([
            'name'     => 'Default Staff',
            'username' => 'staff01',
            'email'    => 'staff@example.com',
            'password' => Hash::make('password'), // change later for security
            'role'     => 'staff',
        ]);

        User::create([
            'name' => 'Default User',
            'email' => 'default@example.com',
            'role' => 'staff',
            'password' => Hash::make('password'), // 🔒 make sure to change this
        ]);
    }
}
