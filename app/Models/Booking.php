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

    public function review()
    {
        return $this->hasOne(Review::class, 'booking_id');
    }


    // app/Models/Booking.php

    public function getStatusColor(): string
    {
        return match ($this->status) {
            'pending'   => 'bg-amber-100 text-amber-600',
            'confirmed' => 'bg-cyan-100 text-cyan-600',
            'complete'  => 'bg-emerald-100 text-emerald-600',
            'failed'    => 'bg-red-100 text-red-600',
            'cancelled' => 'bg-gray-100 text-gray-600',
            default     => 'bg-gray-100 text-gray-400',
        };
    }
}
