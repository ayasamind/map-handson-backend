<?php

namespace App\UseCases\Map;

use App\Models\Map;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShowAction
{
    public function __invoke(int $mapId, ?string $pin): Map
    {
        return Map::with(['pins' => function (HasMany $query) use ($pin) {
                $query->where('pins.title', 'like', "%$pin%");
            }])->findOrFail($mapId);
    }
}
