<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function checkoutPage($code)
    {
        $booking = Booking::where('code', $code)
            ->with(['psycholog', 'transaction'])
            ->firstOrFail();

        $transaction = $booking->transaction;
        if (!$transaction) {
            $transaction = $booking->transaction()->create([
                'reference_id' => $booking->code,
                'amount'       => $booking->total_price,
                'status'       => 'pending',
            ]);
        }



        // 3. Jika snap_token kosong atau kadaluarsa, request ke Midtrans
        if (!$transaction->snap_token) {
            $transaction->snap_token = $this->generateMidtransSnapToken($booking);
            $transaction->save();
        }
        return view('pages.guest.checkout', [
            'booking' => $booking,
            'snapToken' => $transaction->snap_token
        ]);
    }


    public function success($code)
    {
        $booking = Booking::where('code', $code)
            ->where('user_id', auth()->id())
            ->with(['psycholog'])
            ->firstOrFail();
        $booking->status = 'confirmed';
        $booking->payment_status = 'paid';

        return view('pages.guest.booking-success', compact('booking'));
    }

    private function generateMidtransSnapToken($booking)
    {
        // Konfigurasi SDK Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $booking->code . '-' . time(),
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'item_details' => [
                [
                    'id' => $booking->id,
                    'price' => (int) $booking->total_price,
                    'quantity' => 1,
                    'name' => "Sesi Konseling dengan " . $booking->psycholog->name,
                ]
            ],
        ];

        return \Midtrans\Snap::getSnapToken($params);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
