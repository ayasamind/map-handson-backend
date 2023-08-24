<?php

namespace Tests\Feature;

use App\Models\Map;
use Illuminate\Http\Response;
use Tests\FeatureTestCase;

class PinTest extends FeatureTestCase
{
    /**
     * testピンの作成ができるか
     */
    public function testマップ詳細情報が取得できるか(): void
    {
        $map = Map::factory()->create();
        $pins = [
            [
                'title' => 'テスト',
                'description' => 'テスト',
                'lat' => 35.681236,
                'lon' => 139.767125,
            ],
            [
                'title' => 'テスト',
                'description' => 'テスト',
                'lat' => 35.681236,
                'lon' => 139.767125,
            ],
        ];

        $response = $this->post('/api/pins/create', [
            'map_id' => $map->id,
            'pins' => $pins,
        ]);

        $response->assertJsonStructure([
            'message',
            'pins' => [
                '*' => [
                    'title',
                    'description',
                    'lat',
                    'lon',
                ],
            ],
        ]);
        $response->assertStatus(200);

        $pins = $this->getPins($map);
        $response->assertExactJson([
            'message' => 'ピンを作成しました',
            'pins' => $pins,
        ]);
    }

    /**
     * testピン作成時にバリデーションエラーになるか
     * @dataProvider dataProviderCreatePins
     */
    public function testピン作成時にバリデーションエラーになるか($data, $errors): void
    {
        $response = $this->post('/api/pins/create', $data);
        $this->assertEquals($response->getStatusCode(), Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertEquals($response->json()['errors'], $errors);
    }

    public static function dataProviderCreatePins()
    {
        return [
            'required' => [
                'data' => [
                    'map_id' => null,
                    'pins' => [
                        [
                            'title' => null,
                            'lat' => null,
                            'lon' => null
                        ],
                    ],
                ],
                'errors' => [
                    'map_id' => [
                        'マップIDは必ず指定してください'
                    ],
                    'pins.0.title' => [
                        'タイトルは必ず指定してください',
                    ],
                    'pins.0.lat' => [
                        '緯度は必ず指定してください',
                    ],
                    'pins.0.lon' => [
                        '経度は必ず指定してください',
                    ]
                ]
            ],
            '存在しないMapID' => [
                'data' => [
                    'map_id' => 999999,
                    'pins' => [
                        [
                            'title' => 'テスト',
                            'description' => 'テスト',
                            'lat' => 35.681236,
                            'lon' => 139.767125,
                        ],
                    ],
                ],
                'errors' => [
                    'map_id' => [
                        '選択されたマップIDは正しくありません'
                    ],
                ]
            ],
        ];
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
