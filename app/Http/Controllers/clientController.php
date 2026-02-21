<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class clientController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $upcomingBooking = Booking::where('user_id', $user->id)
            ->where('session_date', '>=', now()->toDateString())
            ->whereIn('status', ['confirmed', 'paid'])
            ->orderBy('session_date', 'asc')
            ->first();

        // Riwayat 5 booking terakhir
        $recentBookings = Booking::where('user_id', $user->id)
            ->with('psycholog')
            ->latest()
            ->take(5)
            ->get();

        $unpaidBookings = Booking::where('user_id', $user->id)->where('payment_status', 'unpaid')->latest()->get();


        return view('pages.client.dashboard', compact('upcomingBooking', 'recentBookings', 'unpaidBookings'));
    }

    public function SessionShow($code)
    {
        $user = auth()->user();

        // Cari booking berdasarkan code dan pastikan milik user yang login
        $booking = Booking::where('code', $code)
            ->where('user_id', $user->id)
            ->with(['psycholog', 'sessionMeet.room', 'sessionMeet.note'])
            ->firstOrFail();


        $topicNames = \App\Models\Topic::whereIn('id', (array)$booking->topics)->pluck('name');
        return view('pages.client.scheduleSession.show', compact('booking', 'topicNames'));
    }

    public function history()
    {
        $user = auth()->user();

        $historySessions = Booking::where('user_id', $user->id)
            ->whereIn('status', ['complete', 'cancelled', 'expired', 'pending'])
            ->with('psycholog')
            ->latest()
            ->paginate(10);

        return view('pages.client.history.index', compact('historySessions'));
    }

    public function sessions()
    {
        $user = auth()->user();

        // Sesi yang sudah dibayar dan belum lewat tanggalnya
        $upcomingSessions = Booking::where('user_id', $user->id)
            ->whereIn('status', ['confirmed', 'paid'])
            ->where('session_date', '>=', now()->toDateString())
            ->with('psycholog')
            ->orderBy('session_date', 'asc')
            ->get();



        return view('pages.client.scheduleSession.index', compact('upcomingSessions'));
    }
}
