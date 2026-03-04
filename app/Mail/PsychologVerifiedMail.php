<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PsychologVerifiedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $user;
    public $status;

    public function __construct(User $user, $status = 'success')
    {
        $this->user = $user;
        $this->status = $status;
    }

    public function envelope(): Envelope
    {
        // Subjek email jadi dinamis tergantung status
        $subject = $this->status === 'success'
            ? 'Selamat! Akun Praktisi Anda Telah Diverifikasi'
            : 'Update Status Verifikasi Akun Praktisi Anda';

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.psycholog-verify', // Kita gunakan satu file view saja
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
