<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Natasya',
            'email' => 'natasya@gmail.com',
            'password' => Hash::make('natasya123')
        ]);
    }
}
