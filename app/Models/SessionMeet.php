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

    public function note()
    {
        return $this->hasOne(SessionNote::class, 'session_meet_id');
    }

    public function show($code)
    {
        $user = auth()->user();

        // Cari booking berdasarkan code dan pastikan milik user yang login
        $booking = Booking::where('code', $code)
            ->where('user_id', $user->id)
            ->with(['psycholog', 'sessionMeet.room', 'sessionMeet.note'])
            ->firstOrFail();

        return view('pages.client.scheduleSession.show', compact('booking'));
    }

    public function getStatusColor(): string
    {
        return match ($this->status) {
            'pending'   => 'bg-amber-100 text-amber-600',
            'confirmed' => 'bg-cyan-100 text-cyan-600',
            'completed'  => 'bg-emerald-100 text-emerald-600',
            'failed'    => 'bg-red-100 text-red-600',
            'cancelled' => 'bg-gray-100 text-gray-600',
            default     => 'bg-gray-100 text-gray-400',
        };
    }
}
