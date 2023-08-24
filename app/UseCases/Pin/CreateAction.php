<?php

namespace App\UseCases\Pin;

use App\Models\Map;
use Illuminate\Database\Eloquent\Collection;

class CreateAction
{
    public function __invoke(Map $map, array $params): Collection
    {
        return $map->pins()->createMany($params['pins']);
    }
}
