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
        $transactions = Transaction::with('booking.psycholog')->latest()->get();
        return view('pages.dashboard.transactions.index', compact('transactions'));
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

        if ($booking->status !== 'confirmed' || $booking->payment_status !== 'paid') {
            toast()->error('Pembayaran belum berhasil atau booking belum dikonfirmasi');
            return redirect()->back();
        }

        return view('pages.guest.booking-success', compact('booking'));
    }

    public function notification(Request $request)
    {
        $payload = $request->all();
        $signatureKey = hash('sha512', $payload['order_id'] . $payload['status_code'] . $payload['gross_amount'] . config('midtrans.server_key'));

        if ($signatureKey !== $payload['signature_key']) {
            return response()->json(['message' => 'Invalid signature'], 400);
        }

        $transaction = Transaction::where('reference_id', $payload['order_id'])->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transaction->status = $payload['transaction_status'];


        $transaction->save();

        if (in_array($payload['transaction_status'], ['cancel', 'deny', 'expire'])) {
            $booking = Booking::where('code', $transaction->reference_id)->first();
            if ($booking) {
                $booking->status = 'cancelled';
                $booking->save();
            }
        }

        // Update booking status jika pembayaran berhasil
        if ($payload['transaction_status'] === 'settlement') {
            $booking = Booking::where('code', $transaction->reference_id)->first();
            if ($booking) {
                $booking->status = 'confirmed';
                $booking->payment_status = 'paid';
                $booking->save();
            }
        }

        return response()->json(['message' => 'Notification received']);
    }

    private function generateMidtransSnapToken($booking)
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $booking->code,
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
    public function show($id)
    {
        $transaction = Transaction::findOrFail(decrypt($id));
        return view('pages.dashboard.transactions.show', compact('transaction'));
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
