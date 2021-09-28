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
            'first_name' => 'Test',
            'last_name' => 'Person',
            'email' => 'test@gmail.com',
            'role_id' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
        ]);

        User::create([
            'first_name' => 'Test',
            'last_name' => 'Person',
            'email' => 'test2@gmail.com',
            'role_id' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
        ]);
    }
}
