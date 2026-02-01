<?php

namespace Database\Factories;

use App\Models\Sneaker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Sneaker>
 */
class SneakerFactory extends Factory
{
    protected $model = Sneaker::class;

    public function definition(): array
    {
        $brands = ['Nike', 'Adidas', 'Puma', 'New Balance', 'Converse', 'Reebok'];
        $models = ['Runner', 'Court', 'Street', 'Lite', 'Classic', 'Flow'];

        return [
            'brand' => $this->faker->randomElement($brands),
            'model' => $this->faker->randomElement($models),
            'color' => $this->faker->safeColorName(),
            'price' => $this->faker->randomFloat(2, 60, 200),
            'image_url' => $this->faker->imageUrl(640, 480, 'fashion', true),
            'description' => $this->faker->sentence(),
        ];
    }
}

