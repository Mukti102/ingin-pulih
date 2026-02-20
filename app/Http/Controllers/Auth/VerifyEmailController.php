<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // 1. Cek jika email sudah terverifikasi sebelumnya
        if ($request->user()->hasVerifiedEmail()) {
            return $this->getRedirectRoute($request);
        }

        // 2. Proses verifikasi jika belum
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->getRedirectRoute($request);
    }

    /**
     * Menentukan rute redirect berdasarkan role pengguna.
     */
    protected function getRedirectRoute($request): RedirectResponse
    {
        if ($request->user()->hasRole('user')) {
            toast()->success('Email verified successfully');
            return redirect()->route('profile.edit')->with('verified', '1');
        }

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}