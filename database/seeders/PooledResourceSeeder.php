<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PooledResource;
use App\Models\Chapter;

class PooledResourceSeeder extends Seeder
{
    public function run(): void
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
        $allItems = collect($items)->flatten()->toArray();

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

        // Assign all causes to each chapter
        Chapter::all()->each(function ($chapter) use ($allItems, $causes, $items) {
            foreach ($causes as $cause) {
                // Add all items to the chapter for the assigned cause
                foreach ($allItems as $item) {
                    // Determine if the item has an expiration date
                    $hasExpiration = $this->itemHasExpiration($item, $items);

                    if ($hasExpiration) {
                        // For items with expiration dates, create multiple entries with different statuses
                        $this->createExpirableItem($chapter->id, $item, $cause);
                    } else {
                        // For items without expiration dates, create a single entry with status 'no-expiration'
                        PooledResource::create([
                            'chapter_id' => $chapter->id,
                            'item' => $item,
                            'quantity' => rand(10, 500), // Random quantity
                            'cause' => $cause, // Assign the cause
                            'status' => 'no_expiration', // Assign status
                        ]);
                    }
                }
            }
        });
    }

    /**
     * Check if an item has an expiration date.
     *
     * @param string $item
     * @param array $items
     * @return bool
     */
    private function itemHasExpiration(string $item, array $items): bool
    {
        // Items with expiration dates are in the "Basic Needs" and "Medical Supplies" categories
        return in_array($item, $items['Basic Needs']) || in_array($item, $items['Medical Supplies']);
    }

    /**
     * Create multiple entries for items with expiration dates.
     *
     * @param int $chapterId
     * @param string $item
     * @param string $cause
     * @return void
     */
    private function createExpirableItem(int $chapterId, string $item, string $cause): void
    {
        // Create 2 entries for items with expiration dates (one 'good', one 'near-expired')
        PooledResource::create([
            'chapter_id' => $chapterId,
            'item' => $item,
            'quantity' => rand(10, 500), // Random quantity
            'cause' => $cause, // Assign the cause
            'status' => 'good', // Assign status
        ]);

        PooledResource::create([
            'chapter_id' => $chapterId,
            'item' => $item,
            'quantity' => rand(10, 500), // Random quantity
            'cause' => $cause, // Assign the cause
            'status' => 'near_expired', // Assign status
        ]);
    }
}
