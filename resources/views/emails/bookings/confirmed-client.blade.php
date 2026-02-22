<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Konfirmasi Jadwal Konsultasi</title>
</head>

<body>
    <div style="font-family: sans-serif; line-height: 1.6; color: #333;">
        <h2 style="color: #0d6efd;">Halo, {{ $booking->user->name }}!</h2>
        <p>Kabar baik! Psikolog <strong>{{ $booking->psycholog->user->name }}</strong> telah mengonfirmasi jadwal
            konsultasi
            Anda.</p>

        <div style="background: #f8f9fa; padding: 15px; border-radius: 10px; border-left: 5px solid #0d6efd;">
            <p><strong>Detail Jadwal:</strong><br>
                Kode: {{ $booking->code }}<br>
                Tanggal: {{ date('d M Y', strtotime($booking->session_date)) }}<br>
                Waktu: {{ $booking->start_time }} - {{ $booking->end_time }} WIB<br>
                Metode: {{ ucfirst($booking->meeting_type) }}</p>
        </div>

        <p>Silakan cek dashboard akun Anda untuk melihat detailnya</p>
        <p>Terima kasih telah mempercayakan kesehatan mental Anda kepada kami.</p>
    </div>

</body>

</html>
