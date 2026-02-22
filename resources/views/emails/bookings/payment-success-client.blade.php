<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil</title>
    <style>
        body {
            font-family: 'Segoe UI', Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .header {
            background-color: #10b981;
            color: #ffffff;
            text-align: center;
            padding: 40px 20px;
        }

        .content {
            padding: 30px;
        }

        .invoice-box {
            border: 1px dashed #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
            background-color: #f8fafc;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table td {
            padding: 8px 0;
            font-size: 14px;
        }

        .label {
            color: #64748b;
        }

        .value {
            text-align: right;
            font-weight: bold;
            color: #1e293b;
        }

        .total-row {
            border-top: 1px solid #e2e8f0;
            margin-top: 10px;
            padding-top: 10px;
        }

        .button {
            display: inline-block;
            padding: 14px 28px;
            background-color: #0d6efd;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #94a3b8;
        }

        .check-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="check-icon">✓</div>
            <h1 style="margin: 0; font-size: 24px;">Pembayaran Diterima!</h1>
            <p style="margin: 5px 0 0; opacity: 0.9;">Terima kasih atas kepercayaan Anda</p>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $booking->user->name }}</strong>,</p>
            <p>Pembayaran untuk kode booking <strong>{{ $booking->code }}</strong> telah kami terima dengan sukses. Saat
                ini sistem sedang meneruskan jadwal Anda kepada psikolog pilihan Anda.</p>

            <div class="invoice-box">
                <table class="table">
                    <tr>
                        <td class="label">Psikolog</td>
                        <td class="value">{{ $booking->psycholog->user->name }}</td>
                    </tr>
                    <tr>
                        <td class="label">Layanan</td>
                        <td>: {{ $booking->service->title }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tanggal Sesi</td>
                        <td class="value">{{ date('d M Y', strtotime($booking->session_date)) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Waktu</td>
                        <td class="value">{{ $booking->start_time }} - {{ $booking->end_time }} WIB</td>
                    </tr>
                    <tr class="total-row">
                        <td class="label" style="font-size: 16px; color: #1e293b;">Total Bayar</td>
                        <td class="value" style="font-size: 18px; color: #10b981;">Rp
                            {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>

            <p style="font-size: 14px; color: #64748b;">
                *Langkah selanjutnya: Psikolog akan meninjau jadwal Anda. Anda akan menerima email konfirmasi segera
                setelah jadwal disetujui.
            </p>

            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('client.sessions.show', $booking->code) }}" class="button">Lihat Detail Booking</a>
            </div>
        </div>

        <div class="footer">
            <p>Butuh bantuan? Balas email ini atau hubungi WhatsApp Support kami.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
