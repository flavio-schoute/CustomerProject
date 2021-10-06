<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create([
                'role_id' => 3,
            ]),
            'group_id' => Group::all(['id'])->random(1)->first(),
            'date_of_birth' => now()
        ];
    }
}
