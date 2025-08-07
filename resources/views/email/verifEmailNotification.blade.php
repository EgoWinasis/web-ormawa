@component('mail::message')
# Verifikasi Email Web Ormawa POLTEK HARBER

Halo, terima kasih telah mendaftar di **Web Ormawa POLTEK HARBER**!

Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda dan mengaktifkan akun Anda:

@component('mail::button', ['url' => $verificationUrl])
Verifikasi Email
@endcomponent

Jika Anda tidak mendaftar untuk akun ini, Anda dapat mengabaikan email ini.

Terima kasih,<br>
**Tim Web Ormawa POLTEK HARBER**

@endcomponent