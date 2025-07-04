<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TireService;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TireService>
 */
class TireServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = TireService::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Шиномонтаж',
            'image_path' => 'storage/images/tire_service.png',
            'room_count' => $this->faker->numberBetween(1, 5),
            'floor' => $this->faker->numberBetween(1, 3),
            'area' => $this->faker->randomFloat(1, 50, 200),
            'description' => $this->faker->paragraph,
        ];
    }
}
