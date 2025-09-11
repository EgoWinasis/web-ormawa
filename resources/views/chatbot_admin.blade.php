<!-- Chatbot Toggle Button -->
<div id="chat-toggle" class="position-fixed bottom-0 end-0 m-3 z-3">
    <button class="btn btn-primary rounded-circle p-3 shadow" id="chat-icon">
        <i class="fas fa-comment-dots fa-fw fa-lg"></i>
    </button>
</div>


</div>

<!-- Chatbot Box -->
<div id="chatbot-box" class="card shadow d-none"
    style="position: fixed; bottom: 80px; right: 20px; width: 350px; max-width: 90%; z-index: 1050; height: 50%;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <span>Chatbot Ormawa</span>

    </div>
    <div class="card-body chatbox" id="chatbox" style="max-height: 800px; overflow-y: auto;">
        <!-- Chat content here -->
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
            "Proposal": [{
                    label: "Alur Proposal",
                    key: "proposal"
                },
            ],
            "LPJ": [{
                    label: "Alur LPJ",
                    key: "alur_lpj"
                },
            ],
           

            "Punishment": [{
                    label: "Visi",
                    key: "visi"
                },
               
            ],
            "Kontak Person": [{
                    label: "Daftar",
                    key: "daftar"
                },

            ],

        };

        const responses = {
            proposal: `<p>
  Untuk melihat alur proposal, klik
  <a href="/proposal.jpeg" class="btn btn-danger btn-sm" target="_blank">
    <i class="fas fa-image"></i> di sini
  </a>.
</p>`,
            lpj: `<p>
  Untuk melihat alur lpj, klik
  <a href="/lpj.jpeg" class="btn btn-danger btn-sm" target="_blank">
    <i class="fas fa-image"></i> di sini
  </a>.
</p>`,
           


        };


        // variable
        let orgName = '';

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
                orgName = userMessage.toUpperCase();
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
                if (activeMenu && activeMenu.menu === "List Organisasi") {
                    activeMenu = "List Organisasi"; // reset balik ke menu utama List Organisasi
                }


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

        let isFirstOpen = true; // penanda apakah ini pertama kali dibuka

        chatIcon.addEventListener('click', async () => {
            chatBox.classList.toggle('d-none');

            const icon = chatIcon.querySelector('i');
            icon.classList.toggle('fa-times');
            icon.classList.toggle('fa-comment-dots');

            // Cek jika chatbox baru pertama kali dibuka
            if (!chatBox.classList.contains('d-none') && isFirstOpen) {
                addMessage(
                    "Hai! Silahkan bertanya seputar Organisasi 🧑‍🤝‍🧑, ketikan pertanyaan sesuai menu yang muncul",
                    'bot');
                await showMainMenu();

                isFirstOpen = false; // ubah flag agar tidak terulang
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
