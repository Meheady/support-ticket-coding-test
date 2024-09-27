<?php

namespace Database\Seeders;

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
        User::create([
            'name' => 'Admin User',
            'email' => 'hmmehedi55@gmail.com',
            'password' => Hash::make('password'),
            'type' => 'admin',
        ]);

        User::create([
            'name' => 'Customer User',
            'email' => 'necit.meheady@gmail.com',
            'password' => Hash::make('password'),
            'type' => 'customer',
        ]);
    }
}
