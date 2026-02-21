<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Psycholog;
use App\Models\Transaction;
use App\Models\User;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function __invoke()
    {
        $stats = [
            'total_revenue' => Transaction::where('status', 'settlement')->sum('amount'),
            'total_bookings' => Booking::count(),
            'active_psychologists' => Psycholog::count(),
            'new_users' => User::whereHas('roles', function ($q) {
                $q->where('name', 'user');
            })->where('created_at', '>=', now()->subDays(7))->count(),
            'total_payout' => \App\Models\Payout::where('status', 'pending')->count(),
        ];

        $recent_transactions = Transaction::with('booking.user')
            ->latest()
            ->take(5)
            ->get();

        // Ambil data 6 bulan terakhir
        $months = collect(range(5, 0))->map(function ($i) {
            return now()->subMonths($i)->format('M');
        });

        $requestPayouts = \App\Models\Payout::where('status', 'pending')->latest()->get();

        $statuses = ['pending', 'confirmed', 'failed', 'complete', 'cancelled'];
        $chartData = [];

        foreach ($statuses as $status) {
            $chartData[$status] = collect(range(5, 0))->map(function ($i) use ($status) {
                return \App\Models\Booking::where('status', $status)
                    ->whereMonth('created_at', now()->subMonths($i)->month)
                    ->whereYear('created_at', now()->subMonths($i)->year)
                    ->count();
            });
        }
        return view('pages.dashboard.dashboard', compact('stats', 'recent_transactions', 'months', 'chartData', 'requestPayouts'));
    }

    public function dashboardPsikolog()
    {
        // Ambil ID psikolog yang sedang login
        $psychologId = auth()->user()->psycholog->id;
        $psycholog = Psycholog::with('user','wallet')->find($psychologId);
        // 1. Statistik Ringkas (Cards)
        $stats = [
            'total_sessions' => \App\Models\Booking::where('psycholog_id', $psychologId)
                ->where('status', 'complete')->count(),
            'upcoming_sessions' => \App\Models\Booking::where('psycholog_id', $psychologId)
                ->where('status', 'confirmed')->count(),
            'pending_requests' => \App\Models\Booking::where('psycholog_id', $psychologId)
                ->where('status', 'pending')->count(),
        ];

        // 2. Data Grafik (6 Bulan Terakhir)
        $months = collect(range(5, 0))->map(function ($i) {
            return now()->subMonths($i)->format('M');
        });

        $statuses = ['pending', 'confirmed', 'complete', 'cancelled'];
        $chartData = [];

        foreach ($statuses as $status) {
            $chartData[$status] = collect(range(5, 0))->map(function ($i) use ($status, $psychologId) {
                return \App\Models\Booking::where('psycholog_id', $psychologId)
                    ->where('status', $status)
                    ->whereMonth('created_at', now()->subMonths($i)->month)
                    ->whereYear('created_at', now()->subMonths($i)->year)
                    ->count();
            })->toArray();
        }

        // 3. Sesi Terdekat (Confirmed & Terdekat dengan waktu sekarang)
        $upcomingBooking = \App\Models\Booking::with('user')
            ->where('psycholog_id', $psychologId)
            ->where('status', 'confirmed')
            ->where('session_date', '>=', now()->toDateString())
            ->orderBy('session_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->first();

        // 4. Aktivitas Terakhir (Semua status, limit 5)
        $recentBookings = \App\Models\Booking::with('user')
            ->where('psycholog_id', $psychologId)
            ->latest()
            ->take(5)
            ->get();

        // 5. Perlu Konfirmasi (Hanya status pending)
        $pendingBookings = \App\Models\Booking::with('user')
            ->where('psycholog_id', $psychologId)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        

        return view('pages.dashboard.psycholog.dashboard', compact(
            'stats',
            'months',
            'chartData',
            'upcomingBooking',
            'recentBookings',
            'pendingBookings',
            'psycholog',
        ));
    }
}
