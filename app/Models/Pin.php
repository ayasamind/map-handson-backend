<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'map_id',
        'title',
        'description',
        'lat',
        'lon',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'map_id' => 'integer',
        'title'  => 'string',
        'description' => 'string',
        'lat' => 'decimal:8',
        'lon' => 'decimal:8',
    ];
}
