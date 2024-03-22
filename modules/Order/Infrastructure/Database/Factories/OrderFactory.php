<?php

namespace Modules\Order\Infrastructure\Database\Factories;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Order\Order;
use Modules\Product\Database\factories\ProductFactory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => UserFactory::new(),
            'status' => Order::COMPLETED,
            'total_in_cents' => $this->faker->randomNumber(),
        ];
    }
}
