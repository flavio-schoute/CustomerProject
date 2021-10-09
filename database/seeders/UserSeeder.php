<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
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
        User::factory()->create([
            'email' => 'test@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('admin'),
        ]);

        User::factory()->create([
            'email' => 'test2@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('admin'),
        ]);

        User::factory()
            ->has(Student::factory(), 'student')
            ->create([
            'email' => 'student@gmail.com',
            'role_id' => 3,
        ]);

        User::factory()
            ->has(Teacher::factory(), 'teacher')
            ->create([
                'email' => 'docent@gmail.com',
                'role_id' => 2,
            ]);

        User::factory(25)->create();
    }
}
