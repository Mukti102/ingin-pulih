<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionRoom extends Model
{
    protected $guarded = ['id'];
    public function sessionMeet()
    {
        return $this->belongsTo(SessionMeet::class, 'session_meet_id');
    }
}
