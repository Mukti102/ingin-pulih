<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'topics' => 'array',
        'is_followup' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function psycholog()
    {
        return $this->belongsTo(Psycholog::class, 'psycholog_id');
    }

    public function sessionMeet()
    {
        return $this->hasOne(SessionMeet::class, 'booking_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'booking_id');
    }
}
