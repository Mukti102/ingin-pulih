<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionMeet extends Model
{
    protected $guarded = ['id'];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function room()
    {
        return $this->hasOne(SessionRoom::class, 'session_meet_id');
    }

    public function note(){
        return $this->hasOne(SessionNote::class,'session_meet_id');
    }
}
