<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id'];


    public function booking()
    {
        return  $this->belongsTo(Booking::class, 'booking_id');
    }

    protected function casts(): array
    {
        return [
            'payload_notification' => 'json',
        ];
    }
}
