@component('mail::message')

# Perubahan Status Pendaftaran di Web Ormawa POLTEK HARBER

Halo {{ $calon->name }},  <!-- Akses data calon -->

Kami ingin memberitahukan bahwa status pendaftaran Anda telah diperbarui. Berikut adalah informasi terbaru mengenai status pendaftaran Anda:

**Status Pendaftaran**: {{ $calon->status }}

**Keterangan**: {{ $calon->keterangan }}

{{-- **Tempat Wawancara**: {{ $calon->tempat_wawancara }}

**Tanggal**: {{ $calon->tgl_wawancara }} **Jam**: {{ $calon->jam_wawancara }} --}}

Silakan cek status pendaftaran Anda secara lengkap di website kami untuk detail lebih lanjut.

@component('mail::button', ['url' => $websiteUrl])  <!-- URL untuk cek status -->
Cek Status Pendaftaran
@endcomponent

Jika Anda tidak melakukan pendaftaran atau ada pertanyaan lainnya, jangan ragu untuk menghubungi kami.

Terima kasih,<br>
**Tim Web Ormawa POLTEK HARBER**

@endcomponent