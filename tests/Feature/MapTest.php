<?php

namespace Tests\Feature;

use App\Models\Map;
use App\Models\Pin;
use Tests\FeatureTestCase;

class MapTest extends FeatureTestCase
{
    /**
     * testマップ詳細情報が取得できるか
     */
    public function testマップ詳細情報が取得できるか(): void
    {
        $maps = Map::factory(10)
            ->has(Pin::factory(3), 'pins')
            ->create();

        $map = $maps->random();
        $response = $this->get('/api/maps/'.$map->id);

        $response->assertJsonStructure([
            'title',
            'description',
            'center_lat',
            'center_lon',
            'pins' => [
                '*' => [
                    'title',
                    'description',
                    'lat',
                    'lon',
                ],
            ],
            'zoom_level',
        ]);
        $response->assertStatus(200);

        $pins = $this->getPins($map);
        $response->assertExactJson([
            'title' => $map->title,
            'description'  => $map->description,
            'center_lat'  => $map->center_lat,
            'center_lon'  => $map->center_lon,
            'pins' => $pins,
            'zoom_level' => $map->zoom_level,
        ]);
    }

    /**
     * test存在しないマップの場合404
     */
    public function test存在しないマップの場合404(): void
    {
        $response = $this->get('/api/maps/999');

        $response->assertStatus(404);
    }

    /**
     * testマップのピン名で検索できるか
     */
    public function testマップのピン名で検索できるか(): void
    {
        $map = Map::factory()
            ->has(Pin::factory(2), 'pins')
            ->create();
        $targetPin = Pin::factory()->create([
            'map_id' => $map->id,
            'title' => 'テスト',
        ]);

        $response = $this->get('/api/maps/'.$map->id.'?pin=テス');

        $response->assertStatus(200);

        $response->assertExactJson([
            'title' => $map->title,
            'description'  => $map->description,
            'center_lat'  => $map->center_lat,
            'center_lon'  => $map->center_lon,
            'pins' => [
                [
                    'title' => $targetPin->title,
                    'description' => $targetPin->description,
                    'lat' => $targetPin->lat,
                    'lon' => $targetPin->lon,
                ]
            ],
            'zoom_level' => $map->zoom_level,
        ]);
    }

    private function getPins(Map $map): array
    {
        $pins = [];
        foreach ($map->pins as $index => $pin) {
            $pins[$index] = [
                'title' => $pin->title,
                'description' => $pin->description,
                'lat' => $pin->lat,
                'lon' => $pin->lon
            ];
        }
        return $pins;
    }
}
