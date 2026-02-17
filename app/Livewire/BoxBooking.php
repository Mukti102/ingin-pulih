<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking; // Pastikan model Booking sudah ada
use App\Models\PsichologService;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BoxBooking extends Component
{
    public $psychologist;
    public $type = 'online';
    public $availableTimes = null;
    public $selectedDate = '';
    public $service_id;

    public function mount($psychologist)
    {
        $this->psychologist = $psychologist;
        // Opsional: set default selectedDate ke hari ini
        $this->selectedDate = now()->format('Y-m-d');
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


    public function store()
    {
        try {

            // 1. Validasi input
            $this->validate([
                'service_id' => 'required',
                'selectedDate' => 'required|date|after_or_equal:today',
                'type' => 'required',
            ], [
                'service_id.required' => 'Pilih layanan terlebih dahulu.',
                'selectedDate.required' => 'Pilih tanggal sesi.',
            ]);

            // 2. Cek apakah psikolog tersedia di hari tersebut (Weekly Schedule)
            $dayName = strtolower(Carbon::parse($this->selectedDate)->format('l'));
            $schedule = $this->psychologist->weeklySchedules()
                ->where('day_of_week', $dayName)
                ->where('is_active', true)
                ->first();

            if (!$schedule) {
                return session()->flash('error', 'Psikolog tidak praktek di hari yang dipilih.');
            }

            // 3. Cek apakah sudah ada booking yang confirmed di tanggal tersebut (Double Booking Check)
            $exists = Booking::where('psycholog_id', $this->psychologist->id)
                ->where('session_date', $this->selectedDate)
                ->whereIn('status', ['completed','confirmed', 'pending'])
                ->exists();

            if ($exists) {
                return session()->flash('error', 'Jadwal sudah terisi, silakan pilih tanggal lain.');
            }

            // 4. Ambil detail harga dari layanan yang dipilih
            $pService = PsichologService::find($this->service_id);

            // Logic Kalkulasi
            $platformFee = 10000; // Contoh nominal flat fee
            $totalPrice = $pService->price + $platformFee;
            $earning = $pService->price; // Earning murni untuk psikolog

            DB::beginTransaction();
            try {
                $booking = Booking::create([
                    'code' => 'BRN-' . strtoupper(Str::random(8)),
                    'user_id' => auth()->id(), // Pastikan user sudah login
                    'service_id' => $pService->service_id,
                    'psycholog_id' => $this->psychologist->id,
                    'status' => 'pending',
                    'payment_status' => 'unpaid',
                    'meeting_type' => $this->type,
                    'total_price' => $totalPrice,
                    'session_date' => $this->selectedDate,
                    'start_time' => $schedule->start_time,
                    'end_time' => $schedule->end_time,
                    'platform_fee' => $platformFee,
                    'earning' => $earning,
                ]);

                DB::commit();

                return redirect()->route('bookings.checkout', $booking->code);
            } catch (\Exception $e) {
                DB::rollBack();
                session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('scroll-to-alert');
            throw $e;
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
