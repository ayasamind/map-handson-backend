<?php

namespace App\UseCases\Map;

use App\Models\Map;
use Illuminate\Support\Collection;

class IndexAction
{
    public function __invoke(?string $title): Collection
    {
        return Map::when($title, function ($query) use ($title) {
            return $query->where('title', 'LIKE', "%{$title}%");
        })->get();
    }
}
