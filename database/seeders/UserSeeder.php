<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Test person',
            'email' => 'test@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
        ]);

        User::create([
            'name' => 'Test person 2',
            'email' => 'test2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
        ]);
    }
}
