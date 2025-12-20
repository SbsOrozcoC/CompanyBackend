<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'first_name'     => $this->faker->firstName,
            'last_name'      => $this->faker->lastName,
            'identification' => $this->faker->unique()->numerify('##########'),
            'address'        => $this->faker->address,
            'phone'          => $this->faker->numerify('##########'),
            'city_id'        => City::factory(),
        ];
    }
}
