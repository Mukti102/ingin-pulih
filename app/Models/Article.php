<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'author',
        'thumbnail',
        'slug',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];
}
