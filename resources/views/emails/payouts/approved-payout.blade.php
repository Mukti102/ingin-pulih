<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payout Disetujui</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f0fdf4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border: 1px solid #d1fae5;
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

        .success-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .payout-details {
            background-color: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #e5e7eb;
        }

        .amount {
            font-size: 28px;
            font-weight: bold;
            color: #059669;
            margin: 10px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table td {
            padding: 10px 0;
            font-size: 14px;
            border-bottom: 1px solid #f1f5f9;
        }

        .label {
            color: #6b7280;
        }

        .value {
            text-align: right;
            font-weight: 600;
            color: #111827;
        }

        .button {
            display: inline-block;
            padding: 14px 28px;
            background-color: #10b981;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
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
            <div class="success-icon">💰</div>
            <h1 style="margin: 0; font-size: 24px;">Dana Telah Dikirim!</h1>
            <p style="margin: 5px 0 0; opacity: 0.9;">Permintaan payout Anda telah berhasil diproses.</p>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $payout->psycholog->user->name }}</strong>,</p>
            <p>Kami informasikan bahwa permintaan penarikan saldo Anda telah disetujui dan dana telah ditransfer ke
                rekening terdaftar Anda.</p>

            <div class="payout-details">
                <div class="amount">Rp {{ number_format($payout->amount, 0, ',', '.') }}</div>

                <table class="table">
                    <tr>
                        <td class="label">ID Transaksi</td>
                        <td class="value">#PAY-{{ $payout->id }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tanggal Disetujui</td>
                        <td class="value">{{ now()->format('d M Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Status</td>
                        <td class="value" style="color: #059669;">BERHASIL</td>
                    </tr>
                </table>
            </div>

            @if ($payout->approve_document)
                <p style="font-size: 14px; color: #4b5563;">
                    Anda dapat melihat atau mengunduh bukti transfer melalui tautan di bawah ini:
                </p>
                <div style="text-align: center;">
                    <a href="{{ Storage::url($payout->approve_document) }}" class="button">Lihat Bukti Transfer</a>
                </div>
            @endif

            <p style="margin-top: 30px; font-size: 13px; color: #6b7280;">
                Catatan: Waktu masuknya dana ke rekening Anda bergantung pada kebijakan bank penerima. Silakan hubungi
                kami jika dana belum diterima dalam 1x24 jam.
            </p>
        </div>

        <div class="footer">
            <p>Email ini dikirim otomatis oleh {{ config('app.name') }}.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
