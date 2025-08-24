<!-- Chatbot Toggle Button -->
<div id="chat-toggle" class="position-fixed bottom-0 end-0 m-3 z-3">
    <button class="btn btn-primary rounded-circle p-3 shadow" id="chat-icon">
        <i class="fas fa-comment-dots fa-fw fa-lg"></i>
    </button>
</div>


</div>

<!-- Chatbot Box -->
<div id="chatbot-box" class="card chatbot-box shadow d-none">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <span>Chatbot Ormawa</span>

    </div>
    <div class="card-body" id="chatbox">

    </div>
    <div class="card-footer bg-white">
        <div class="input-group">
            <input type="text" id="user-input" class="form-control" placeholder="Masukkan pertanyaan...">
            <button class="btn btn-primary" id="send-btn"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
</div>



<style>
    .chatbot-box {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 500px;
        height: 500px;
        z-index: 1040;
        display: flex;
        flex-direction: column;
    }

    #chatbox {
        flex: 1;
        overflow-y: auto;
        padding-right: 5px;
        max-height: 400px;
    }

    .bot-msg,
    .user-msg {
        max-width: 75%;
        padding: 10px 15px;
        border-radius: 20px;
        margin-bottom: 10px;
    }

    .bot-msg {
        background-color: #f1f1f1;
    }

    .user-msg {
        background-color: #0d6efd;
        color: white;
        align-self: flex-end;
    }

    .quick-options {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }

    .quick-options button {
        border-radius: 15px;
        font-size: 0.875rem;
        pointer-events: none;
    }

    #chat-icon i {
        width: 1.25em;
        /* or any fixed width */
        text-align: center;
    }

    .chat-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
        align-self: flex-end;
    }

    .bot-msg,
    .user-msg {
        max-width: 70%;
        padding: 10px 14px;
        border-radius: 18px;
        font-size: 14px;
        line-height: 1.4;
        display: inline-block;
        word-wrap: break-word;
    }

    .bot-msg {
        background-color: #f1f1f1;
        color: #000;
        border-top-left-radius: 5px;
        margin-left: 5px;
    }

    .user-msg {
        background-color: #0d6efd;
        color: #fff;
        border-top-right-radius: 5px;
        margin-right: 5px;
    }

    .quick-options button {
        border-radius: 20px;
        font-size: 13px;
        padding: 6px 12px;
        pointer-events: none;
        opacity: 0.8;
    }

    .typing-indicator {
        background: #f1f1f1;
        border-radius: 18px;
        padding: 10px 15px;
        display: inline-flex;
        gap: 5px;
        align-items: center;
        height: 24px;
    }

    .typing-indicator span {
        width: 6px;
        height: 6px;
        background-color: #999;
        border-radius: 50%;
        display: inline-block;
        animation: typingBlink 1.4s infinite both;
    }

    .typing-indicator span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-indicator span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes typingBlink {

        0%,
        80%,
        100% {
            opacity: 0;
        }

        40% {
            opacity: 1;
        }
    }

</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chatIcon = document.getElementById('chat-icon');
        const chatBox = document.getElementById('chatbot-box');
        const sendBtn = document.getElementById('send-btn');
        const chatbox = document.getElementById('chatbox');
        const input = document.getElementById('user-input');

        let activeMenu = null;

        const menuGroups = {
            "Tentang Organisasi": [{
                    label: "Pengertian",
                    key: "pengertian"
                },
                {
                    label: "Tujuan",
                    key: "tujuan"
                },
                {
                    label: "Ciri",
                    key: "ciri"
                }
            ],
            "List Organisasi": {
                "BEM": [{
                        label: "Visi",
                        key: "bem_visi"
                    },
                    {
                        label: "Misi",
                        key: "bem_misi"
                    },
                    {
                        label: "Struktur",
                        key: "bem_struktur"
                    },
                    {
                        label: "Tugas",
                        key: "bem_tugas"
                    },
                    {
                        label: "anggota",
                        key: "bem_anggota"
                    },
                  
                ],
                {{-- menambahkan oraganisa baru --}}
                "BPM": [{
                        label: "Visi",
                        key: "bpm_visi"
                    },
                    {
                        label: "Misi",
                        key: "bpm_misi"
                    },
                    {
                        label: "Struktur",
                        key: "bpm_struktur"
                    },
                    {
                        label: "Tugas",
                        key: "bpm_tugas"
                    }
                ],
                "AKUNTANSI": [
        { label: "Visi", key: "akuntansi_visi" },
        { label: "Misi", key: "akuntansi_misi" },
        { label: "Struktur", key: "akuntansi_struktur" },
        { label: "Tugas", key: "akuntansi_tugas" }
    ],
    "ASP": [
        { label: "Visi", key: "asp_visi" },
        { label: "Misi", key: "asp_misi" },
        { label: "Struktur", key: "asp_struktur" },
        { label: "Tugas", key: "asp_tugas" }
    ],
    "DKV": [
        { label: "Visi", key: "dkv_visi" },
        { label: "Misi", key: "dkv_misi" },
        { label: "Struktur", key: "dkv_struktur" },
        { label: "Tugas", key: "dkv_tugas" }
    ],
    "ELEKTRO": [
        { label: "Visi", key: "elektro_visi" },
        { label: "Misi", key: "elektro_misi" },
        { label: "Struktur", key: "elektro_struktur" },
        { label: "Tugas", key: "elektro_tugas" }
    ],
    "FARMASI": [
        { label: "Visi", key: "farmasi_visi" },
        { label: "Misi", key: "farmasi_misi" },
        { label: "Struktur", key: "farmasi_struktur" },
        { label: "Tugas", key: "farmasi_tugas" }
    ],
    "KEBIDANAN": [
        { label: "Visi", key: "kebidanan_visi" },
        { label: "Misi", key: "kebidanan_misi" },
        { label: "Struktur", key: "kebidanan_struktur" },
        { label: "Tugas", key: "kebidanan_tugas" }
    ],
    "KOMPUTER": [
        { label: "Visi", key: "komputer_visi" },
        { label: "Misi", key: "komputer_misi" },
        { label: "Struktur", key: "komputer_struktur" },
        { label: "Tugas", key: "komputer_tugas" }
    ],
    "MESIN": [
        { label: "Visi", key: "mesin_visi" },
        { label: "Misi", key: "mesin_misi" },
        { label: "Struktur", key: "mesin_struktur" },
        { label: "Tugas", key: "mesin_tugas" }
    ],
    "PERHOTELAN": [
        { label: "Visi", key: "perhotelan_visi" },
        { label: "Misi", key: "perhotelan_misi" },
        { label: "Struktur", key: "perhotelan_struktur" },
        { label: "Tugas", key: "perhotelan_tugas" }
    ],
    "TI": [
        { label: "Visi", key: "ti_visi" },
        { label: "Misi", key: "ti_misi" },
        { label: "Struktur", key: "ti_struktur" },
        { label: "Tugas", key: "ti_tugas" }
    ],
            },
            "Struktur & Tugas": [{
                    label: "Struktur",
                    key: "struktur"
                },
                {
                    label: "Tugas",
                    key: "tugas"
                },
                {
                    label: "Ketua",
                    key: "ketua"
                }
            ],
            "Visi & Misi": [{
                    label: "Visi",
                    key: "visi"
                },
                {
                    label: "Misi",
                    key: "misi"
                }
            ],
            "Pendaftaran": [{
                    label: "Daftar",
                    key: "daftar"
                },
                {
                    label: "Registrasi",
                    key: "regist"
                }
            ],
            "Kegiatan": [{
                    label: "Jadwal",
                    key: "jadwal"
                }
            ]
        };

        const responses = {
            pengertian: "Menurut Prof. Dr. Sondang P. Siagian, organisasi adalah suatu bentuk persekutuan antara dua orang atau lebih yang bekerja bersama serta secara formal terikat dalam rangka pencapaian tujuan yang telah ditentukan dan dalam ikatan itu terdapat seorang atau sekelompok orang yang disebut bawahan.",
            tujuan: "Tujuan dibentuknya organisasi secara umum antara lain meningkatkan kemandirian, merealisasikan keinginan dan cita-cita bersama, memperoleh keuntungan atau penghasilan bersama, meningkatkan pengalaman serta interaksi dengan anggota lainnya, memperoleh pengakuan serta penghargaan, hingga mengatasi keterbatasan kemampuan guna meraih tujuan bersama.",
            ciri: "Terdapat beberapa ciri organisasi antara lain terdiri dari dua orang atau lebih, memiliki tujuan yang sama dan ingin mewujudkannya, saling bekerja sama, memiliki peraturan, serta ada pembagian tugas juga tanggung jawab bagi anggotanya.",
            struktur: "Struktur organisasi terdiri dari ketua, sekretaris, bendahara, dan divisi lainnya.",
            tugas: "Setiap anggota memiliki tugas sesuai struktur.",
            ketua: "Ketua adalah pemimpin utama.",
            visi: "Visi adalah gambaran jangka panjang.",
            misi: "Misi adalah langkah untuk mencapai visi.",
            daftar: 'Untuk mendaftar sebagai anggota baru, klik <a href="/register" class="linkDaftar">di sini</a>.',
            regist: "Silakan registrasi melalui link resmi.",
            jadwal: `<p>
  Untuk melihat jadwal, klik
  <a href="/jadwal.pdf" class="btn btn-danger btn-sm" target="_blank">
    <i class="fas fa-file-pdf"></i> di sini
  </a>.
</p>`,
// \bem
            bem_visi: 'Dengan visi kami "Menjadikan BEM Politeknik Harapan Bersama Sebagai Wadah Untuk Mewujudkan Mahasiswa yang Cerah (Cerdas, Religius, Aktif, & Harmonis)',
            bem_misi: 'Misi: <br>1. Mendorong Pengembangan Kualitas Sumber daya Mahasiswa PHB. <br>2. Meningkatnya Produktifitas dan Kreatifitas. <br>3. Terciptanya solidaritas mahasisiwa yang advokatif dan Berkesinambungan.<br>4. Terwujudnya BEM yang Harmonis dan aspiratif.',
            bem_struktur: `
<b>Struktur Organisasi BEM</b>
<ol>
    <li>PRESMA</li>
    <li>WAPRESMA</li>
    <li>Sekretaris</li>
    <li>Bendahara</li>
    <li>KOMINFO</li>
    <li>DEPSOS</li>
    <li>ADKESMA</li>
    <li>KMB</li>
    <li>KKP</li>
</ol>
`,
            bem_tugas: `<b>Ketua BEM</b>
<ul>
    <li>Memimpin dan mengkoordinasikan kegiatan BEM KM PHB</li>
    <li>Memberikan laporan pertanggung jawaban di akhir periode kepada BPM</li>
    <li>Mengkoordinasikan kinerja Himpunan Mahasiswa Program Studi yang ada di Politeknik Harapan Bersama</li>
    <li>Mengangkat dan memberhentikan anggota BEM KM PHB</li>
    <li>Menjalankan tugas menurut AD / ART BEM KM PHB</li>
    <li>Memberikan sanksi dengan tegas anggota BEM KM PHB sesuai AD/ART</li>
</ul>

<b>Wakil Ketua BEM</b>
<ul>
    <li>Membantu ketua BEM dalam menjalankan tugasnya</li>
    <li>Menjalankan tugas-tugas ketua BEM apabila ketua BEM tidak bisa hadir atau sedang berhalangan</li>
    <li>Mengelola Rumah Tangga di Lembaga BEM KM PHB</li>
    <li>Menjalankan tugas menurut AD / ART BEM KM PHB</li>
</ul>

<b>Sekretaris 1</b>
<ul>
    <li>Berkoordinasi dan merumuskan SOP lembaga KM PHB bersama Sekretaris Umum BPM</li>
    <li>Menguasai birokrasi proposal, undangan, dan surat menyurat</li>
    <li>Bertanggung jawab terhadap tata naskah dinas yang dibutuhkan</li>
    <li>Mengelola absensi BEM KM PHB</li>
    <li>Membantu permasalahan birokrasi proposal ormawa dengan pengecekan format sesuai SOP</li>
    <li>Melakukan pengarsipan dan perapihan dokumen BEM KM PHB</li>
</ul>

<b>Sekretaris 2</b>
<ul>
    <li>Menjalankan tugas-tugas Sekretaris 1 apabila tidak bisa hadir atau berhalangan</li>
    <li>Mengelola inventaris penunjang organisasi</li>
    <li>Pengawasan inventaris BEM KM PHB</li>
    <li>Membantu Sekretaris 1 dalam menjalankan tugas sesuai AD / ART BEM KM PHB</li>
</ul>

<b>Bendahara 1</b>
<ul>
    <li>Pertanggungjawaban utama dalam pengelolaan keuangan BEM KM PHB</li>
    <li>Mengatur dan mengawasi arus dana masuk dan keluar BEM dan ormawa</li>
    <li>Merumuskan dan menetapkan kebijakan di bidang keuangan</li>
    <li>Menopang kemandirian keuangan BEM KM PHB</li>
</ul>

<b>Bendahara 2</b>
<ul>
    <li>Menjalankan tugas Bendahara 1 apabila berhalangan</li>
    <li>Membantu Bendahara 1 dalam koordinasi dan tugas sesuai AD / ART</li>
</ul>

<b>Kepala Departemen Advokasi dan Kesejahteraan Mahasiswa</b>
<ul>
    <li>Bertanggung jawab kepada Ketua BEM KM PHB</li>
    <li>Penanggung jawab tertinggi Departemen Advokasi & Kesejahteraan Mahasiswa</li>
    <li>Berorientasi pada kajian dan responsif terhadap isu masyarakat</li>
</ul>

<b>Kepala Departemen Sosial</b>
<ul>
    <li>Bertanggung jawab kepada Ketua BEM KM PHB</li>
    <li>Penanggung jawab tertinggi Departemen Sosial</li>
    <li>Berorientasi pada kegiatan sosial dan kerohanian di lingkungan PHB</li>
</ul>

<b>Kepala Departemen Komunikasi dan Informasi</b>
<ul>
    <li>Bertanggung jawab kepada Ketua BEM KM PHB</li>
    <li>Penanggung jawab tertinggi Departemen Komunikasi dan Informasi</li>
    <li>Membuat dan memperbarui database anggota ormawa KM PHB</li>
</ul>

<b>Kepala Departemen Kepemudaan dan Minat Bakat</b>
<ul>
    <li>Bertanggung jawab kepada Ketua BEM KM PHB</li>
    <li>Penanggung jawab tertinggi Departemen Kepemudaan dan Minat Bakat</li>
    <li>Melakukan kaderisasi bersama HIMAPRODI untuk organisasi yang baik</li>
</ul>

<b>Kepala Departemen Kekaryaan, Kewirausahaan dan Penalaran</b>
<ul>
    <li>Bertanggung jawab kepada Ketua BEM KM PHB</li>
    <li>Penanggung jawab tertinggi Departemen Kekaryaan, Kewirausahaan dan Penalaran</li>
    <li>Menjalin hubungan mitra internal maupun eksternal dalam kewirausahaan</li>
</ul>
`,

bpm_visi: `
<b>Visi BPM KM PHB</b><br>
<i>“Mewujudkan lembaga perwakilan mahasiswa yang inovatif, aspiratif, dan berintegritas berasaskan Pancasila.”</i>
`,

bpm_misi: `
<b>Misi BPM KM PHB</b>
<ol>
    <li>Menampung dan menyalurkan aspirasi mahasiswa yang bersifat membangun.</li>
    <li>Mengawasi dan mengevaluasi kinerja KM PHB.</li>
</ol>
`,

bpm_struktur : `
<b>Struktur Organisasi BPM</b>
<ol>
    <li>Ketua Umum</li>
    <li>Sekretaris Umum</li>
    <li>Bendahara</li>
    <li>Hubungan Mahasiswa I</li>
    <li>Hubungan Mahasiswa II</li>
    <li>Komisi I</li>
    <li>Komisi II</li>
    <li>Komisi III</li>
    <li>Komisi IV</li>
</ol>
`
,
// bpm
            bpm_tugas: `
<b>#Tugas Pokok Struktural BPM</b><br><br>

<b>Ketua Umum BPM</b>
<ol>
    <li>Memimpin BPM KM PHB dalam kegiatan keorganisasian.</li>
    <li>Mengkoordinir dan mengawasi pelaksanaan program kerja.</li>
    <li>Membuat keputusan bijak dan bertanggung jawab atas segala hal yang dilakukan BPM KM PHB tanpa menyimpang dari AD/ART.</li>
</ol>

<b>Sekretaris Umum</b>
<ol>
    <li>Membantu Ketua Umum dalam melaksanakan tugas-tugas yang berhubungan dengan BPM KM PHB.</li>
    <li>Mengatur segala urusan yang berhubungan dengan kesekretariatan KM PHB.</li>
    <li>Melakukan pengawasan pada alur keluar dan masuk kesekretariatan BPM KM PHB.</li>
    <li>Berkoordinasi dengan Sekretaris BEM untuk merumuskan SOP unit KM PHB.</li>
</ol>

<b>Bendahara Umum</b>
<ol>
    <li>Mengatur keuangan BPM KM PHB.</li>
    <li>Membuat laporan anggaran pengeluaran dan pemasukan BPM KM PHB.</li>
    <li>Merancang Rencana Anggaran Biaya BPM KM PHB.</li>
</ol>

<b>Hubungan Mahasiswa I</b>
<ol>
    <li>Menyusun dan menyampaikan informasi kepada internal kampus.</li>
    <li>Bertanggung jawab menjalankan penyebaran informasi ke pihak internal kampus.</li>
    <li>Mempublikasikan kegiatan & program kerja KM PHB, serta merancang desain dan konten kreatif untuk BPM KM PHB.</li>
</ol>

<b>Hubungan Mahasiswa II</b>
<ol>
    <li>Menjalin dan mengembangkan hubungan antar lembaga di luar kampus (bilateral/multilateral).</li>
    <li>Bertanggung jawab atas penyebaran informasi kepada pihak eksternal kampus.</li>
    <li>Membantu Humas I dalam publikasi kegiatan serta merancang desain dan konten kreatif.</li>
</ol>

<b>Ketua Komisi</b>
<ol>
    <li>Bertanggung jawab atas segala hal terkait komisinya.</li>
    <li>Memberikan motivasi dan arahan kepada anggotanya agar menjalankan tugas dengan baik.</li>
    <li>Merumuskan Undang-Undang bersama Badan Pengurus Harian BPM KM PHB.</li>
</ol>

<b>Komisi I (Yudisial)</b>
<ol>
    <li>Merumuskan AD/ART BPM KM PHB.</li>
    <li>Mengeluarkan Surat Keputusan untuk setiap kegiatan KM PHB.</li>
</ol>

<b>Komisi II (Pengawasan)</b>
<ol>
    <li>Menindaklanjuti anggota KM PHB yang melanggar tata tertib.</li>
    <li>Mengawasi dan menilai kedisiplinan pelaksanaan program kerja.</li>
    <li>Mengevaluasi program kerja yang telah dijalankan KM PHB.</li>
</ol>

<b>Komisi III (Budgeting)</b>
<ol>
    <li>Mengawasi alur masuk dan keluar anggaran KM PHB.</li>
    <li>Mengawasi kinerja Bendahara BEM.</li>
    <li>Mengawasi dana sosial dan dana denda LPJ oleh Departemen Sosial dan Bendahara BEM.</li>
</ol>

<b>Komisi IV (Advokasi)</b>
<ol>
    <li>Menampung aspirasi mahasiswa Politeknik Harapan Bersama.</li>
    <li>Berkoordinasi dengan Departemen Adkesma BEM KM PHB untuk menindaklanjuti aspirasi mahasiswa.</li>
    <li>Mencari informasi di internal dan eksternal kampus.</li>
</ol>
`
,
// akuntansi
            akuntansi_visi: "Visi Akuntansi: Profesionalisme akuntan muda.",
            akuntansi_misi: "Misi: Literasi keuangan, kolaborasi internal eksternal.",
           
            akuntansi_tugas: `
<b>Tugas Pokok Struktural HIMAPRODI Akuntansi KM PHB</b><br><br>

<b>Ketua HIMAPRODI Akuntansi KM PHB</b>
<ol>
    <li>Menjalankan atau memimpin rapat organisasi.</li>
    <li>Menjalankan tugas menurut AD/ART HIMAPRODI Akuntansi KM PHB.</li>
    <li>Memimpin dan mengkoordinasikan kegiatan HIMAPRODI Akuntansi KM PHB.</li>
    <li>Memberikan laporan pertanggungjawaban di akhir periode.</li>
</ol>

<b>Wakil Ketua HIMAPRODI Akuntansi KM PHB</b>
<ol>
    <li>Membantu Ketua dalam menjalankan organisasi.</li>
    <li>Mewakili Ketua apabila yang bersangkutan berhalangan hadir.</li>
</ol>

<b>Sekretaris I</b>
<ol>
    <li>Melakukan pengarsipan dan perapihan dokumen HIMAPRODI.</li>
    <li>Membuat dokumentasi hasil rapat.</li>
    <li>Menyusun dokumen-dokumen kesekretariatan.</li>
    <li>Bertanggung jawab terhadap tata naskah dinas yang dibutuhkan.</li>
    <li>Mengelola inventaris penunjang organisasi.</li>
</ol>

<b>Sekretaris II</b>
<ol>
    <li>Aktif membantu pelaksanaan tugas Sekretaris I.</li>
    <li>Menggantikan Sekretaris I jika berhalangan.</li>
    <li>Mengawasi inventaris HIMAPRODI Akuntansi KM PHB.</li>
</ol>

<b>Bendahara I</b>
<ol>
    <li>Bertanggung jawab atas pengelolaan keuangan HIMAPRODI.</li>
    <li>Mengatur dan mengawasi arus kas masuk dan keluar.</li>
    <li>Merumuskan serta menetapkan kebijakan di bidang keuangan.</li>
</ol>

<b>Bendahara II</b>
<ol>
    <li>Mewakili Bendahara I jika berhalangan hadir.</li>
    <li>Membantu koordinasi dan pelaksanaan tugas keuangan sesuai AD/ART.</li>
</ol>

<b>Department RnD (Research and Development)</b>
<ol>
    <li>Bertanggung jawab kepada Ketua HIMAPRODI.</li>
    <li>Penanggung jawab tertinggi departemen ini.</li>
    <li>Mengembangkan akademik mahasiswa.</li>
    <li>Memfasilitasi pengembangan akademik mahasiswa.</li>
</ol>

<b>Department HRD (Human Resource Department)</b>
<ol>
    <li>Bertanggung jawab kepada Ketua HIMAPRODI.</li>
    <li>Penanggung jawab tertinggi departemen ini.</li>
    <li>Menampung aspirasi mahasiswa yang membangun.</li>
    <li>Mengadakan diskusi rutin setelah UTS dengan Prodi dan komting kelas.</li>
    <li>Mengembangkan kompetensi mahasiswa secara aktif maupun pasif.</li>
</ol>

<b>Department Entrepreneur</b>
<ol>
    <li>Bertanggung jawab kepada Ketua HIMAPRODI.</li>
    <li>Penanggung jawab tertinggi departemen ini.</li>
    <li>Menampung jiwa kewirausahaan mahasiswa.</li>
    <li>Menjalankan program Pojok Entrepreneur.</li>
</ol>

<b>Department PR (Public Relation)</b>
<ol>
    <li>Bertanggung jawab kepada Ketua HIMAPRODI.</li>
    <li>Penanggung jawab tertinggi departemen ini.</li>
    <li>Menangani keseimbangan antara kegiatan internal dan eksternal.</li>
    <li>Memperkenalkan HIMAPRODI Akuntansi secara luas di lingkungan internal dan eksternal kampus.</li>
</ol>

<b>Department MP (Media and Publication)</b>
<ol>
    <li>Bertanggung jawab kepada Ketua HIMAPRODI.</li>
    <li>Penanggung jawab tertinggi departemen ini.</li>
    <li>Mengelola media sosial HIMAPRODI Akuntansi.</li>
    <li>Mempublikasikan kegiatan HIMAPRODI melalui berbagai media.</li>
</ol>
`,

// ASP
asp_tugas: `
<b>Tugas Pokok Struktural HIMAPRODI ASP KM PHB</b><br><br>

<b>Ketua HIMAPRODI ASP</b>
<ol>
    <li>Menjalankan atau memimpin rapat organisasi.</li>
    <li>Menjalankan tugas menurut AD/ART HIMAPRODI ASP KM PHB.</li>
    <li>Memimpin dan mengkoordinasikan kegiatan HIMAPRODI ASP KM PHB.</li>
    <li>Memberikan laporan pertanggungjawaban di akhir periode.</li>
</ol>

<b>Wakil Ketua HIMAPRODI ASP KM PHB</b>
<ol>
    <li>Membantu Ketua dalam menjalankan organisasi.</li>
    <li>Mewakili Ketua apabila yang bersangkutan berhalangan hadir.</li>
</ol>

<b>Sekretaris HIMAPRODI ASP KM PHB</b>
<ol>
    <li>Melakukan pengarsipan dan perapihan dokumen organisasi.</li>
    <li>Menjadi notulen dalam setiap rapat.</li>
    <li>Bertanggung jawab terhadap seluruh arsip organisasi.</li>
    <li>Menjalankan tugas sesuai AD/ART HIMAPRODI ASP KM PHB.</li>
</ol>

<b>Bendahara</b>
<ol>
    <li>Bertanggung jawab atas pengelolaan keuangan HIMAPRODI ASP.</li>
    <li>Mengatur dan mengawasi arus kas masuk dan keluar.</li>
    <li>Merumuskan dan menetapkan kebijakan di bidang keuangan.</li>
    <li>Menjalankan tugas sesuai AD/ART HIMAPRODI ASP KM PHB.</li>
</ol>

<b>Divisi RnD (Research and Development)</b>
<ol>
    <li>Bertanggung jawab kepada Ketua HIMAPRODI ASP KM PHB.</li>
    <li>Penanggung jawab tertinggi di bidang riset dan pengembangan.</li>
    <li>Bertujuan untuk mengembangkan akademik mahasiswa.</li>
    <li>Memfasilitasi mahasiswa dalam kegiatan kelompok belajar.</li>
</ol>

<b>Divisi JIK (Jaringan Informasi dan Komunikasi)</b>
<ol>
    <li>Bertanggung jawab kepada Ketua HIMAPRODI ASP KM PHB.</li>
    <li>Penanggung jawab tertinggi JIK.</li>
    <li>Mengembangkan komunikasi antar mahasiswa.</li>
    <li>Bertanggung jawab atas seluruh informasi yang berkaitan dengan mahasiswa.</li>
</ol>

<b>Divisi DP2M (Divisi Pengembangan Potensi Mahasiswa)</b>
<ol>
    <li>Bertanggung jawab kepada Ketua HIMAPRODI ASP KM PHB.</li>
    <li>Penanggung jawab tertinggi DP2M.</li>
    <li>Berperan sebagai penampung aspirasi mahasiswa.</li>
    <li>Mempublikasikan informasi kegiatan dan program kerja HIMAPRODI ASP KM PHB.</li>
</ol>
`,

// dkv

dkv_tugas: `
<b>Tugas Pokok Struktural HIMA Prodi Desain Komunikasi Visual KM PHB</b><br><br>

<b>Ketua</b>
<ol>
    <li>Mewakili nama HIMA Prodi Desain Komunikasi Visual PHB dalam setiap kegiatan keorganisasian.</li>
    <li>Mengangkat dan memberhentikan Pengurus HIMA Prodi DKV PHB.</li>
    <li>Memimpin dan mengkoordinasikan kegiatan HIMA Prodi DKV PHB.</li>
    <li>Menandatangani surat-surat, baik ke dalam maupun keluar organisasi.</li>
</ol>

<b>Wakil Ketua</b>
<ol>
    <li>Membantu Ketua dalam menjalankan tugasnya.</li>
    <li>Menggantikan Ketua bila berhalangan hadir dengan seizin Ketua.</li>
    <li>Aktif dalam kegiatan yang dilaksanakan oleh HIMA Prodi DKV PHB.</li>
</ol>

<b>Sekretaris</b>
<ol>
    <li>Menciptakan sistem administrasi kesekretariatan yang profesional.</li>
    <li>Melakukan pengarsipan dan perapihan dokumen organisasi.</li>
    <li>Membuat dokumen-dokumen kesekretariatan.</li>
    <li>Bertanggung jawab terhadap tata naskah dinas yang dibutuhkan.</li>
</ol>

<b>Bendahara</b>
<ol>
    <li>Bertanggung jawab atas pengelolaan keuangan HIMA Prodi DKV.</li>
    <li>Mengatur dan mengawasi arus kas masuk dan keluar organisasi.</li>
    <li>Merumuskan dan menetapkan kebijakan di bidang keuangan.</li>
    <li>Mengelola inventaris penunjang kegiatan organisasi.</li>
</ol>

<b>Departemen Pengembangan Keterampilan Mahasiswa</b>
<ol>
    <li>Mencari dan menyalurkan bakat mahasiswa DKV.</li>
    <li>Mengembangkan minat dan bakat melalui pelatihan, proyek, seminar, atau webinar bersama Prodi DKV.</li>
    <li>Menaungi kegiatan sosial untuk mewujudkan lingkungan mahasiswa yang beradab dan humanis.</li>
</ol>

<b>Departemen Humas</b>
<ol>
    <li>Menjalin kerja sama dengan pihak internal dan eksternal.</li>
    <li>Menjadi fasilitator komunikasi antar berbagai pihak.</li>
    <li>Membangun dan menjaga kinerja aktif antar anggota HIMA Prodi DKV.</li>
    <li>Melaksanakan peran kehumasan dalam setiap kegiatan HIMA Prodi DKV.</li>
</ol>

<b>Departemen Komunikasi dan Informasi</b>
<p>Bertanggung jawab menjalin komunikasi dan menyebarkan informasi ke internal dan eksternal, baik kepada mahasiswa DKV, non-DKV, maupun masyarakat umum.</p>

<b>Departemen Konten Kreatif</b>
<ol>
    <li>Menulis, meninjau, mengedit, dan membuat konten untuk platform HIMA Prodi DKV.</li>
    <li>Melakukan riset dan wawancara untuk memahami tren serta mengembangkan konten.</li>
    <li>Bekerja sama dengan Departemen Kominfo untuk mempersiapkan materi konten.</li>
</ol>
`
,

// elektro
elektro_tugas: `
<b>Tugas Pokok Struktural HIMAPRODI Elektro KM PHB</b><br><br>

<b>Ketua</b>
<ol>
    <li>Mengkoordinasikan, merencanakan, menggerakkan, dan mengawasi kegiatan HIMAPRODI Elektro KM PHB.</li>
    <li>Bertanggung jawab atas kegiatan yang dilaksanakan.</li>
    <li>Berkoordinasi dengan Bidang Kemahasiswaan Program Studi DIII Teknik Elektronika.</li>
    <li>Memberikan laporan pertanggungjawaban di akhir periode.</li>
</ol>

<b>Sekretaris</b>
<ol>
    <li>Menciptakan sistem administrasi kesekretariatan yang baik dan sesuai SOP.</li>
    <li>Melakukan pengarsipan dan mengelola dokumen organisasi.</li>
    <li>Mendokumentasikan hasil rapat.</li>
    <li>Membuat dokumen-dokumen kesekretariatan.</li>
    <li>Bertanggung jawab terhadap tata naskah dinas yang dibutuhkan.</li>
</ol>

<b>Bendahara</b>
<ol>
    <li>Bertanggung jawab atas pengelolaan keuangan HIMAPRODI Elektro KM PHB.</li>
    <li>Membukukan semua pengeluaran dan mencatat dana masuk beserta tanggalnya.</li>
    <li>Menyediakan nota masuk dan meminta nota pembelian atas transaksi keuangan.</li>
    <li>Meminta persetujuan Ketua sebelum mengeluarkan dana, serta berkoordinasi dengan anggota lain.</li>
</ol>

<b>Divisi Pengembangan Minat dan Bakat</b>
<ol>
    <li>Menyelenggarakan kegiatan akademik, seni, dan olahraga untuk meningkatkan potensi mahasiswa.</li>
    <li>Bertanggung jawab terhadap pengembangan minat dan bakat mahasiswa.</li>
    <li>Berkoordinasi dengan Ketua HIMAPRODI Elektro KM PHB.</li>
</ol>

<b>Divisi Sosial</b>
<ol>
    <li>Menjalin hubungan baik dalam kehidupan bermasyarakat.</li>
    <li>Menumbuhkan rasa kemanusiaan terhadap sesama.</li>
    <li>Menjadi media untuk memberikan bantuan kepada sesama.</li>
</ol>

<b>Divisi Humas</b>
<ol>
    <li>Menjalin hubungan baik dengan mahasiswa, civitas akademika, dan pihak eksternal yang terkait.</li>
    <li>Mencari pengetahuan baru dan menerapkannya di dalam organisasi.</li>
    <li>Bekerja sama dengan lembaga eksternal untuk meningkatkan kompetensi anggota.</li>
</ol>

<b>Divisi Publikasi</b>
<ol>
    <li>Membuat dan mengelola konten media sosial HIMAPRODI Elektro KM PHB.</li>
    <li>Mendokumentasikan semua kegiatan yang dilaksanakan oleh HIMAPRODI Elektro.</li>
</ol>

<b>Divisi Kewirausahaan</b>
<ol>
    <li>Melakukan kegiatan kewirausahaan secara kreatif dan inovatif dalam lingkungan Prodi Teknik Elektronika.</li>
    <li>Menggerakkan kemandirian pengurus dan anggota melalui edukasi peluang usaha kreatif.</li>
</ol>
`,

// farmasi


farmasi_tugas: `
<b>Tugas Pokok Struktural HIMAPRODI Farmasi KM PHB</b><br><br>

<b>Ketua</b>
<ol>
  <li>Pemegang dan pengambil kebijakan umum organisasi.</li>
  <li>Bertanggung jawab atas semua kegiatan dan program kerja organisasi.</li>
  <li>Menyampaikan informasi internal dan eksternal kampus.</li>
  <li>Menjalin komunikasi baik antar anggota.</li>
  <li>Membantu anggota yang mengalami kesulitan dalam mengerjakan tugasnya.</li>
</ol>

<b>Wakil Ketua</b>
<ol>
  <li>Membantu dan mendampingi Ketua dalam menjalankan organisasi.</li>
  <li>Mewakili tugas-tugas Ketua apabila berhalangan.</li>
  <li>Memfokuskan tugas dan kegiatan yang ada di internal organisasi.</li>
  <li>Bertanggung jawab kepada Ketua HIMAPRODI Farmasi KM PHB.</li>
</ol>

<b>Sekretaris</b>
<ol>
  <li>Membuat proposal, laporan pertanggungjawaban, dan mencatat hasil rapat.</li>
  <li>Mengelola dan mendeskripsikan seluruh berkas organisasi.</li>
  <li>Mendampingi Ketua dalam menjalankan organisasi.</li>
  <li>Bertanggung jawab kepada Ketua HIMAPRODI Farmasi KM PHB.</li>
</ol>

<b>Bendahara</b>
<ol>
  <li>Pemegang kebijakan umum dalam pengelolaan keuangan organisasi.</li>
  <li>Mencatat, menyimpan, dan mengatur keuangan organisasi.</li>
  <li>Mendampingi Ketua/Wakil Ketua dalam menjalankan organisasi.</li>
  <li>Bertanggung jawab kepada Ketua HIMAPRODI Farmasi KM PHB.</li>
</ol>

<b>Divisi Humas</b>
<ol>
  <li>Memberikan informasi tentang perkembangan organisasi dan program kerja internal.</li>
  <li>Menjalin kerja sama dengan organisasi lain.</li>
  <li>Mengumpulkan dan menyampaikan informasi demi kepentingan organisasi.</li>
  <li>Mendistribusikan surat dan undangan program kerja ke pihak eksternal.</li>
</ol>

<b>Divisi Kominfo</b>
<ol>
  <li>Menampung dan menyalurkan aspirasi serta informasi kegiatan organisasi.</li>
  <li>Bertanggung jawab atas dokumentasi foto dan video kegiatan organisasi.</li>
  <li>Memfasilitasi divisi lain untuk menyampaikan atau mempublikasikan informasi.</li>
</ol>

<b>Divisi Kekeluargaan</b>
<ol>
  <li>Mengatur pelaksanaan seluruh program kerja HIMAPRODI Farmasi KM PHB.</li>
  <li>Menjalin komunikasi dan hubungan harmonis antar anggota.</li>
  <li>Berkoordinasi dan bekerja sama antar divisi.</li>
</ol>

<b>Divisi Minat dan Bakat</b>
<ol>
  <li>Bertanggung jawab atas informasi terkait pengembangan minat dan bakat mahasiswa Prodi Farmasi.</li>
  <li>Membantu mahasiswa dalam pengembangan wawasan dan keterampilan baik akademik maupun non-akademik.</li>
</ol>
`
,

// kebidanan

kebidanan_tugas: `
<b>Tugas Pokok Struktural HIMAPRODI Kebidanan KM PHB</b><br><br>

<b>Ketua</b>
<ol>
  <li>Merencanakan, mengorganisasikan, dan mengawasi jalannya organisasi.</li>
  <li>Bertanggung jawab atas kegiatan yang dilaksanakan oleh HIMAPRODI Kebidanan.</li>
  <li>Menyusun struktur dan pengarahan organisasi.</li>
</ol>

<b>Wakil Ketua</b>
<ol>
  <li>Membantu Ketua HIMAPRODI Kebidanan dalam menjalankan tugasnya.</li>
</ol>

<b>Sekretaris</b>
<ol>
  <li>Bertanggung jawab atas kesekretariatan administrasi HIMAPRODI Kebidanan.</li>
  <li>Mendokumentasikan hasil rapat organisasi.</li>
  <li>Bertanggung jawab atas tata naskah dinas yang dibutuhkan.</li>
  <li>Mengelola inventaris penunjang organisasi.</li>
</ol>

<b>Bendahara I</b>
<ol>
  <li>Mengelola keuangan organisasi.</li>
  <li>Membuat laporan keluar masuk keuangan HIMAPRODI Kebidanan.</li>
</ol>

<b>Bendahara II</b>
<ol>
  <li>Membantu pelaksanaan tugas Bendahara I.</li>
</ol>

<b>Divisi Humas</b>
<ol>
  <li>Bertanggung jawab kepada Ketua HIMAPRODI Kebidanan.</li>
  <li>Menjembatani kerja sama antara pengurus, anggota, lembaga, dan organisasi lain baik di dalam maupun luar kampus.</li>
  <li>Membuat publikasi dan dokumentasi kegiatan.</li>
</ol>

<b>Divisi Sosial</b>
<ol>
  <li>Bertanggung jawab kepada Ketua HIMAPRODI Kebidanan.</li>
  <li>Menjalin hubungan baik dengan masyarakat dan meningkatkan peran aktif mahasiswa dalam pengabdian masyarakat.</li>
  <li>Membukukan segala pengeluaran dan mencatat pemasukan dana.</li>
</ol>

<b>Divisi Kewirausahaan</b>
<ol>
  <li>Bertanggung jawab kepada Ketua HIMAPRODI Kebidanan.</li>
  <li>Mengelola sumber pemasukan dan keuangan organisasi untuk kemandirian dan kesejahteraan HIMAPRODI Kebidanan.</li>
  <li>Mengembangkan kreativitas dalam bidang kewirausahaan.</li>
  <li>Menjalankan tugas sesuai AD/ART HIMAPRODI Kebidanan.</li>
</ol>

<b>Divisi Komunikasi dan Informasi</b>
<ol>
  <li>Bertanggung jawab kepada Ketua HIMAPRODI Kebidanan.</li>
  <li>Melaksanakan mekanisme dan pengawasan penyaluran informasi organisasi.</li>
  <li>Ikut serta dalam menyukseskan penerimaan mahasiswa baru.</li>
  <li>Menyampaikan informasi kepada mahasiswa melalui media sosial atau secara langsung.</li>
</ol>

<b>Divisi Minat dan Bakat</b>
<ol>
  <li>Bertanggung jawab kepada Ketua HIMAPRODI Kebidanan.</li>
  <li>Mengembangkan dan menyalurkan minat serta bakat mahasiswa di bidang akademik dan non-akademik.</li>
  <li>Menjalankan tugas sesuai AD/ART HIMAPRODI Kebidanan.</li>
</ol>
`
,

// komputer
komputer_tugas: `
<b>Tugas Pokok Struktural HIMAPRODI Komputer KM PHB</b><br><br>

<b>Ketua</b>
<ol>
  <li>Menjalankan atau memimpin rapat organisasi.</li>
  <li>Memimpin dan mengoordinasikan kegiatan HIMAPRODI Komputer KM PHB.</li>
  <li>Berkoordinasi dengan Bidang Kemahasiswaan Program Studi DIII Teknik Komputer.</li>
  <li>Memberikan laporan pertanggungjawaban di akhir periode.</li>
  <li>Mengangkat dan memberhentikan anggota HIMAPRODI Komputer KM PHB.</li>
  <li>Menjalankan tugas menurut AD/ART HIMAPRODI Komputer KM PHB.</li>
</ol>

<b>Wakil Ketua</b>
<ol>
  <li>Membantu Ketua HIMAPRODI Komputer dalam menjalankan tugasnya.</li>
  <li>Menjalankan tugas-tugas Ketua apabila tidak hadir atau berhalangan.</li>
  <li>Menjalankan tugas menurut AD/ART HIMAPRODI Komputer KM PHB.</li>
</ol>

<b>Sekretaris</b>
<ol>
  <li>Menciptakan sistem administrasi kesekretariatan yang baik dan sesuai prosedur.</li>
  <li>Melakukan pengarsipan dan mengelola dokumen HIMAPRODI Komputer KM PHB.</li>
  <li>Mendokumentasikan hasil rapat organisasi.</li>
  <li>Membuat dokumen-dokumen kesekretariatan.</li>
</ol>

<b>Bendahara</b>
<ol>
  <li>Mengelola keuangan HIMAPRODI Komputer KM PHB secara penuh.</li>
  <li>Mengatur dan mengawasi arus kas masuk dan keluar organisasi.</li>
  <li>Merumuskan dan menetapkan kebijakan dalam bidang keuangan.</li>
  <li>Bertanggung jawab terhadap fondasi ekonomi organisasi.</li>
</ol>

<b>Divisi Akademik</b>
<ol>
  <li>Bertanggung jawab atas peningkatan kompetensi akademik mahasiswa.</li>
  <li>Mengembangkan sistem pelatihan oleh HIMAPRODI Komputer.</li>
  <li>Menjalin hubungan baik dengan Bagian Akademik dan Wakil Direktur I.</li>
</ol>

<b>Divisi Kerumahtanggaan</b>
<ol>
  <li>Mengelola dan bertanggung jawab atas kebutuhan logistik organisasi.</li>
  <li>Menjalin hubungan kekeluargaan dengan anggota aktif, biasa, dan demisioner.</li>
  <li>Melaksanakan mekanisme serta pengawasan internal organisasi.</li>
</ol>

<b>Divisi Humas</b>
<ol>
  <li>Menjalin hubungan baik dengan mahasiswa, dosen, dan pihak terkait lainnya.</li>
  <li>Menampung serta menindaklanjuti aspirasi mahasiswa Teknik Komputer.</li>
  <li>Membantu pelaksanaan program kerja dan mengoordinasikan antar kelas.</li>
</ol>

<b>Divisi Jurnalistik</b>
<ol>
  <li>Mengelola konten media sosial HIMAPRODI Komputer KM PHB.</li>
  <li>Menyampaikan informasi kegiatan organisasi secara langsung atau daring.</li>
  <li>Melaksanakan mekanisme dan pengawasan penyaluran informasi organisasi.</li>
</ol>
`
,

mesin_tugas: `
<b>Tugas Pokok Struktural HIMAPRODI Teknik Mesin KM PHB</b><br><br>

<b>Ketua</b>
<ol>
  <li>Mewakili nama HIMAPRODI Teknik Mesin Politeknik Harapan Bersama Tegal dalam setiap kegiatan keorganisasian.</li>
  <li>Menentukan kebijakan organisasi dengan tepat berdasarkan AD/ART HIMAPRODI Teknik Mesin.</li>
  <li>Mengangkat dan memberhentikan Pengurus HIMAPRODI Teknik Mesin.</li>
  <li>Memimpin dan mengkoordinasikan kegiatan HIMAPRODI Teknik Mesin.</li>
</ol>

<b>Wakil Ketua</b>
<ol>
  <li>Membantu ketua dalam menjalankan tugasnya.</li>
  <li>Menjalankan tugas-tugas ketua bila ketua tidak hadir atau berhalangan.</li>
  <li>Menandatangani surat-surat internal dan eksternal bila ketua berhalangan, dengan seizin ketua.</li>
  <li>Ikut aktif dalam kegiatan HIMAPRODI Teknik Mesin.</li>
  <li>Menjalankan tugas sesuai AD/ART HIMAPRODI Teknik Mesin.</li>
</ol>

<b>Sekretaris</b>
<ol>
  <li>Membantu ketua dalam menertibkan administrasi organisasi.</li>
  <li>Mempertanggungjawabkan segala kegiatan kepada ketua.</li>
  <li>Mengatur, menertibkan, dan merawat inventaris dan aset organisasi.</li>
  <li>Melaksanakan pengumpulan, pencatatan, pengelolaan, penyusunan, dan pemeliharaan dokumen, laporan, serta data internal dan eksternal organisasi.</li>
</ol>

<b>Bendahara</b>
<ol>
  <li>Meminta pertanggungjawaban keuangan dari panitia kegiatan organisasi.</li>
  <li>Menandatangani surat yang berkaitan dengan kebendaharaan organisasi.</li>
  <li>Mengatur dan mendata pemasukan serta pengeluaran organisasi.</li>
  <li>Ikut aktif dalam kegiatan HIMAPRODI Teknik Mesin.</li>
</ol>

<b>Divisi Minat dan Bakat</b>
<ol>
  <li>Bertanggung jawab dalam mencari dan menyalurkan bakat mahasiswa Teknik Mesin.</li>
</ol>

<b>Divisi Kewirausahaan</b>
<ol>
  <li>Bertanggung jawab membangun dan mengembangkan sarana kewirausahaan baik yang sudah maupun yang akan diadakan dalam program kerja HIMAPRODI Teknik Mesin.</li>
</ol>

<b>Divisi Media Komunikasi dan Informasi</b>
<ol>
  <li>Bertanggung jawab dalam publikasi informasi dan dokumentasi kegiatan HIMAPRODI Teknik Mesin.</li>
</ol>

<b>Divisi Pengembangan Sumber Daya Manusia (PSDM)</b>
<ol>
  <li>Bertanggung jawab dalam pengembangan kemampuan mahasiswa di bidang akademik maupun non-akademik.</li>
</ol>

<b>Humas</b>
<ol>
  <li>Menyebarkan informasi secara cepat, tepat, dan akurat kepada pihak internal maupun eksternal.</li>
  <li>Menciptakan suasana harmonis dengan prodi, ormawa, dan perguruan tinggi lainnya.</li>
  <li>Menjadi mediator dan fasilitator bagi mahasiswa Teknik Mesin dalam urusan akademik dan organisasi.</li>
</ol>
`
,
hotel_tugas: `
<b>Tugas Pokok Struktural HIMAPRODI Perhotelan KM PHB</b><br><br>

<b>Ketua HIMAPRODI Perhotelan</b>
<ol>
  <li>Merencanakan, mengorganisir, dan mengkoordinasikan berbagai acara dan kegiatan himpunan, seperti seminar, workshop, atau kegiatan sosial.</li>
  <li>Memimpin rapat-rapat himpunan untuk membahas agenda, evaluasi kegiatan, dan perencanaan program ke depan.</li>
  <li>Menjaga dan memelihara tradisi serta identitas himpunan agar tetap konsisten dengan visi, misi, dan nilai-nilai himpunan.</li>
</ol>

<b>Sekretaris HIMAPRODI Perhotelan</b>
<ol>
  <li>Menangani surat-menyurat yang berkaitan dengan kegiatan himpunan, termasuk surat permohonan kerja sama, undangan, dan surat resmi lainnya.</li>
  <li>Menyusun laporan berkala tentang kegiatan.</li>
  <li>Merapikan dan menyimpan arsip kegiatan himpunan agar mudah diakses di masa mendatang.</li>
</ol>

<b>Bendahara HIMAPRODI Perhotelan</b>
<ol>
  <li>Mengelola dan mencatat semua transaksi keuangan HIMAPRODI Perhotelan KM PHB.</li>
  <li>Menyusun dan mengelola anggaran HIMAPRODI Perhotelan KM PHB.</li>
  <li>Mengajukan proposal pendanaan dan mencari sumber pendanaan tambahan jika diperlukan.</li>
  <li>Memastikan semua kegiatan keuangan dilakukan dengan akuntabilitas dan transparansi.</li>
</ol>

<b>Divisi Humas Internal & Eksternal</b>
<ol>
  <li>Membina hubungan baik antara anggota HIMAPRODI Perhotelan KM PHB.</li>
  <li>Berkoordinasi dengan divisi lain untuk keberlanjutan kegiatan dan program.</li>
  <li>Bekerja sama dengan bidang kemahasiswaan Program Studi Perhotelan dalam hal-hal yang berkaitan dengan mahasiswa.</li>
  <li>Memastikan anggota mematuhi etika dan norma yang berlaku.</li>
</ol>

<b>Divisi Pengabdian Masyarakat</b>
<ol>
  <li>Menyelenggarakan atau mengikuti kegiatan sosial seperti bakti sosial, pelatihan keterampilan, atau workshop yang bermanfaat bagi masyarakat.</li>
  <li>Menyebarkan informasi terkait program pengabdian masyarakat kepada mahasiswa Program Studi Perhotelan.</li>
</ol>

<b>Divisi Enterpreneur / Kewirausahaan</b>
<ol>
  <li>Menyusun rencana bisnis untuk kegiatan atau proyek kewirausahaan anggota.</li>
  <li>Melakukan riset pasar untuk memahami tren industri perhotelan dan potensi peluang bisnis.</li>
  <li>Mengelola anggaran keuangan untuk kegiatan kewirausahaan.</li>
</ol>

<b>Divisi Kominfo (Komunikasi dan Informasi)</b>
<ol>
  <li>Mengelola akun media sosial himpunan untuk mempromosikan kegiatan dan informasi terkini.</li>
  <li>Memastikan konten yang dibagikan relevan dan menarik bagi anggota serta masyarakat umum.</li>
  <li>Merancang dan membuat materi promosi seperti poster, brosur, dan flyer.</li>
  <li>Menyusun teks dan konten untuk promosi online dan offline.</li>
</ol>

<b>Divisi Prestasi dan Akademik</b>
<ol>
  <li>Mengorganisir kompetisi atau event akademik untuk meningkatkan keterampilan dan pengetahuan mahasiswa di bidang perhotelan.</li>
  <li>Mencari informasi dan menyebarluaskan info perlombaan atau event terkait bidang akademik Program Studi Perhotelan.</li>
</ol>
`
,

ti_tugas: `
<b>Tugas Pokok Struktural HIMAPRODI Teknik Informatika KM PHB</b><br><br>

<b>Ketua HIMAPRODI TI</b>
<ol>
  <li>Menjalankan atau memimpin rapat organisasi.</li>
  <li>Memimpin dan mengkoordinasikan kegiatan HIMAPRODI TI KM PHB.</li>
  <li>Memberikan laporan pertanggungjawaban di akhir periode.</li>
  <li>Menjalankan tugas menurut AD/ART HIMAPRODI TI KM PHB.</li>
</ol>

<b>Wakil Ketua HIMAPRODI TI</b>
<ol>
  <li>Membantu Ketua dalam menjalankan tugasnya.</li>
  <li>Menjalankan tugas-tugas Ketua apabila Ketua tidak hadir atau berhalangan.</li>
  <li>Menjalankan tugas menurut AD/ART HIMAPRODI TI KM PHB.</li>
</ol>

<b>Sekretaris</b>
<ol>
  <li>Menciptakan sistem administrasi kesekretariatan yang profesional.</li>
  <li>Melakukan pengarsipan dan perapihan dokumen HIMAPRODI TI KM PHB.</li>
  <li>Mendokumentasikan hasil rapat.</li>
  <li>Pembuatan dokumen-dokumen kesekretariatan.</li>
  <li>Bertanggung jawab terhadap tata naskah dinas yang dibutuhkan.</li>
  <li>Mengelola inventaris penunjang organisasi.</li>
</ol>

<b>Bendahara</b>
<ol>
  <li>Pengelolaan keuangan HIMAPRODI TI KM PHB menjadi tanggung jawab utama.</li>
  <li>Mengatur keuangan dan mengawasi arus kas masuk dan kas keluar HIMAPRODI TI KM PHB.</li>
  <li>Merumuskan dan menetapkan kebijakan di bidang keuangan.</li>
</ol>

<b>Divisi Humas Internal</b>
<ol>
  <li>Membantu Ketua dalam melaksanakan program kerja HIMAPRODI TI KM PHB.</li>
  <li>Melaksanakan mekanisme serta pengawasan penyaluran informasi HIMAPRODI TI KM PHB.</li>
  <li>Menjalin hubungan baik dengan pihak-pihak terkait dalam lingkup internal institusi.</li>
</ol>

<b>Divisi Humas Eksternal</b>
<ol>
  <li>Membantu Ketua dalam melaksanakan program kerja HIMAPRODI TI KM PHB.</li>
  <li>Melaksanakan mekanisme serta pengawasan penyaluran informasi HIMAPRODI TI KM PHB.</li>
  <li>Terlibat dalam kegiatan dan acara eksternal, seperti festival, pameran, atau kegiatan sosial.</li>
</ol>

<b>Divisi Akademik</b>
<ol>
  <li>Membantu Ketua dalam melaksanakan program kerja HIMAPRODI TI KM PHB.</li>
  <li>Membantu menjalankan program kerja di bidang akademik.</li>
  <li>Menjadi sarana peningkatan mutu akademik mahasiswa.</li>
</ol>

<b>Divisi Kominfo (Komunikasi dan Informasi)</b>
<ol>
  <li>Membantu Ketua dalam melaksanakan program kerja HIMAPRODI TI KM PHB.</li>
  <li>Mengelola informasi internal dan eksternal secara profesional, baik melalui media sosial maupun media elektronik.</li>
  <li>Mengembangkan sistem informasi yang tepat guna dan bermanfaat.</li>
</ol>

<b>Divisi Sosial</b>
<ol>
  <li>Membantu Ketua dalam melaksanakan program kerja HIMAPRODI TI KM PHB.</li>
  <li>Mengelola Dana Sosial.</li>
  <li>Menjalankan tugas menurut AD/ART HIMAPRODI TI KM PHB.</li>
</ol>

<b>Divisi Kekeluargaan</b>
<ol>
  <li>Membantu Ketua dalam melaksanakan program kerja HIMAPRODI TI KM PHB.</li>
  <li>Mengakrabkan seluruh anggota HIMAPRODI TI KM PHB baik anggota aktif maupun pasif.</li>
  <li>Menampung aspirasi demi kesejahteraan mahasiswa Program Studi Sarjana Terapan Teknik Informatika PHB.</li>
  <li>Menjalankan tugas menurut AD/ART HIMAPRODI TI KM PHB.</li>
</ol>
`

,
// tugas
akuntansi_struktur : `
<b>Struktur HIMAPRODI Akuntansi</b>
<ol>
    <li>Ketua</li>
    <li>Wakil Ketua</li>
    <li>Wakil Ketua</li>
    <li>Sekretaris I</li>
    <li>Sekretaris II</li>
    <li>Bendahara I</li>
    <li>Bendahara II</li>
    <li>Koordinator Department RnD</li>
    <li>Anggota Department RnD</li>
    <li>Koordinator Department HRD</li>
    <li>Anggota Department HRD</li>
    <li>Koordinator Department Enterpreneur</li>
    <li>Koordinator Department Enterpreneur</li>
    <li>Anggota Department Enterpreneur</li>
    <li>Koordinator Department PR</li>
    <li>Anggota Department PR</li>
</ol>
`,

asp_struktur : `
<b>Struktur HIMAPRODI ASP</b>
<ol>
    <li>Ketua</li>
    <li>Wakil Ketua</li>
    <li>Sekretaris</li>
    <li>Bendahara</li>
    <li>Ketua Divisi RnD</li>
    <li>Anggota Divisi RnD</li>
    <li>Ketua Divisi JIK</li>
    <li>Anggota Divisi JIK</li>
    <li>Ketua Divisi DP2M</li>
</ol>
`,

dkv_struktur : `
<b>Struktur HIMAPRODI DKV</b>
<ol>
    <li>Ketua</li>
    <li>Wakil Ketua</li>
    <li>Sekretaris</li>
    <li>Bendahara</li>
    <li>Departemen Pengembangan Keterampilan Mahasiswa</li>
    <li>Departemen Humas</li>
    <li>Departemen Komunikasi dan Informasi</li>
    <li>Departemen Konten Kreatif</li>
</ol>
`
,

elektro_struktur : `
<b>Struktur HIMAPRODI Elektro</b>
<ol>
    <li>Ketua</li>
    <li>Wakil Ketua</li>
    <li>Sekretaris</li>
    <li>Bendahara</li>
    <li>Divisi Pengembangan Minat Bakat</li>
    <li>Divisi Sosial</li>
    <li>Divisi Kewirausahaan</li>
    <li>Divisi Publikasi</li>
    <li>Divisi Humas</li>
</ol>
`
,

farmasi_struktur : `
<b>Struktur HIMAPRODI Farmasi</b>
<ol>
    <li>Ketua</li>
    <li>Wakil Ketua</li>
    <li>Sekretaris</li>
    <li>Bendahara</li>
    <li>Divisi Humas</li>
    <li>Divisi Kominfo</li>
    <li>Divisi Kekeluargaan</li>
    <li>Divisi Minat Bakat</li>
</ol>
`,

kebidanan_struktur : `
<b>Struktur HIMAPRODI Kebidanan</b>
<ol>
    <li>Ketua</li>
    <li>Wakil Ketua</li>
    <li>Sekretaris I</li>
    <li>Sekretaris II</li>
    <li>Sekretaris III</li>
    <li>Bendahara I</li>
    <li>Bendahara II</li>
    <li>Divisi Humas</li>
    <li>Divisi Sosial</li>
    <li>Divisi Kewirausahaan</li>
    <li>Divisi Komunikasi dan Informasi</li>
    <li>Divisi Minat & Bakat</li>
</ol>
`,

komputer_struktur : `
<b>Struktur HIMAPRODI Komputer</b>
<ol>
    <li>Ketua</li>
    <li>Wakil Ketua</li>
    <li>Sekretaris</li>
    <li>Bendahara</li>
    <li>Divisi Akademik</li>
    <li>Divisi Kerumahtanggaan</li>
    <li>Divisi Humas</li>
    <li>Divisi Jurnalistik</li>
</ol>
`,

mesin_struktur : `
<b>Struktur HIMAPRODI Mesin</b>
<ol>
    <li>Ketua Himpunan</li>
    <li>Wakil Ketua Himpunan</li>
    <li>Sekretaris</li>
    <li>Bendahara</li>
    <li>Departemen</li>
    <li>BPHM</li>
    <li>Divisi Minat Bakat</li>
    <li>Divisi Kewirausahaan</li>
    <li>Divisi Media Komunikasi dan Informasi</li>
    <li>Divisi Pengembangan Sumber Daya Manusia</li>
    <li>Humas</li>
</ol>
`,
perhotelan_struktur : `
<b>Struktur HIMAPRODI Perhotelan</b>
<ol>
    <li>Ketua</li>
    <li>Wakil Ketua</li>
    <li>Sekretaris</li>
    <li>Bendahara</li>
    <li>Divisi Humas Internal & Eksternal</li>
    <li>Divisi Pengabdian Masyarakat</li>
    <li>Divisi Enterpreneur</li>
    <li>Divisi Kominfo</li>
    <li>Divisi Prestasi dan Akademik</li>
</ol>
`,
ti_struktur : `
<b>Struktur HIMAPRODI Teknik Informatika</b>
<ol>
    <li>Ketua</li>
    <li>Wakil Ketua</li>
    <li>Sekretaris</li>
    <li>Bendahara</li>
    <li>Divisi Humas Internal</li>
    <li>Divisi Humas Eksternal</li>
    <li>Divisi Akademik</li>
    <li>Divisi Kominfo</li>
    <li>Divisi Sosial</li>
    <li>Divisi Kekeluargaan</li>
</ol>
`,
perhotelan_visi: `Menjadikan Himpunan Mahasiswa Perhotelan sebagai wadah yang inspiratif, inovatif, dan profesional untuk mengembangkan kompetensi, kreativitas, serta jiwa kepemimpinan mahasiswa perhotelan, sehingga mampu bersaing di dunia industri perhotelan global`,
perhotelan_misi: `<ol>
  <li><strong>1. Pengembangan Kompetensi:</strong> Menyelenggarakan program pelatihan dan workshop yang relevan dengan tren terkini di industri perhotelan.</li>
  <li><strong>2. Peningkatan Keaktifan dan Kolaborasi:</strong> Membentuk lingkungan himpunan yang inklusif dan kolaboratif melalui kegiatan yang mempererat hubungan antar anggota serta membangun kerja sama dengan organisasi lain di dalam maupun luar kampus.</li>
  <li><strong>3. Inovasi dan Kreativitas:</strong> Mendorong mahasiswa untuk berinovasi dengan mengadakan kompetisi, pameran, dan proyek kreatif yang mendukung potensi di bidang perhotelan.</li>
</ol>

`,
ti_visi: `Menjadikan Himpunan Mahasiswa Teknik Informatika yang Unggul, Aktif, Inovatif, dan Inspiratif dalam mendorong Pengembangan Sumber Daya Mahasiswa.`,
ti_misi: `<ol>
  <li><strong>1.</strong> Menyediakan wadah untuk menggali potensi inovasi dan kreativitas mahasiswa.</li>
  <li><strong>2.</strong> Mendorong pemberdayaan mahasiswa dalam pengembangan soft skill.</li>
  <li><strong>3.</strong> Memperkuat rasa kebersamaan dan kekeluargaan antar mahasiswa.</li>
</ol>
`,
mesin_visi: `Menjadikan Himpunan Mahasiswa Teknik Mesin yang ungggul, kreatif, dan berdaya saing, serta mampu mencetak pemimpin masa depan yang profesional, inovatif, dan berdedikasi dalam bidang teknik mesin.`, 
mesin_misi: `<ol>
  <li><strong>1. Meningkatkan Kualitas Akademik:</strong> Menyediakan berbagai program yang mendukung peningkatan kompetensi akademik anggota, seperti seminar, workshop, dan pelatihan di bidang teknik mesin.</li>
  
  <li><strong>2. Mendorong Pengembangan SoftSkills:</strong> Mengadakan kegiatan yang mengasah kemampuan kepemimpinan, komunikasi, serta kerja sama tim melalui berbagai event, seperti pelatihan kepemimpinan, organisasi, dan proyek bersama.</li>
  
  <li><strong>3. Memfasilitasi Kolaborasi dengan Dunia Industri:</strong> Menjalin hubungan yang erat dengan dunia industri dan akademik untuk membuka peluang magang, studi banding, dan kunjungan industri bagi anggota.</li>
  
  <li><strong>4. Membangun Soliditas dan Kebersamaan:</strong> Menciptakan lingkungan yang inklusif dan mendukung antar anggota HMTM melalui kegiatan sosial, olahraga, dan acara budaya.</li>
  
  <li><strong>5. Meningkatkan Peran serta HMTM dalam Masyarakat:</strong> Meningkatkan kontribusi sosial mahasiswa teknik mesin melalui program-program pengabdian kepada masyarakat yang berbasis pada keahlian teknik mesin.</li>
</ol>
`,
akuntansi_visi: `Menjadikan mahasiswa DIII Akuntansi sebagai himpunan yang unggul, kompeten, kreatif, komunikatif, solid, profesional dan berintegrasi dalam pengembangan akademik, minat bakat, dan ketrampilan sosial mahasiswa prodi akuntansi.`,
akuntansi_misi: `<ol>
  <li><strong>1. Menjadikan HimaProdi Akuntansi:</strong> Sebagai wadah yang berkualitas bagi anggotanya untuk meningkatkan dan mengasah kemampuan bekerja dalam tim maupun individu.</li>
  
  <li><strong>2. Memperkuat Rasa Empati & Solidaritas:</strong> Melalui berbagai kegiatan sosial yang melibatkan partisipasi aktif anggota.</li>
  
  <li><strong>3. Menciptakan Sistem Kerja yang Efektif:</strong> Mengembangkan sistem kerja anggota HimaProdi Akuntansi yang efisien dan produktif.</li>
  
  <li><strong>4. Membangun Kekeluargaan dan Relasi:</strong> Menjaga komunikasi serta hubungan yang kuat dan saling mendukung antar mahasiswa, baik dalam prodi DIII Akuntansi maupun antar prodi lainnya.</li>
</ol>
`,
asp_visi: `Menjadikan Himpunan Mahasiswa Akuntansi Sector Public organisasi yang kreatif, kompeten, solidaritas, serta berkontribusi aktif dalam program kerja himpunan`,
asp_misi: `<ol>
  <li><strong>1. Meningkatkan Kompetensi Pengurus:</strong> Menjadikan HimaProdi ASP sebagai sarana untuk meningkatkan kompetensi para pengurus.</li>
  
  <li><strong>2. Mendorong Kolaborasi dan Inovasi:</strong> Menjalankan HimaProdi ASP dengan kerja sama antar pengurus untuk menciptakan inovasi.</li>
  
  <li><strong>3. Menyediakan Wadah Aspirasi:</strong> Membuka ruang bagi pengurus HimaProdi ASP maupun mahasiswa Prodi ASP untuk menyuarakan pendapat.</li>
  
  <li><strong>4. Membangun Solidaritas dan Kekeluargaan:</strong> Menciptakan ruang lingkup organisasi yang memiliki jiwa solidaritas dan kekeluargaan.</li>
  
  <li><strong>5. Membentuk Karakter Mahasiswa:</strong> Membangun karakter mahasiswa yang berintegritas, bertanggung jawab, dan memiliki jiwa sosial.</li>
</ol>
`,
elektro_visi: `Menjadikan Himpunan Mahasiswa Teknik Elektronika Politeknik Harapan Bersama sebagai wadah yang inovatif, kolaboratif, dan inspiratif dalam mengembangkan potensi akademik, keterampilan, serta karakter mahasiswa, guna menciptakan komunitas yang unggul dan berkontribusi aktif.`,
elektro_misi: `<ol>
  <li><strong>1. Pengembangan Program Akademik dan Praktis:</strong> Mengembangkan program kerja yang mendukung peningkatan kemampuan akademik dan keterampilan praktis mahasiswa D3 Teknik Elektronika.</li>
  
  <li><strong>2. Membangun Kolaborasi yang Harmonis:</strong> Membangun kolaborasi yang harmonis antara mahasiswa, dosen, dan pihak eksternal untuk menciptakan ekosistem pembelajaran yang kondusif.</li>
  
  <li><strong>3. Pengembangan Soft Skills:</strong> Mendorong kegiatan yang berfokus pada pengembangan soft skills, seperti kepemimpinan, komunikasi, dan kerjasama tim, guna membentuk mahasiswa yang siap menghadapi tantangan dunia industri.</li>
  
  <li><strong>4. Seminar dan Pelatihan Inovatif:</strong> Mengadakan seminar, workshop, dan pelatihan yang mendukung inovasi dan motivasi di bidang teknik elektronika.</li>
  
  <li><strong>5. Mempererat Solidaritas Anggota:</strong> Mempererat solidaritas antar anggota himpunan dengan mengadakan kegiatan sosial dan keakraban yang bermanfaat.</li>
</ol>
`,
kebidanan_visi: `Mewujudkan HimaProdi kebidanan yang inovatif, berdaya saing, dan berorentasi pada pelayanan masyarakat, serta menjadi wadah pengembangan potensi mahasiswa untuk menjadi bidan profesional yang unggul.`,
kebidanan_misi: `<ol>
  <li><strong>1. Peningkatan Kualitas SDM Mahasiswa Kebidanan:</strong> Meningkatkan kualitas sumber daya manusia mahasiswa kebidanan melalui berbagai program pengembangan diri.</li>
  
  <li><strong>2. Membangun Jaringan Kerjasama:</strong> Membangun jaringan kerjasama dengan berbagai pihak untuk mendukung pengembangan profesi kebidanan.</li>
  
  <li><strong>3. Pengabdian Masyarakat Berkelanjutan:</strong> Melaksanakan pengabdian masyarakat yang berkelanjutan untuk meningkatkan derajat kesehatan masyarakat, terutama ibu dan anak.</li>
  
  <li><strong>4. Memperkuat Solidaritas dan Kekompakan:</strong> Memperkuat solidaritas dan kekompakan antar anggota himpunan.</li>
</ol>
`,
farmasi_visi: `Mewujudkan HimaProdi Farmasi menjadi organisasi yang inovatif, profesional, dan berdedikasi dalam mengembangkan potensi mahasiswa D3 Farmasi, serta berkontribusi dalam menciptakan lingkungan akademik yang kondusif dan mendukung pengembangan keahlian di bidang farmasi baik internal maupun eksternal.`,
farmasi_misi: `<ol>
  <li><strong>1. Meningkatkan Kualitas Akademik Mahasiswa DIII Farmasi.</strong></li>
  <li><strong>2. Meningkatkan Kepedulian Sosial dalam Diri Mahasiswa.</strong></li>
  <li><strong>3. Membangun Kemandirian dan Kepemimpinan Mahasiswa DIII Farmasi.</strong></li>
</ol>
`,
komputer_visi: `Menjadikan HMP Komputer sebagai wadah aspirasi mahasiswa yang inovatif, kreatif, dan kompetensi demi terciptanya organisasi yang berkualitas dan berkarakter.`,
komputer_misi: `<ol>
  <li>Meningkatkan kedisiplinan dan tanggung jawab dikalangan HimaProdi Komputer.</li>
  <li>Meningkatkan rasa kekeluargaan dalam setiap kegiatan dikalangan Hima.</li>
  <li>Meningkatkan semua program kerja guna meningkatkan prestasi seluruh anggota.</li>
</ol>
`,
dkv_visi: `Menjadikan HIMA DKV sebagai wadah yang kreatif dan inovatif, untuk mendukung pengembangan potensi mahasiswa serta memperkuat peran HIMA sebagai organisasi yang bermanfaat di kampus dan masyarakat.`,
dkv_misi: `<ol>
  <li>Membangun hubungan baik antara dosen dan mahasiswa prodi DKV untuk menciptakan suasana akademik harmonis.</li>
  <li>Mengadakan workshop dan program keterampilan untuk mendukung kreativitas mahasiswa.</li>
  <li>Menyediakan ruang terbuka untuk menyalurkan ide dan aspirasi mahasiswa DKV.</li>
</ol>
`,


        };

        function scrollBottom() {
            chatbox.scrollTop = chatbox.scrollHeight;
        }

        function addMessage(msg, type) {
            const div = document.createElement('div');
            div.className = `d-flex mb-3 ${type === 'user' ? 'justify-content-end' : 'justify-content-start'}`;
            const avatarSrc = type === 'user' ?
                'https://cdn-icons-png.flaticon.com/512/1077/1077012.png' :
                'https://cdn-icons-png.flaticon.com/512/4712/4712109.png';

            div.innerHTML = `
            ${type === 'bot' ? `<img src="${avatarSrc}" class="chat-avatar me-2">` : ''}
            <div class="${type === 'user' ? 'user-msg' : 'bot-msg'}">${msg}</div>
            ${type === 'user' ? `<img src="${avatarSrc}" class="chat-avatar ms-2">` : ''}
        `;
            chatbox.appendChild(div);
            scrollBottom();
        }

        // Fungsi untuk menampilkan pesan bot dengan delay dan animasi typing
        function botReplyWithTyping(html, delay = 1500) {
            return new Promise((resolve) => {
                const loadingDiv = document.createElement('div');
                loadingDiv.className = 'd-flex mb-3 justify-content-start';
                loadingDiv.id = 'typing-msg';
                loadingDiv.innerHTML = `
                <img src="https://cdn-icons-png.flaticon.com/512/4712/4712109.png" class="chat-avatar me-2">
                <div class="typing-indicator"><span></span><span></span><span></span></div>
            `;
                chatbox.appendChild(loadingDiv);
                scrollBottom();

                setTimeout(() => {
                    loadingDiv.remove();
                    addMessage(html, 'bot');
                    resolve();
                }, delay);
            });
        }

        async function showMainMenu() {
            const html = `
        Silakan pilih topik:
        <div class="quick-options mt-2">
            ${Object.keys(menuGroups).map(menu =>
                `<button class="btn btn-outline-secondary btn-sm menu-btn" data-menu="${menu}">${menu}</button>`
            ).join('')}
        </div>`;
            await botReplyWithTyping(html);
        }

        async function showSubMenu(menu) {
            const subItems = menuGroups[menu];
            let html =
                `Topik: <strong>${menu}</strong><br>Pilih pertanyaan:<div class="quick-options mt-2">`;

            if (Array.isArray(subItems)) {
                // Jika subItems array langsung, tampilkan tombol submenu
                html += subItems.map(item =>
                    `<button class="btn btn-outline-primary btn-sm submenu-btn" data-key="${item.key}">${item.label}</button>`
                ).join('');
            } else if (typeof subItems === 'object') {
                // Jika subItems objek (seperti List Organisasi), tampilkan tombol level 2
                Object.keys(subItems).forEach(sub =>
                    html +=
                    `<button class="btn btn-outline-success btn-sm submenu-lv2-btn" data-org="${menu}" data-sub="${sub}">${sub}</button>`
                );
            }

            html += `<button class="btn btn-outline-danger btn-sm back-btn">⬅ Kembali</button></div>`;
            await botReplyWithTyping(html);
        }


        async function respondToKeyword(key) {
            const msg = responses[key] || "Maaf, belum ada jawaban untuk topik ini.";
            await botReplyWithTyping(msg);
            // activeMenu = null;
            // setTimeout(showMainMenu, 800);
              // setelah kasih jawaban, tampilkan kembali submenu aktif
            // Saat user pilih menu "List Organisasi"
if (activeMenu === "List Organisasi") {
    const orgName = userMessage.toUpperCase();

    if (menuGroups["List Organisasi"][orgName]) {
        // Ubah activeMenu jadi object agar tahu posisi
        activeMenu = {
            menu: "List Organisasi",
            sub: orgName
        };

        // Ambil submenu detail (Visi, Misi, dll)
        const subItems = menuGroups["List Organisasi"][orgName];

        const html = `
            <strong>${orgName}</strong><br>Pilih detail:
            <div class="quick-options mt-2">
                ${subItems.map(item =>
                    `<button class="btn btn-outline-primary btn-sm submenu-btn" data-key="${item.key}">${item.label}</button>`
                ).join('')}
                <button class="btn btn-outline-danger btn-sm back-btn">⬅ Kembali</button>
            </div>
        `;

        await botReplyWithTyping(html);
        return; // stop lanjut
    }
}

// Menangani submenu (Visi, Misi, dll)
if (typeof activeMenu === 'object') {
    await showSubMenu(activeMenu.menu, activeMenu.sub);
    console.log('submenu organisasi aktif');
} else {
    await showSubMenu(activeMenu);
    console.log('menu biasa aktif');
}

        }

        async function handleUserInput(message) {
            const userMessage = message.trim();
            if (!userMessage) return;
            addMessage(userMessage, 'user');

            const lower = userMessage.toLowerCase();

            // Pemetaan langsung untuk keyword seperti "bem visi"
            const directKeywordMap = {
    // BEM & BPM
    'bem visi': 'bem_visi',
    'bem misi': 'bem_misi',
    'bem struktur': 'bem_struktur',
    'bem kegiatan': 'bem_kegiatan',
    'bem tugas': 'bem_tugas',
    'bpm visi': 'bpm_visi',
    'bpm misi': 'bpm_misi',
    'bpm struktur': 'bpm_struktur',
    'bpm tugas': 'bpm_tugas',

    // AKUNTANSI
    'akuntansi visi': 'akuntansi_visi',
    'akuntansi misi': 'akuntansi_misi',
    'akuntansi struktur': 'akuntansi_struktur',
    'akuntansi tugas': 'akuntansi_tugas',

    // ASP
    'asp visi': 'asp_visi',
    'asp misi': 'asp_misi',
    'asp struktur': 'asp_struktur',
    'asp tugas': 'asp_tugas',

    // DKV
    'dkv visi': 'dkv_visi',
    'dkv misi': 'dkv_misi',
    'dkv struktur': 'dkv_struktur',
    'dkv tugas': 'dkv_tugas',

    // ELEKTRO
    'elektro visi': 'elektro_visi',
    'elektro misi': 'elektro_misi',
    'elektro struktur': 'elektro_struktur',
    'elektro tugas': 'elektro_tugas',

    // FARMASI
    'farmasi visi': 'farmasi_visi',
    'farmasi misi': 'farmasi_misi',
    'farmasi struktur': 'farmasi_struktur',
    'farmasi tugas': 'farmasi_tugas',

    // KEBIDANAN
    'kebidanan visi': 'kebidanan_visi',
    'kebidanan misi': 'kebidanan_misi',
    'kebidanan struktur': 'kebidanan_struktur',
    'kebidanan tugas': 'kebidanan_tugas',

    // KOMPUTER
    'komputer visi': 'komputer_visi',
    'komputer misi': 'komputer_misi',
    'komputer struktur': 'komputer_struktur',
    'komputer tugas': 'komputer_tugas',

    // MESIN
    'mesin visi': 'mesin_visi',
    'mesin misi': 'mesin_misi',
    'mesin struktur': 'mesin_struktur',
    'mesin tugas': 'mesin_tugas',

    // PERHOTELAN
    'perhotelan visi': 'perhotelan_visi',
    'perhotelan misi': 'perhotelan_misi',
    'perhotelan struktur': 'perhotelan_struktur',
    'perhotelan tugas': 'perhotelan_tugas',

    // TEKNIK INFORMATIKA (TI)
    'ti visi': 'ti_visi',
    'ti misi': 'ti_misi',
    'ti struktur': 'ti_struktur',
    'ti tugas': 'ti_tugas'
};


            if (directKeywordMap[lower]) {
                await respondToKeyword(directKeywordMap[lower]);
                return;
            }

            if (lower === 'kembali' || lower === 'back') {
                if (typeof activeMenu === 'object') {
                    await showSubMenu(activeMenu.menu);
                    activeMenu = activeMenu.menu;
                } else {
                    activeMenu = null;
                    await botReplyWithTyping("Kembali ke menu utama.");
                    await showMainMenu();
                }
                return;
            }

            // Cek apakah input cocok dengan menu utama
            if (!activeMenu) {
                const matchedMenu = Object.keys(menuGroups).find(menu =>
                    menu.toLowerCase() === lower
                );
                if (matchedMenu) {
                    activeMenu = matchedMenu;
                    await showSubMenu(activeMenu);
                } else {
                    await botReplyWithTyping("Silakan pilih salah satu topik utama terlebih dahulu.");
                    await showMainMenu();
                }
                return;
            }

            // Tangani submenu organisasi
            if (activeMenu === "List Organisasi") {
                const orgName = userMessage.toUpperCase();
                if (menuGroups["List Organisasi"][orgName]) {
                    activeMenu = {
                        menu: "List Organisasi",
                        sub: orgName
                    };
                    const subItems = menuGroups["List Organisasi"][orgName];
                    const html = `
            <strong>${orgName}</strong><br>Pilih detail:
            <div class="quick-options mt-2">
                ${subItems.map(item =>
                    `<button class="btn btn-outline-primary btn-sm submenu-btn" data-key="${item.key}">${item.label}</button>`
                ).join('')}
                <button class="btn btn-outline-danger btn-sm back-btn">⬅ Kembali</button>
            </div>`;
                    await botReplyWithTyping(html);
                    // console.log(html);
                    return;
                }
                    activeMenu = "List Organisasi"
            }

            // Ambil subitem berdasarkan konteks aktif
            let subItems;
            if (typeof activeMenu === 'string') {
                subItems = menuGroups[activeMenu];
                if (!Array.isArray(subItems)) {
                    await botReplyWithTyping("Silakan pilih submenu terlebih dahulu.");
                    return;
                }
            } else if (typeof activeMenu === 'object') {
                subItems = menuGroups[activeMenu.menu][activeMenu.sub];
                if (!Array.isArray(subItems)) {
                    await botReplyWithTyping("Silakan pilih submenu yang valid.");
                    return;
                }
            }

            const matchedSub = subItems.find(item =>
                item.label.toLowerCase() === lower || item.key === lower
            );

            if (matchedSub) {
                await respondToKeyword(matchedSub.key);
            } else {
                await botReplyWithTyping("Subtopik tidak dikenali. Silakan pilih yang tersedia.");
                if (typeof activeMenu === 'object') {
                    await showSubMenu(activeMenu.menu);
                } else {
                    await showSubMenu(activeMenu);
                }
            }
        }



        sendBtn.addEventListener('click', () => {
            const message = input.value.trim();
            input.value = '';
            handleUserInput(message);
        });

        chatIcon.addEventListener('click', async () => {
            chatBox.classList.toggle('d-none');
            const icon = chatIcon.querySelector('i');
            icon.classList.toggle('fa-times');
            icon.classList.toggle('fa-comment-dots');

            if (!chatBox.classList.contains('d-none') && chatbox.innerHTML.trim() === '') {
                addMessage("Hai! Silahkan bertanya seputar Organisasi 🧑‍🤝‍🧑, ketikan pertanyaan sesuai menu yang muncul", 'bot');
                await showMainMenu();
            }
        });

        chatbox.addEventListener('click', async function (e) {
            if (e.target.classList.contains('menu-btn')) {
                const menu = e.target.dataset.menu;
                activeMenu = menu;
                addMessage(menu, 'user');
                await showSubMenu(menu);
            } else if (e.target.classList.contains('submenu-btn')) {
                const keyword = e.target.dataset.key;
                addMessage(e.target.innerText, 'user');
                await respondToKeyword(keyword);
            } else if (e.target.classList.contains('submenu-lv2-btn')) {
                const menu = e.target.dataset.org; // contoh: "List Organisasi"
                const sub = e.target.dataset.sub; // contoh: "BEM"
                activeMenu = {
                    menu,
                    sub
                };
                addMessage(sub, 'user');

                const subItems = menuGroups[menu][sub];
                if (!Array.isArray(subItems)) {
                    await botReplyWithTyping("Tidak dapat menampilkan sub menu.");
                    return;
                }

                const html = `
            <strong>${sub}</strong><br>Pilih detail:
            <div class="quick-options mt-2">
                ${subItems.map(item =>
                    `<button class="btn btn-outline-primary btn-sm submenu-btn" data-key="${item.key}">${item.label}</button>`
                ).join('')}
                <button class="btn btn-outline-danger btn-sm back-btn">⬅ Kembali</button>
            </div>
        `;
                await botReplyWithTyping(html);
            } else if (e.target.classList.contains('back-btn')) {
                if (typeof activeMenu === 'object') {
                    await showSubMenu(activeMenu.menu);
                    activeMenu = activeMenu.menu;
                } else {
                    activeMenu = null;
                    await showMainMenu();
                }
            }
        });
    });

</script>
