<?php

namespace App\Mail;

use App\Models\Psycholog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyDocumentMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $psycholog;
    public $status; // 'complete' atau 'pending'

    public function __construct(Psycholog $psycholog, $status)
    {
        $this->psycholog = $psycholog;
        $this->status = $status;
    }

    public function envelope(): Envelope
    {
        $subject = $this->status === 'complete' 
            ? 'Dokumen Anda Telah Terverifikasi - ' . get_setting('app_name') 
            : 'Update Status Verifikasi Dokumen - ' . get_setting('app_name');

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.verify-document', // Pastikan folder dan nama file sesuai
        );
    }
}