<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PooledFund;
use App\Models\Chapter;

class PooledFundSeeder extends Seeder
{
    public function run(): void
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

        // Assign all causes to each chapter
        Chapter::all()->each(function ($chapter) use ($causes) {
            foreach ($causes as $cause) {
                PooledFund::create([
                    'chapter_id' => $chapter->id,
                    'total_cash' => rand(1000, 50000), // Random total cash amount
                    'cause' => $cause, // Assign the cause
                ]);
            }
        });
    }
}
