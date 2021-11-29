<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = ['Completed', 'Snoozed', 'Overdue'];
        return [
            'user_id' => rand(1,10),
            'category_id' => rand(1,10),
            'name' => $this->faker->name,
            'description' => $this->faker->text(),
            'status' => $status[rand(0,2)],
        ];
    }
}
