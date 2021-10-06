<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::factory()->create([
            'user_id' => User::where('role_id', 3)->get()->random()->id,
            'group_id' => Group::pluck('id')->random()
        ]);
    }
}
