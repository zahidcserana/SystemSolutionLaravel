<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $amount = $this->faker->numberBetween(0, 10000);
        $paid = $this->faker->numberBetween(0, $amount);
        $status = $paid == 0 ? 'pending' : ($paid == $amount ? 'paid' : 'due');

        return [
            'type' => $this->faker->randomElement(['monthly', 'yearly', 'fixed']),
            'for_date' => $this->faker->date(),
            'amount' => $amount,
            'paid' => $paid,
            'status' => $status,
        ];
    }
}
