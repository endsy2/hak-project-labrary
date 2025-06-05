<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Senghak',
            'email' => 'senghak@example.com',
            'password' => Hash::make('062005'),
            // add other required fields
        ]);
    }
}