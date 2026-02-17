<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingService
{
    protected $platformFeeRate = 0.1; // 10% fee platform, bisa config

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

            // Validate double booking
            $exists = Booking::where('psycholog_id', $data['psycholog_id'])
                ->where('session_date', $data['session_date'])
                ->where(function ($q) use ($data) {
                    $q->whereBetween('start_time', [$data['start_time'], $data['end_time']])
                      ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']]);
                })
                ->exists();

            if ($exists) {
                throw ValidationException::withMessages([
                    'start_time' => 'Slot waktu sudah dibooking.'
                ]);
            }

            // Hitung platform fee & earning
            $totalPrice = $data['total_price'] ?? 0;
            $platformFee = $totalPrice * $this->platformFeeRate;
            $earning = $totalPrice - $platformFee;

            $data['platform_fee'] = $platformFee;
            $data['earning'] = $earning;

            // Auto generate booking code
            $data['code'] = $this->generateCode();

            return Booking::create($data);
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
