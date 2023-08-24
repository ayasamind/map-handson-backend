<?php

namespace App\Http\Requests\Pin;

use App\Http\Requests\ApiRequest;
use App\Models\Map;

class CreateRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'map_id' => 'required|integer|exists:maps,id',
            'pins.*.title' => 'required|string',
            'pins.*.description' => 'nullable|string|max:255',
            'pins.*.lat' => 'required|numeric|regex:/^[-]?((([0-8]?[0-9])(\.[0-9]{6}))|90(\.0{6})?)$/',
            'pins.*.lon' => 'required|numeric|regex:/^[-]?(((([1][0-7][0-9])|([0-9]?[0-9]))(\.[0-9]{6}))|180(\.0{6})?)$/',
        ];
    }

    public function getMap(): Map
    {
        return Map::findOrFail($this->input('map_id'));
    }
}
