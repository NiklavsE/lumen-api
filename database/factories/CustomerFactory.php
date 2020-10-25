<?php

namespace Database\Factories;

use App\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'surname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'gender' => $this->faker->randomElement(array('male','female','randomString')),
            'soc_security_num' => $this->faker->ssn,
            'balance' => $this->faker->randomFloat(2),
        ];
    }
}
