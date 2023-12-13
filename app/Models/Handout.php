<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Handout extends Model
{
    use HasFactory;

    protected $fillable = [
        'cover_image',
        'title',
        'subtitle',
        'handout_download',
    ];
}
