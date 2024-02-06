<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;

class Singer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name_singer',
    ];

    public function musics(): HasMany
    {
        return $this->hasMany(Music::class);
    }

    public function search(string $search): LengthAwarePaginator
    {
        return $this->where('name_singer', 'like', '%' . $search . '%')
                    ->with('musics')
                    ->paginate(10);
    }
}
