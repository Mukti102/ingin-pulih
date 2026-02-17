<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionNote extends Model
{
    protected $guarded = ['id'];

    public function session(){
        return $this->belongsTo(SessionMeet::class,'session_meet_id');
    }

    public function psycholog(){
        return $this->belongsTo(Psycholog::class,'psycholog_id');
    }
}
