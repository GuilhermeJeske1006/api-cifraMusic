<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rhythm extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name_rhythm',
    ];
}
