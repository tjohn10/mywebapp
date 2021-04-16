<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
$factory->define(Review::class, function (Faker $faker) {
    return [
        'review' => $faker->paragraph,
        'rating' => $faker->numberBetween(0, 5),
        'user_id' => function() {
            return User::all()->random();
        },
    ];
});


    public function definition()
    {
        // TODO: Implement definition() method.
    }
}
