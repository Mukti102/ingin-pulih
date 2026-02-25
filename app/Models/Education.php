<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $guarded = ['id'];

    public function psycholog(){
        return $this->belongsTo(Psycholog::class,'psycholog_id');
    }
}
