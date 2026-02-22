<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Payout Baru</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .header {
            background-color: #1e293b;
            color: #ffffff;
            text-align: center;
            padding: 30px 20px;
        }

        .content {
            padding: 30px;
        }

        .payout-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }

        .amount-text {
            font-size: 24px;
            font-weight: bold;
            color: #0f172a;
            margin: 10px 0;
        }

        .status-pending {
            display: inline-block;
            background-color: #fef3c7;
            color: #92400e;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .table td {
            padding: 8px 0;
            font-size: 14px;
            border-bottom: 1px solid #f1f5f9;
        }

        .label {
            color: #64748b;
        }

        .value {
            text-align: right;
            font-weight: 600;
            color: #1e293b;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #0d6efd;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #94a3b8;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0; font-size: 20px;">Permintaan Payout Baru</h1>
            <p style="margin: 5px 0 0; opacity: 0.8; font-size: 14px;">ID Payout: #{{ $payout->id }}</p>
        </div>

        <div class="content">
            <p>Halo Admin,</p>
            <p>Psikolog <strong>{{ $payout->psycholog->user->name }}</strong> telah mengajukan penarikan saldo (payout).
                Berikut adalah detail permintaannya:</p>

            <div class="payout-card">
                <span class="status-pending">Menunggu Persetujuan</span>
                <div class="amount-text">Rp {{ number_format($payout->amount, 0, ',', '.') }}</div>

                <table class="table">
                    <tr>
                        <td class="label">Nama Psikolog</td>
                        <td class="value">{{ $payout->psycholog->user->name }}</td>
                    </tr>
                    <tr>
                        <td class="label">Email</td>
                        <td class="value">{{ $payout->psycholog->user->email }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tanggal Request</td>
                        <td class="value">{{ $payout->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                </table>
            </div>

            <p style="font-size: 14px; color: #64748b;">
                Harap segera tinjau permintaan ini melalui Dashboard Admin untuk melakukan transfer dan mengunggah bukti
                bayar.
            </p>

            <div style="text-align: center;">
                <a href="{{ route('payouts.show', $payout->id) }}" class="button">Tinjau Permintaan</a>
            </div>
        </div>

        <div class="footer">
            <p>Email ini dikirim otomatis oleh sistem {{ config('app.name') }}.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
