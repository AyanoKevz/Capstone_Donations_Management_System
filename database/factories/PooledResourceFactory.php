<?php

namespace Database\Factories;

use App\Models\PooledResource;
use App\Models\Chapter;
use Illuminate\Database\Eloquent\Factories\Factory;

class PooledResourceFactory extends Factory
{
    protected $model = PooledResource::class;

    public function definition(): array
    {
        // Define the items and categorize them
        $items = [
            // Items with expiration dates
            "Basic Needs" => ["Bottled Water", "Canned Goods", "5kg Packaged Rice", "Packed Biscuits", "Instant Noodles"],
            "Medical Supplies" => ["Adhesive Tape", "Bandages and Gauze", "Alcohol/Disinfectants", "Masks (N95 or surgical)"],

            // Items without expiration dates
            "Clothing and Bedding" => ["Blankets", "Towels", "Jackets/Sweaters", "New Clothes", "Slippers"],
            "Hygiene Kits" => ["Soap", "Sachet Shampoo", "Toothpaste", "Toothbrushes", "Baby Diapers"],
        ];

        // Flatten the items into a single array
        $flattenedItems = collect($items)->flatten()->toArray();

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

        // Randomly select an item
        $item = $this->faker->randomElement($flattenedItems);

        // Determine if the item has an expiration date
        $hasExpiration = in_array($item, $items['Basic Needs']) || in_array($item, $items['Medical Supplies']);

        // Assign status based on whether the item has an expiration date
        $status = $hasExpiration ? $this->faker->randomElement(['good', 'near_expired']) : 'no_expiration';

        return [
            'item' => $item,
            'quantity' => $this->faker->numberBetween(10, 500), // Random quantity
            'chapter_id' => Chapter::inRandomOrder()->first()->id, // Assign to a random chapter
            'cause' => $this->faker->randomElement($causes), // Assign a random cause
            'status' => $status, // Assign a logical status
        ];
    }
}
