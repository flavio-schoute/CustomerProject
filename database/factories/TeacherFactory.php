<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create([
                'role_id' => 2,
            ]),
            'phone_number' => $this->faker->phoneNumber('NL'),
        ];
    }
}
