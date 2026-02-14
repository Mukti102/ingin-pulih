<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded = ['id'];

    public function psychologs()
    {
        return $this->belongsToMany(Psycholog::class, 'psycholog_topics');
    }
}
