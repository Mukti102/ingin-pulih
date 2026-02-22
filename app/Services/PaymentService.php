<?php

namespace App\Services;

use App\Mail\RequestPayoutMail;
use App\Models\Payout;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Mail;

class PaymentService
{
    public function saveSaldoPsycholog($psychologId, $amount)
    {
        $wallet = Wallet::firstOrCreate(
            ['psycholog_id' => $psychologId],
            ['balance' => 0]
        );

        $wallet->balance += $amount;
        $wallet->save();

        return $wallet;
    }

    public function getSaldoPsycholog($psychologId)
    {
        $wallet = Wallet::where('psycholog_id', $psychologId)->first();
        return $wallet ? $wallet->balance : 0;
    }

    public function setBankAccount($psychologId, array $bankData)
    {
        $wallet = Wallet::firstOrCreate(
            ['psycholog_id' => $psychologId],
            ['balance' => 0]
        );

        $wallet->bank_name = $bankData['bank_name'];
        $wallet->account_number = $bankData['account_number'];
        $wallet->account_holder_name = $bankData['account_holder_name'];
        $wallet->save();

        return $wallet;
    }

    // kurangi saldo
    public function reduceSaldoPsycholog($psychologId, $amount)
    {
        $wallet = Wallet::where('psycholog_id', $psychologId)->first();

        if (!$wallet) {
            throw new \Exception('Wallet tidak ditemukan untuk psikolog ini.');
        }

        if ($wallet->balance < $amount) {
            throw new \Exception('Saldo tidak cukup untuk melakukan transaksi ini.');
        }

        $wallet->balance -= $amount;
        $wallet->save();

        return $wallet;
    }

    // tambah saldo
    public function addSaldoPsycholog($psychologId, $amount)
    {
        $wallet = Wallet::firstOrCreate(
            ['psycholog_id' => $psychologId],
            ['balance' => 0]
        );

        $wallet->balance += $amount;
        $wallet->save();

        return $wallet;
    }

    // kurangi saldo
    public function deductSaldoPsycholog($psychologId, $amount)
    {
        $wallet = Wallet::where('psycholog_id', $psychologId)->first();

        if (!$wallet) {
            throw new \Exception('Wallet tidak ditemukan untuk psikolog ini.');
        }

        // minimal saldo lebih dari 100000
        if ($wallet->balance < 100000) {
            throw new \Exception('Saldo tidak mencukupi untuk melakukan transaksi ini. Minimal saldo harus lebih dari 100000.');
        }

        if ($wallet->balance < $amount) {
            throw new \Exception('Saldo tidak cukup untuk melakukan transaksi ini.');
        }

        $payout = Payout::create([
            'psycholog_id' => $psychologId,
            'amount' => $amount,
            'status' => 'pending',
        ]);

        $admins = User::withRole('admin')->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->queue(new RequestPayoutMail($payout));
        }
        return $wallet;
    }
}
