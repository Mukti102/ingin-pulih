<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Akun Konseling</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f5f3ff; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 24px; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(124, 58, 237, 0.1);">
                    <tr>
                        <td style="padding: 40px 50px;">
                            <h2 style="margin: 0 0 15px; color: #1e1b4b; font-size: 22px; font-weight: 700;">Halo, {{ $user->name }}</h2>
                            <p style="margin: 0 0 25px; color: #4b5563; font-size: 16px; line-height: 1.8;">
                                Selamat datang di komunitas kami. Kami percaya setiap langkah menuju kesehatan mental adalah sebuah keberanian. Untuk menjaga privasi dan keamanan sesi Anda, silakan konfirmasi email Anda terlebih dahulu.
                            </p>
                            
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" style="padding: 20px 0;">
                                        <a href="{{ $url }}" style="display: inline-block; padding: 16px 40px; background-color: #7c3aed; color: #ffffff; text-decoration: none; border-radius: 100px; font-weight: 700; font-size: 15px; box-shadow: 0 10px 15px -3px rgba(124, 58, 237, 0.4);">
                                            KONFIRMASI AKUN SAYA
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #f3f4f6;">
                                <p style="margin: 0; color: #6b7280; font-size: 13px; font-style: italic; line-height: 1.6;">
                                    "Kesehatan mental Anda adalah prioritas. Terima kasih telah mempercayai kami sebagai teman perjalanan Anda."
                                </p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px; background-color: #f9fafb; text-align: center;">
                            <p style="margin: 0 0 10px; color: #9ca3af; font-size: 12px;">
                                &copy; {{ date('Y') }} SoulCare Indonesia. Hak Cipta Dilindungi.
                            </p>
                            <p style="margin: 0; color: #9ca3af; font-size: 11px;">
                                Jika Anda kesulitan mengeklik tombol, silakan buka tautan ini:<br>
                                <a href="{{ $url }}" style="color: #7c3aed; text-decoration: none;">{{ $url }}</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>