<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { background-color: #f8f9fa; padding: 15px; text-align: center; border-radius: 10px 10px 0 0; border-bottom: 2px solid #1a73e8; }
        .content { padding: 20px; }
        .info-table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        .info-table td { padding: 8px; border-bottom: 1px solid #f0f0f0; }
        .info-table td.label { font-weight: bold; width: 35%; color: #666; }
        .badge { background: #fff3cd; color: #856404; padding: 3px 10px; border-radius: 12px; font-size: 12px; }
        .footer { text-align: center; font-size: 12px; color: #999; margin-top: 20px; }
        .button { display: inline-block; padding: 10px 20px; background-color: #1a73e8; color: #ffffff !important; text-decoration: none; border-radius: 5px; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="margin:0; color: #1a73e8;">Pendaftaran Psikolog Baru</h2>
        </div>
        <div class="content">
            <p>Halo Admin,</p>
            <p>Seorang psikolog baru saja mendaftar dan menunggu verifikasi dokumen. Berikut adalah ringkasan datanya:</p>
            
            <table class="info-table">
                <tr>
                    <td class="label">Nama Lengkap</td>
                    <td>{{ $psycholog->fullname }}</td>
                </tr>
                <tr>
                    <td class="label">Email</td>
                    <td>{{ $psycholog->user->email }}</td>
                </tr>
                <tr>
                    <td class="label">SIPP</td>
                    <td>{{ $psycholog->SIPP ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Pengalaman</td>
                    <td>{{ $psycholog->experience_years }} Tahun</td>
                </tr>
                <tr>
                    <td class="label">Status Verifikasi</td>
                    <td><span class="badge">{{ ucfirst($psycholog->verification_status) }}</span></td>
                </tr>
            </table>

            <p>Harap segera tinjau dokumen legalitas yang telah diunggah di panel admin.</p>
            
            <div style="text-align: center;">
                {{-- Ganti 'admin.psycholog.index' dengan nama route list psikolog Anda --}}
                <a href="{{ route('psychologs.index') }}" class="button">Tinjau di Panel Admin</a>
            </div>
        </div>
        <div class="footer">
            <p>Email ini dikirim secara otomatis oleh sistem {{ config('app.name') }}.</p>
        </div>
    </div>
</body>
</html>