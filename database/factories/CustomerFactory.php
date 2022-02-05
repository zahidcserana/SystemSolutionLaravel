<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => $this->faker->phoneNumber(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'balance' => $this->faker->numberBetween(0, 5000),
            'company_name' => $this->faker->company(),
            'company_type' => $this->faker->jobTitle(),
            'billing_type' => Customer::BILL_TYPE_MONTHLY,
            'bill_amount' => $this->faker->numberBetween(0, 1000),
            'active' => $this->faker->boolean(),
            'bill_start_date' => $this->faker->date()
        ];
    }
}
