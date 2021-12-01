<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'           => 1,
            'name'              => $this->faker->word,
            'brand'             => $this->faker->word,
            'image'             => $this->faker->imageUrl(1080, 720),
            'description'       => $this->faker->text(200),
            'sale_price'        => rand(1,500),
            'acquisition_price' => rand(1,500),
            'quantity'          => rand(1,20)
        ];
    }
}
