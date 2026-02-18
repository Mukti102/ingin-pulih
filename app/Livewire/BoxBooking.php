<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking; // Pastikan model Booking sudah ada
use App\Models\PsichologService;
use App\Services\BookingService;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BoxBooking extends Component
{
    public $psychologist;
    public $type = 'online';
    public $availableTimes = null;
    public $selectedDate = '';
    public $selectedTopics = [];
    public $description = '';
    public $expectation = '';
    public $is_followup = false;
    public $service_id;
    public function mount($psychologist)
    {
        $this->psychologist = $psychologist;
        // Opsional: set default selectedDate ke hari ini
    }

    public function semuaJadwal()
    {
        $this->selectedDate = '';
    }


    public function updatedSelectedDate($value)
    {
        if (!$value) {
            $this->availableTimes = null;
            return;
        }

        $this->selectedDate = $value;

        // Ambil nama hari dalam bahasa inggris (lowercase) untuk mencocokkan dengan Enum
        $dayName = strtolower(Carbon::parse($value)->format('l'));

        // Cari jadwal di weekly_schedules
        $schedule = $this->psychologist->weeklySchedules()
            ->where('day_of_week', $dayName)
            ->where('is_active', true)
            ->first();

        if ($schedule) {
            $this->availableTimes = [
                'start' => Carbon::parse($schedule->start_time)->format('H:i'),
                'end'   => Carbon::parse($schedule->end_time)->format('H:i'),
            ];
        } else {
            $this->availableTimes = null;
        }
    }


    public function store(BookingService $bookingService)
    {  

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 1. Validasi Input UI
        $this->validate([
            'service_id'   => 'required|exists:services,id',
            'selectedDate' => 'required|date|after_or_equal:today',
            'type'         => 'required|in:online,offline',
            'description'  => 'required|string|min:5',
            'expectation'  => 'required|string|min:5',
            'selectedTopics'       => 'required|array|min:1',
            'is_followup'  => 'boolean',
        ]);

        try {
            // 2. Ambil Schedule & Service Detail
            $dayName = strtolower(Carbon::parse($this->selectedDate)->format('l'));
            $schedule = $this->psychologist->weeklySchedules()
                ->where('day_of_week', $dayName)
                ->where('is_active', true)
                ->first();

            if (!$schedule) {
                session()->flash('error', 'Psikolog tidak praktek di hari yang dipilih.');
                return;
            }

            $pService = \App\Models\PsichologService::where('service_id',$this->service_id)->first();

            $booking = $bookingService->store([
                'psycholog_id'        => $this->psychologist->id,
                'service_id'          => $pService->service_id,
                'price'               => $pService->price,
                'session_date'        => $this->selectedDate,
                'start_time'          => $schedule->start_time,
                'end_time'            => $schedule->end_time,
                'meeting_type'        => $this->type,
                'topics'              => $this->selectedTopics,
                'is_followup'         => $this->is_followup,
                'problem_description' => $this->description,
                'expectations'        => $this->expectation,
            ]);
            return redirect()->route('bookings.checkout', $booking->code);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('scroll-to-alert');
            throw $e;
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal membuat booking: ' . $e->getMessage());
        }
    }

    public function render()
    {
        // 1. Ambil layanan
        $services = $this->psychologist->services()
            ->where('type', $this->type)
            ->where('is_active', true)
            ->with('service')
            ->get();

        $workingDays = $this->psychologist->weeklySchedules()
            ->where('is_active', true)
            ->pluck('day_of_week')
            ->toArray();

        // 2. Ambil tanggal yang sudah full/terbooking
        // Asumsi: tabel bookings punya kolom 'booking_date' dan 'psycholog_id'
        $bookedDates = Booking::where('psycholog_id', $this->psychologist->id)
            // ->whereIn('status', ['confirmed', 'paid']) // Hanya yang sudah fix
            ->pluck('session_date') // Ambil kolom tanggal saja
            ->toArray();

        return view('livewire.box-booking', [
            'filteredServices' => $services,
            'bookedDates'      => $bookedDates,
            'workingDays'      => $workingDays
        ]);
    }
}
