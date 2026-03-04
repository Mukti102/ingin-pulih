<!DOCTYPE html>
<html>

<head>
    <style>
        .email-wrapper {
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #f0f0f0;
            border-radius: 12px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #f7f7f7;
            padding-bottom: 20px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }

        .status-success {
            background: #e6fffa;
            color: #2c7a7b;
        }

        .status-pending {
            background: #fffaf0;
            color: #9c4221;
        }

        .note-box {
            background: #f8fafc;
            border-left: 4px solid #cbd5e1;
            padding: 15px;
            margin: 20px 0;
            font-style: italic;
        }

        .button {
            background: #1a73e8;
            color: white !important;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 8px;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="container">
            <div class="header">
                <h2 style="color: #1a73e8;">{{ get_setting('app_name') }}</h2>
            </div>

            <p>Halo, <strong>{{ $psycholog->user->name }}</strong>.</p>

            @if ($status === 'complete')
                <p>Kabar baik! Dokumen praktik Anda telah kami tinjau dan dinyatakan
                    <span class="status-badge status-success">Terverifikasi</span>.
                </p>
                <p>Akun Anda kini aktif sepenuhnya. Anda sudah bisa menerima konsultasi dari klien melalui platform
                    kami.</p>
            @else
                <p>Kami telah meninjau dokumen Anda, namun saat ini status verifikasi Anda adalah
                    <span class="status-badge status-pending">Gagal / Membutuhkan Perbaikan Harap Register Ulang</span>.
                </p>
            @endif

            {{-- Tampilkan catatan admin jika ada --}}
            @if ($psycholog->document->note)
                <div class="note-box">
                    <strong>Catatan dari Tim Verifikasi:</strong><br>
                    "{{ $psycholog->document->note }}"
                </div>
            @endif

            <p>Silakan klik tombol di bawah untuk masuk ke dashboard Anda:</p>

            <div style="text-align: center;">
                <a href="{{ url('/login') }}" class="button">Buka Dashboard</a>
            </div>

            <p style="font-size: 13px; color: #777; margin-top: 30px;">
                Jika Anda merasa ini adalah kesalahan, silakan hubungi tim support kami melalui WhatsApp atau Email.
            </p>
        </div>
    </div>
</body>

</html>
