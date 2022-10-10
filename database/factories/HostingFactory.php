<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HostingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = \App\Models\User::inRandomOrder()->first();
        return [
            'domain' => 'test.co.zw',
            'billing_cycle' => 'monthly',
            'package' => 'freehosting',
            'user_id' => $user->id,
        ];
    }
}
