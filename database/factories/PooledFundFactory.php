<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PooledFund;
use App\Models\Chapter;

class PooledFundFactory extends Factory
{
    protected $model = PooledFund::class;

    public function definition(): array
    {
        // Define the list of causes
        $causes = [
            'Fire',
            'Flood',
            'Typhoon',
            'Earthquake',
            'Volcanic Eruption',
            'Feeding Program',
            'General'
        ];

        return [
            'chapter_id' => Chapter::inRandomOrder()->first()->id ?? Chapter::factory(),
            'total_cash' => $this->faker->randomFloat(2, 1000, 50000), // Random total cash amount
            'cause' => $this->faker->randomElement($causes), // Assign a random cause
        ];
    }
}
