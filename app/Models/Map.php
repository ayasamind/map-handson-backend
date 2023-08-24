<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Map extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'center_lat',
        'center_lon',
        'zoom_level',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'title'  => 'string',
        'description' => 'string',
        'center_lat' => 'decimal:8',
        'center_lon' => 'decimal:8',
        'zoom_level' => 'integer',
    ];

    public function pins(): HasMany
    {
        return $this->hasMany(Pin::class);
    }
}
