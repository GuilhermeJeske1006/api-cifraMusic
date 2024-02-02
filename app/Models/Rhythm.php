<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rhythm extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name_rhythm',
    ];

    public function musics(): HasMany
    {
        return $this->hasMany(Music::class);
    }
}
