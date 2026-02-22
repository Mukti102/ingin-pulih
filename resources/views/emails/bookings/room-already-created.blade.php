<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesi Konsultasi Siap</title>
    <style>
        body { font-family: 'Segoe UI', Helvetica, Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f9fafb; }
        .container { max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb; }
        .header { background-color: #4f46e5; /* Sesuaikan dengan brand-600 Anda */ color: #ffffff; text-align: center; padding: 30px 20px; }
        .content { padding: 30px; }
        .room-card { background-color: #f3f4f6; border-radius: 12px; padding: 25px; text-align: center; margin: 20px 0; border: 1px solid #e5e7eb; }
        .meeting-link { display: block; word-break: break-all; color: #4f46e5; font-weight: bold; margin: 10px 0; font-size: 14px; }
        .button { display: inline-block; padding: 14px 30px; background-color: #4f46e5; color: #ffffff !important; text-decoration: none; border-radius: 10px; font-weight: bold; margin-top: 10px; }
        .info-grid { width: 100%; border-top: 1px solid #e5e7eb; margin-top: 20px; padding-top: 20px; font-size: 14px; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #9ca3af; }
        .highlight { color: #4f46e5; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0; font-size: 22px;">Sesi Konsultasi Anda Siap!</h1>
            <p style="margin: 5px 0 0; opacity: 0.9;">Ruang pertemuan virtual telah dibuat</p>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $session->booking->user->name }}</strong>,</p>
            <p>Psikolog <span class="highlight">{{ $session->booking->psycholog->user->name }}</span> telah menyiapkan ruang pertemuan untuk sesi Anda hari ini.</p>

            <div class="room-card">
                <p style="margin-top: 0; font-weight: bold;">Klik tombol di bawah untuk bergabung:</p>
                <a href="{{ $session->room->meeting_link }}" class="button">Gabung Sekarang</a>
                
                <p style="margin-top: 20px; font-size: 12px; color: #6b7280;">Atau gunakan link manual:</p>
                <span class="meeting-link">{{ $session->room->meeting_link }}</span>
            </div>

            <div class="info-grid">
                <table width="100%">
                    <tr>
                        <td style="color: #6b7280;">Kode Booking</td>
                        <td align="right"><strong>{{ $session->booking->code }}</strong></td>
                    </tr>
                    <tr>
                        <td style="color: #6b7280;">Waktu Sesi</td>
                        <td align="right">{{ $session->booking->start_time }} - {{ $session->booking->end_time }} WIB</td>
                    </tr>
                </table>
            </div>

            <p style="font-size: 13px; color: #6b7280; margin-top: 20px; background: #fffbeb; padding: 10px; border-radius: 8px; border: 1px solid #fef3c7;">
                <strong>Catatan:</strong> Mohon pastikan koneksi internet Anda stabil dan gunakan browser terbaru (Chrome/Edge) untuk pengalaman terbaik.
            </p>
        </div>

        <div class="footer">
            <p>Jika Anda mengalami kendala teknis, silakan hubungi Admin melalui aplikasi.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>