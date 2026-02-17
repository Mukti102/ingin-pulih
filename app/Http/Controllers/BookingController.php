<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Psycholog;
use App\Models\Service;
use App\Models\User;
use App\Services\BookingService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        if (auth()->user()->isPsycholog()) {
            $authPsycholog = auth()->user()->psycholog;
            $bookings = $this->bookingService->list($authPsycholog->id);
            return view('pages.dashboard.psycholog.booking.index', compact('bookings'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        // Ambil data psikolog dari user yang login beserta relasi jadwalnya
        $psycholog = auth()->user()->psycholog->load('weeklySchedules');
        $services = $psycholog->services;

        return view('pages.dashboard.psycholog.booking.create', compact('users', 'services', 'psycholog'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->bookingService->store($request->all());
            toast('Berhasil Mebuat Booking', 'success');
            return redirect()->route('bookings.index');
        } catch (Exception $e) {
            Log::info('error', ['message' => $e->getMessage()]);
            Alert('Error', $e->getMessage() . ' ' . 'Pilih Tanggal Lain', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $booking = Booking::find(decrypt($id));
        return view('pages.dashboard.psycholog.booking.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $booking = Booking::find(decrypt($id));
        $users = User::all();
        // Ambil data psikolog dari user yang login beserta relasi jadwalnya
        $psycholog = auth()->user()->psycholog->load('weeklySchedules');
        $services = $psycholog->services;

        return view('pages.dashboard.psycholog.booking.edit', compact('users', 'services', 'psycholog', 'booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
