<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pembatalan Jadwal</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #eee; border-radius: 12px; }
        .header { text-align: center; padding-bottom: 20px; border-bottom: 2px solid #f8f9fa; }
        .content { padding: 30px 0; }
        .booking-box { background-color: #fff5f5; border-left: 4px solid #e53e3e; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .footer { text-align: center; font-size: 12px; color: #777; padding-top: 20px; }
        .button { display: inline-block; padding: 12px 25px; background-color: #0d6efd; color: #ffffff !important; text-decoration: none; border-radius: 8px; font-weight: bold; margin-top: 20px; }
        .status-badge { display: inline-block; padding: 4px 12px; background-color: #fed7d7; color: #c53030; border-radius: 20px; font-size: 12px; font-weight: bold; text-uppercase; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="color: #2d3748;">Update Jadwal Konsultasi</h2>
        </div>

        <div class="content">
            <p>Halo, <strong>{{ $booking->user->name }}</strong>.</p>
            <p>Kami ingin menginformasikan bahwa permintaan jadwal konsultasi Anda dengan <strong>{{ $booking->psycholog->user->name }}</strong> saat ini <span class="status-badge">Dibatalkan / Ditolak</span>.</p>

            <div class="booking-box">
                <p style="margin: 0; font-weight: bold; color: #c53030;">Detail Pesanan:</p>
                <table style="width: 100%; margin-top: 10px; font-size: 14px;">
                    <tr>
                        <td width="40%">Kode Booking</td>
                        <td>: {{ $booking->code }}</td>
                    </tr>
                    <tr>
                        <td>Rencana Tanggal</td>
                        <td>: {{ date('d M Y', strtotime($booking->session_date)) }}</td>
                    </tr>
                    <tr>
                        <td>Layanan</td>
                        <td>: {{ $booking->service->title }}</td>
                    </tr>
                </table>
            </div>

            <p>Hal ini biasanya terjadi karena adanya perubahan jadwal mendadak dari pihak psikolog atau ketidaksesuaian waktu. Jangan khawatir, jika Anda sudah melakukan pembayaran, tim kami akan memproses pengembalian dana (refund) atau Anda dapat menjadwalkan ulang.</p>

            <div style="text-align: center;">
                <a href="{{ url('/psychologists') }}" class="button">Cari Jadwal Lain</a>
            </div>
        </div>

        <div class="footer">
            <p>Email ini dikirim otomatis oleh sistem. Jika Anda memiliki pertanyaan mengenai pengembalian dana, silakan hubungi tim Support kami.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>