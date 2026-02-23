<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notifikasi Booking Baru</title>
</head>

<body>
    <div style="font-family: sans-serif; line-height: 1.6; color: #333;">
        <h2>Halo, {{ $booking->psycholog->user->name }}</h2>
        <p>Anda mendapatkan permintaan konsultasi baru dari <strong>{{ $booking->user->name }}</strong>.</p>

        <div style="background: #fef3c7; padding: 15px; border-radius: 10px; border-left: 5px solid #d97706;">
            <p><strong>Ringkasan Permintaan:</strong><br>
                Tanggal: {{ date('d M Y', strtotime($booking->session_date)) }}<br>
                Waktu: {{ $booking->start_time }} - {{ $booking->end_time }}<br>
                Topik: {{ is_array($booking->topics) ? implode(', ', $booking->topics) : $booking->topics }}</p>
        </div>

        <p>Harap segera login ke dashboard Admin/Psikolog untuk <strong>Konfirmasi</strong> jadwal ini agar Client
            mendapatkan notifikasi.</p>
        <a href="{{ route('bookings.show', encrypt($booking->id)) }}"
            style="display: inline-block; padding: 10px 20px; background: #0d6efd; color: #fff; text-decoration: none; border-radius: 5px;">Buka
            Dashboard</a>
    </div>

</body>

</html>
