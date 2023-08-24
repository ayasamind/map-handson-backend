<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Map;
use App\Models\Pin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Map::factory()
                ->has(
                    Pin::factory()
                    ->count(10)
                    ->state(function (array $attributes) {
                        $latmax = 33.65;
                        $latmin = 33.55;
                        $lonmax = 130.35;
                        $lonmin = 130.50;
                        return [
                            'lat' => $latmin + mt_rand() / mt_getrandmax() * ($latmax - $latmin),
                            'lon' => $lonmin + mt_rand() / mt_getrandmax() * ($lonmax - $lonmin),
                            'description' => 'ピンの概要が入りますピンの概要が入りますピンの概要が入りますピンの概要が入ります'
                        ];
                    })
                )
                ->create([
                    'description' => 'MAPの概要が入りますMAPの概要が入りますMAPの概要が入ります',
                    'center_lat' => 33.5959,
                    'center_lon' => 130.4017,
                    'zoom_level' => 12,
                ]);
        }
    }
}
