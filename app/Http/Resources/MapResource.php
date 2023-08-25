<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'center_lat' => $this->resource->center_lat,
            'center_lon' => $this->resource->center_lon,
            'pins' => PinResource::collection($this->resource->pins),
            'zoom_level' =>  $this->resource->zoom_level,
        ];
    }
}
