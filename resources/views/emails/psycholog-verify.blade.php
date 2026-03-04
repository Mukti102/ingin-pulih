<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #e1e1e1;
            border-radius: 10px;
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
        }

        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #1a73e8;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>{{ get_setting('app_name') }}</h2>
        </div>
        <div class="content">
            <p>Halo, <strong>{{ $user->name }}</strong>!</p>

            @if ($status === 'success')
                {{-- TAMPILAN JIKA BERHASIL --}}
                <h3 style="color: #1a73e8;">Selamat! Akun Anda kini telah resmi terverifikasi.</h3>
                <p>Anda sudah dapat mulai menerima booking konsultasi dan mengatur jadwal praktik di dashboard.</p>
                <div style="text-align: center;">
                    <a href="{{ route('login') }}" class="button">Masuk ke Dashboard</a>
                </div>
            @else
                {{-- TAMPILAN JIKA PENDING/DIBATALKAN --}}
                <h3 style="color: #d9534f;">Update Status Verifikasi</h3>
                <p>Status verifikasi akun Anda saat ini dikembalikan ke <strong>Pending</strong>.</p>
                <p>Hal ini mungkin disebabkan oleh dokumen yang tidak lengkap atau ketidaksesuaian data. Silakan periksa
                    kembali profil Anda atau hubungi admin untuk informasi lebih lanjut.</p>
                <div style="text-align: center;">
                    <a href="{{ url('/') }}" class="button" style="background-color: #6c757d;">Cek Profil</a>
                </div>
            @endif
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ get_setting('app_name') }} Semua Hak Dilindungi.<br>
                {{ get_setting('app_address') }}</p>
        </div>
    </div>
</body>

</html>
