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
    width: 1.25em; /* or any fixed width */
    text-align: center;
}
.chat-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
    align-self: flex-end;
}

.bot-msg, .user-msg {
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



</style>
<script>
const menuGroups = {
    "Tentang Organisasi": [
        { label: "Pengertian", key: "pengertian" },
        { label: "Tujuan", key: "tujuan" },
        { label: "Ciri", key: "ciri" }
    ],
    "Struktur & Tugas": [
        { label: "Struktur", key: "struktur" },
        { label: "Tugas", key: "tugas" },
        { label: "Ketua", key: "ketua" }
    ],
    "Visi & Misi": [
        { label: "Visi", key: "visi" },
        { label: "Misi", key: "misi" }
    ],
    "Pendaftaran": [
        { label: "Daftar", key: "daftar" },
        { label: "Registrasi", key: "regist" }
    ]
};

const responses = {
    "pengertian": "Organisasi adalah sekumpulan orang yang bekerja sama untuk tujuan tertentu.",
    "tujuan": "Tujuan organisasi adalah mencapai visi bersama.",
    "ciri": "Ciri organisasi antara lain: struktur, tujuan, dan kerja sama.",
    "struktur": "Struktur organisasi terdiri dari pimpinan, sekretaris, bendahara, dan anggota.",
    "tugas": "Setiap anggota memiliki tugas sesuai dengan peran dan tanggung jawabnya.",
    "ketua": "Ketua bertanggung jawab memimpin organisasi.",
    "visi": "Visi organisasi adalah menjadi lembaga terpercaya.",
    "misi": "Misi kami adalah melayani masyarakat dengan integritas.",
    "daftar": "Untuk mendaftar, silakan isi formulir di website kami.",
    "regist": "Registrasi dibuka setiap awal bulan."
};

let activeMenu = null;

function addMessage(content, sender = 'bot') {
    const chatbox = document.getElementById('chatbox');
    const bubble = document.createElement('div');
    bubble.className = 'chat-bubble ' + sender;
    bubble.innerHTML = content;
    chatbox.appendChild(bubble);
    scrollBottom();
}

function scrollBottom() {
    const chatbox = document.getElementById('chatbox');
    chatbox.scrollTop = chatbox.scrollHeight;
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
            <button class="btn btn-light btn-sm back-btn mt-2">🔙 Kembali</button>
        </div>
    `;
    addMessage(html, 'bot');
}

function respondToKeyword(key) {
    const msg = responses[key] || "Maaf, saya belum punya jawaban untuk topik ini.";
    addMessage(msg, 'bot');
    activeMenu = null;
    setTimeout(showMainMenu, 1000);
}

// Event listener utama
document.addEventListener('DOMContentLoaded', function () {
    showMainMenu();

    document.getElementById('chatbox').addEventListener('click', function (e) {
        if (e.target.classList.contains('menu-btn')) {
            const menu = e.target.dataset.menu;
            activeMenu = menu;

            addMessage(menu, 'user');

            setTimeout(() => {
                showSubMenu(menu);
            }, 400);
        }

        else if (e.target.classList.contains('submenu-btn')) {
            const keyword = e.target.dataset.key;
            addMessage(e.target.innerText, 'user');

            setTimeout(() => {
                respondToKeyword(keyword);
            }, 400);
        }

        else if (e.target.classList.contains('back-btn')) {
            activeMenu = null;
            showMainMenu();
        }
    });
});
</script>


