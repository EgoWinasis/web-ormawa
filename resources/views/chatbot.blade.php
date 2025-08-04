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
                        label: "Kegiatan",
                        key: "bem_kegiatan"
                    },
                ],
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
                "AKUNTANSI": [{
                        label: "Visi",
                        key: "akuntansi_visi"
                    },
                    {
                        label: "Misi",
                        key: "akuntansi_misi"
                    },
                    {
                        label: "Struktur",
                        key: "akuntansi_struktur"
                    }
                ]
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
            ]
        };

        const responses = {
            pengertian: "Menurut Prof. Dr. Sondang P. Siagian, organisasi adalah ...",
            tujuan: "Tujuan organisasi adalah ...",
            ciri: "Ciri organisasi: terstruktur, punya tujuan, ada peran masing-masing.",
            struktur: "Struktur organisasi terdiri dari ketua, sekretaris, bendahara, dan divisi lainnya.",
            tugas: "Setiap anggota memiliki tugas sesuai struktur.",
            ketua: "Ketua adalah pemimpin utama.",
            visi: "Visi adalah gambaran jangka panjang.",
            misi: "Misi adalah langkah untuk mencapai visi.",
            daftar: 'Untuk mendaftar sebagai anggota baru, klik <a href="/register" class="linkDaftar">di sini</a>.',
            regist: "Silakan registrasi melalui link resmi.",

            bem_visi: 'Dengan visi kami "Menjadikan BEM Politeknik Harapan Bersama Sebagai Wadah Untuk Mewujudkan Mahasiswa yang Cerah (Cerdas, Religius, Aktif, & Harmonis)',
            bem_misi: 'Misi: <br>1. Mendorong Pengembangan Kualitas Sumber daya Mahasiswa PHB. <br>2. Meningkatnya Produktifitas dan Kreatifitas. <br>3. Terciptanya solidaritas mahasisiwa yang advokatif dan Berkesinambungan.<br>4. Terwujudnya BEM yang Harmonis dan aspiratif.',
            bem_struktur: "Struktur BEM: Ketua, Wakil, Sekretaris, Bendahara, Divisi.",
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

            bpm_visi: "Visi BPM KM PHB adalah “Mewujudkan lembaga perwakilan mahasiswa yang inovatif, aspiratif, dan berintegritas berasaskan pancasila",
            bpm_misi: "Misi: <br> 1. Menampung dan menyalurkan aspirasi mahasiswa yang bersifat membangun.<br> 2. Mengawasi dan mengevaluasi kinerja KM PHB.",
            bpm_struktur: "1. PRESMA<br>2. WAPRESMA<br>3. Sekretaris<br>4. Bendahara<br>5. KOMINFO<br>6. DEPSOS<br>8. ADKESMA<br>9. KMB<br> 10. KKP",
            bpm_tugas: "#Tugas Pokok struktural BPM\
#Ketua Umum BPM<br>\
1.Memimpin BPM KM PHB dalam kegiatan keorganisasian.<br>\
2.Mengkoordinir dan mengawasi pelaksanaan program kerja.<br>\
3.Membuat keputusan bijak dan bertanggung jawab atas segala hal yang dilakukan BPM KM PHB tanpa menyimpang dari AD/ART.<br>\
#Sekretaris Umum:<br>\
1.Membantu Ketua Umum dalam melaksanakan tugas-tugas yang berhubungan dengan BPM KM PHB.<br>\
2.Mengatur segala urusan yang berhubungan dengan kesekretariatan KM PHB.<br>\
3.Melakukan pengawasan pada alur keluar dan masuk kesekretariatan BPM KM PHB.<br>\
4.Berkoordinasi dengan Sekretaris BEM untuk Merumuskan Standard Operating Procedure unit KM PHB.<br>\
#Bendahara Umum:<br>\
1.Mengatur keuangan BPM KM PHB.<br>\
2.Membuat laporan anggaran pengeluaran dan pemasukan BPM KM PHB.<br>\
3.Merancang Rencana Anggaran Biaya BPM KM PHB.<br>\
#Hubungan Mahasiswa I:<br>\
1.Menyusun dan menyampaikan informasi kepada internal kampus.<br>\
2.Bertanggungjawab untuk mengatur dan menjalankan penyebaran informasi kepada pihak internal kampus.<br>\
3.Mempublikasikan informasi mengenai kegiatan dan program kerja KM PHB, serta merancang desain dan konten kreatif yang mencakup informasi <br>\tentang Badan Perwakilan Mahasiswa KM PHB.<br>\
#Hubungan Mahasiswa II:<br>\
1.Menjalin dan mengembangkan hubungan antar lembaga di luar kampus, baik secara bilateral maupun multilateral. <br>\
2.Bertanggungjawab untuk mengatur penyebaran informasi kepada pihak eksternal kampus.<br>\
3.Membantu Humas I dalam mempublikasikan informasi mengenai kegiatan dan program kerja KM PHB, serta merancang desain dan konten kreatif <br>\yang mencakup informasi tentang Badan Perwakilan Mahasiswa KM PHB.<br>\
#Ketua Komisi:<br>\
1.Bertanggung jawab atas segala hal yang berkaitan dengan komisinya.<br>\
2.Bertanggung jawab atas anggotanya dan memberikan motivasi serta arahan kepada anggotanya agar melaksanakan tugas yang ada dengan baik.<br>\
3.Merumuskan Undang-Undang bersama Badan Pengurus Harian BPM KM<br>\
PHB.<br>\
#Komisi I (Yudisial):<br>\
1.Merumuskan AD/ART BPM KM PHB.<br>\
2.Mengeluarkan Surat Keputusan untuk setiap kegiatan KM PHB.<br>\
#Komisi II (Pengawasan):<br>\
1.Membantu menindaklanjuti anggota KM PHB yang telah melakukan pelanggaran tata tertib yang telah ditentukan.<br>\
2.Mengawasi dan menilai kedisiplinan pelaksanaan program kerja yang dilaksanakan oleh Pengurus KM PHB.<br>\
3.Mengevaluasi program kerja yang telah dijalankan KM PHB.<br>\
#Komisi III (Budgeting): <br>\
1.Mengawasi alur masuk dan keluarnya anggaran yang digunakan KM PHB.<br>\
2.Mengawasi kinerja Bendahara BEM.<br>\
3.Mengawasi alur masuk dan keluarnya dana sosial serta dana denda LPJ yang       dikelola oleh Departemen Sosial dan Bendahara BEM.<br>\
#Komisi IV (Advokasi): <br>\
1.Menampung aspirasi seluruh mahasiswa Politeknik Harapan Bersama.<br>\
2.Berkoordinasi dengan Departemen Adkesma BEM KM PHB dalam menindaklanjuti aspirasi mahasiswa yang bersifat membangun.<br>\
3.Mencari informasi di internal dan di eksternal kampus.",

            akuntansi_visi: "Visi Akuntansi: Profesionalisme akuntan muda.",
            akuntansi_misi: "Misi: Literasi keuangan, kolaborasi internal eksternal.",
            akuntansi_struktur: "Struktur: Ketua, Sekretaris, Divisi Pendidikan & Kewirausahaan."
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
            activeMenu = null;
            setTimeout(showMainMenu, 800);
        }

        async function handleUserInput(message) {
            const userMessage = message.trim();
            if (!userMessage) return;
            addMessage(userMessage, 'user');

            const lower = userMessage.toLowerCase();

            // Pemetaan langsung untuk keyword seperti "bem visi"
            const directKeywordMap = {
                'bem visi': 'bem_visi',
                'bem misi': 'bem_misi',
                'bem struktur': 'bem_struktur',
                'bem kegiatan': 'bem_kegiatan',
                'bem tugas': 'bem_tugas',
                'bpm visi': 'bpm_visi',
                'bpm misi': 'bpm_misi',
                'bpm tugas': 'bpm_tugas',
                'bpm struktur': 'bpm_struktur',
                'akuntansi visi': 'akuntansi_visi',
                'akuntansi misi': 'akuntansi_misi',
                'akuntansi struktur': 'akuntansi_struktur'
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
                    return;
                }
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
                addMessage("Hai! Silahkan bertanya seputar Organisasi 🧑‍🤝‍🧑", 'bot');
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
