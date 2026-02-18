<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BookingService
{
    protected $platformFeeRate = 0.1;

    /**
     * List all bookings optionally by user
     */
    public function list($psychologId = null)
    {
        $query = Booking::with(['user', 'psycholog', 'service']);

        if ($psychologId) {
            $query->where('psycholog_id', $psychologId);
        }

        return $query->orderByDesc('created_at')->get();
    }

    /**
     * Store new booking
     */
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            // 1. Cek Double Booking (Berdasarkan waktu spesifik dari schedule)
            $exists = Booking::where('psycholog_id', $data['psycholog_id'])
                ->where('session_date', $data['session_date'])
                ->whereIn('status', ['confirmed', 'pending', 'completed'])
                ->where(function ($q) use ($data) {
                    $q->whereBetween('start_time', [$data['start_time'], $data['end_time']])
                        ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']]);
                })
                ->exists();

            if ($exists) {
                throw ValidationException::withMessages([
                    'selectedDate' => 'Jadwal pada jam tersebut sudah terisi.'
                ]);
            }

            $servicePrice = $data['price'];
            $platformFee  = $servicePrice * $this->platformFeeRate;
            $totalPrice   = $servicePrice + $platformFee;          
            $earning      = $servicePrice;

            return Booking::create([
                'code'                => 'BRN-' . strtoupper(Str::random(8)),
                'user_id'             => auth()->id(),
                'service_id'          => $data['service_id'], // service_id murni dari PsichologService
                'psycholog_id'        => $data['psycholog_id'],
                'status'              => 'pending',
                'payment_status'      => 'unpaid',
                'meeting_type'        => $data['meeting_type'],
                'topics'              => $data['topics'],
                'is_followup'         => $data['is_followup'],
                'problem_description' => $data['problem_description'],
                'expectations'        => $data['expectations'],
                'total_price'         => $totalPrice,
                'session_date'        => $data['session_date'],
                'start_time'          => $data['start_time'],
                'end_time'            => $data['end_time'],
                'platform_fee'        => $platformFee,
                'earning'             => $earning,
            ]);
        });
    }

    /**
     * Update booking data
     */
    public function update(Booking $booking, array $data)
    {
        return DB::transaction(function () use ($booking, $data) {

            if (isset($data['total_price'])) {
                $platformFee = $data['total_price'] * $this->platformFeeRate;
                $earning = $data['total_price'] - $platformFee;

                $data['platform_fee'] = $platformFee;
                $data['earning'] = $earning;
            }

            $booking->update($data);

            return $booking;
        });
    }

    /**
     * Update booking status
     */
    public function updateStatus(Booking $booking, string $status)
    {
        if (!in_array($status, ['pending', 'confirmed', 'failed', 'complete', 'cancelled'])) {
            throw ValidationException::withMessages(['status' => 'Status tidak valid']);
        }

        $booking->update(['status' => $status]);
        return $booking;
    }

    /**
     * Delete booking
     */
    public function delete(Booking $booking)
    {
        return DB::transaction(function () use ($booking) {
            $booking->delete();
            return true;
        });
    }

    /**
     * Generate unique booking code
     */
    protected function generateCode()
    {
        do {
            $code = 'BK' . strtoupper(uniqid());
        } while (Booking::where('code', $code)->exists());

        return $code;
    }
}
