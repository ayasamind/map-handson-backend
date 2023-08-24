<?php

namespace App\UseCases\Map;

use App\Models\Map;

class CreateAction
{
    public function __invoke(array $params): Map
    {
        return Map::create($params);
    }
}
