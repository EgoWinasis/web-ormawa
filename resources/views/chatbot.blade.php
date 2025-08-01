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
            pengertian: "Organisasi adalah sekumpulan orang yang memiliki tujuan bersama.",
            tujuan: "Tujuan organisasi adalah untuk mencapai visi melalui misi tertentu.",
            ciri: "Ciri organisasi: terstruktur, punya tujuan, ada peran masing-masing.",
            struktur: "Struktur organisasi terdiri dari ketua, sekretaris, bendahara, dan divisi lainnya.",
            tugas: "Setiap anggota memiliki tugas sesuai dengan struktur yang ada.",
            ketua: "Ketua adalah pemimpin utama dalam organisasi.",
            visi: "Visi adalah gambaran jangka panjang yang ingin dicapai oleh organisasi.",
            misi: "Misi adalah langkah-langkah untuk mencapai visi.",
            daftar: "Untuk mendaftar, isi formulir dan kirim ke pengurus.",
            regist: "Silakan lakukan registrasi melalui link resmi atau hubungi admin."
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

        function showMainMenu() {
            const html = `
            Silakan pilih topik:
            <div class="quick-options mt-2">
                ${Object.keys(menuGroups).map(menu =>
                    `<button class="btn btn-outline-secondary btn-sm menu-btn" data-menu="${menu}">${menu}</button>`
                ).join('')}
            </div>
        `;
            addMessage(html, 'bot');
        }

        function showSubMenu(menu) {
            const subItems = menuGroups[menu];
            const html = `
            Topik: <strong>${menu}</strong><br>
            Pilih pertanyaan:
            <div class="quick-options mt-2">
                ${subItems.map(item =>
                    `<button class="btn btn-outline-primary btn-sm submenu-btn" data-key="${item.key}">${item.label}</button>`
                ).join('')}
                <button class="btn btn-outline-danger btn-sm back-btn">⬅ Kembali</button>
            </div>
        `;
            addMessage(html, 'bot');
        }

        function respondToKeyword(key) {
            // Tampilkan animasi "bot sedang mengetik"
            const loadingDiv = document.createElement('div');
            loadingDiv.className = 'd-flex mb-3 justify-content-start';
            loadingDiv.id = 'typing-msg';
            loadingDiv.innerHTML = `
        <img src="https://cdn-icons-png.flaticon.com/512/4712/4712109.png" class="chat-avatar me-2">
        <div class="typing-indicator">
            <span></span><span></span><span></span>
        </div>
    `;
            chatbox.appendChild(loadingDiv);
            scrollBottom();

            // Setelah 1.2 detik, ganti dengan jawaban sebenarnya
            setTimeout(() => {
                loadingDiv.remove();
                const msg = responses[key] || "Maaf, belum ada jawaban untuk topik ini.";
                addMessage(msg, 'bot');
                activeMenu = null;
                setTimeout(showMainMenu, 800);
            }, 3000);
        }



        function handleUserInput(message) {
            addMessage(message, 'user');
            const lower = message.trim().toLowerCase();
            const found = Object.values(menuGroups).flat().find(item => item.key === lower);
            if (found) {
                respondToKeyword(found.key);
            } else {
        // Tampilkan animasi mengetik selama 5 detik
        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'd-flex mb-3 justify-content-start';
        loadingDiv.id = 'typing-msg';
        loadingDiv.innerHTML = `
            <img src="https://cdn-icons-png.flaticon.com/512/4712/4712109.png" class="chat-avatar me-2">
            <div class="typing-indicator">
                <span></span><span></span><span></span>
            </div>
        `;
        chatbox.appendChild(loadingDiv);
        scrollBottom();

        setTimeout(() => {
            loadingDiv.remove();
            addMessage("Maaf, saya belum punya jawaban untuk itu.", 'bot');
            showMainMenu();
        }, 5000); // <-- 5 detik
    }
        }

        sendBtn.addEventListener('click', () => {
            const message = input.value.trim();
            if (!message) return;
            input.value = '';
            handleUserInput(message);
        });

        chatIcon.addEventListener('click', () => {
            chatBox.classList.toggle('d-none');
            const icon = chatIcon.querySelector('i');
            if (chatBox.classList.contains('d-none')) {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-comment-dots');
            } else {
                icon.classList.remove('fa-comment-dots');
                icon.classList.add('fa-times');

                if (chatbox.innerHTML.trim() === '') {
                    addMessage('Hai! Silahkan bertanya seputar Organisasi 🧑‍🤝‍🧑', 'bot');
                    showMainMenu();
                }
            }
        });

        chatbox.addEventListener('click', function (e) {
            if (e.target.classList.contains('menu-btn')) {
                const menu = e.target.dataset.menu;
                activeMenu = menu;
                addMessage(menu, 'user');
                setTimeout(() => {
                    showSubMenu(menu);
                }, 400);
            } else if (e.target.classList.contains('submenu-btn')) {
                const keyword = e.target.dataset.key;
                addMessage(e.target.innerText, 'user');
                setTimeout(() => {
                    respondToKeyword(keyword);
                }, 500);
            } else if (e.target.classList.contains('back-btn')) {
                activeMenu = null;
                showMainMenu();
            }
        });
    });

</script>
