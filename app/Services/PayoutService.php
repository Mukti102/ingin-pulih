<?php

namespace App\Services;

use App\Models\Payout;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PayoutService
{   

   protected  $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function listPayoutsPsycholog($psychologId)
    {
        try {
            $payouts = Payout::where('psycholog_id', $psychologId)->latest()->get();
            return $payouts;
        } catch (\Exception $e) {
            Log::error('Error fetching payouts for psycholog', ['message' => $e->getMessage()]);
            return collect(); // Return an empty collection on error
        }
    }

    public function listPayoutsAdmin()
    {
        try {
            $payouts = Payout::with('psycholog.user')->latest()->get();
            return $payouts;
        } catch (\Exception $e) {
            Log::error('Error fetching payouts for admin', ['message' => $e->getMessage()]);
            return collect(); // Return an empty collection on error
        }
    }

    public function approvePayout($payoutId, array $data)
    {
        try {
            $payout = Payout::findOrFail($payoutId);

            if ($data['approve_document']) {
                $payout->approve_document = $data['approve_document']->store('payout_documents', 'public');
            }
            $payout->status = 'approved';
            $payout->save();
            $this->paymentService->reduceSaldoPsycholog($payout->psycholog_id, $payout->amount);
            return true;
        } catch (\Exception $e) {
            Log::error('Error approving payout', ['message' => $e->getMessage()]);
            return false; // Return false on error
        }
    }

    public function rejectPayout($payoutId, $reason)
    {
        try {
            $payout = Payout::findOrFail($payoutId);
            $payout->status = 'rejected';
            $payout->reject_reason = $reason;
            $payout->save();
            return true;
        } catch (\Exception $e) {
            Log::error('Error rejecting payout', ['message' => $e->getMessage()]);
            return false;
        }
    }

    public function getPayoutDetails($payoutId)
    {
        try {
            $payout = Payout::with('psycholog.user')->findOrFail($payoutId);
            return $payout;
        } catch (\Exception $e) {
            Log::error('Error fetching payout details', ['message' => $e->getMessage()]);
            return null; // Return null on error
        }
    }


    public function deletePayout($payoutId)
    {
        try {
            $payout = Payout::findOrFail($payoutId);
            if($payout->approve_document) {
                Storage::disk('public')->delete($payout->approve_document);
            }

            $payout->delete();
            return true;
        } catch (\Exception $e) {
            Log::error('Error deleting payout', ['message' => $e->getMessage()]);
            return false; // Return false on error
        }
    }
}
