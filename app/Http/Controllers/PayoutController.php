<?php

namespace App\Http\Controllers;

use App\Models\Payout;
use App\Services\PayoutService;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    protected $payoutService;

    public function __construct(PayoutService $payoutService)
    {
        $this->payoutService = $payoutService;
    }

    public function index()
    {
        if (auth()->user()->isPsycholog()) {
            $payouts = $this->payoutService->listPayoutsPsycholog(auth()->user()->psycholog->id);
            return view('pages.dashboard.psycholog.payouts.index', compact('payouts'));
        } else {
            $payouts = $this->payoutService->listPayoutsAdmin();
            return view('pages.dashboard.psycholog.payouts.index', compact('payouts'));
        }
    }

    public function show($id)
    {
        $payout = $this->payoutService->getPayoutDetails(decrypt($id));
        return view('pages.dashboard.psycholog.payouts.show', compact('payout'));
    }

    public function approve($id, Request $request)
    {
        $success = $this->payoutService->approvePayout(decrypt($id), $request->all());
        if ($success) {
            toast()->success('Payout berhasil disetujui.');
        } else {
            toast()->error('Gagal menyetujui payout.');
        }
        return redirect()->back();
    }

    public function reject($id, Request $request)
    {
        $success = $this->payoutService->rejectPayout(decrypt($id), $request->rejection_reason);
        if ($success) {
            toast()->success('Payout berhasil ditolak.');
        } else {
            toast()->error('Gagal menolak payout.');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {   
        $success = $this->payoutService->deletePayout(decrypt($id));
        if ($success) {
            toast()->success('Payout berhasil dihapus.');
        } else {
            toast()->error('Gagal menghapus payout.');
        }
        return redirect()->back();
    }
}
