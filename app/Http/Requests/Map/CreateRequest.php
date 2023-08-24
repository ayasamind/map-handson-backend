<?php

namespace App\Http\Requests\Map;

use App\Http\Requests\ApiRequest;

class CreateRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'center_lat' => ['required', 'numeric', 'regex:/^[-]?((([0-8]?[0-9])(\.[0-9]{6}))|90(\.0{6})?)$/'],
            'center_lon' => ['required', 'numeric', 'regex:/^[-]?(((([1][0-7][0-9])|([0-9]?[0-9]))(\.[0-9]{6}))|180(\.0{6})?)$/'],
            'zoom_level' => ['required', 'numeric'],
        ];
    }
}
