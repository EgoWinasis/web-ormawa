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
        <div class="d-flex mb-3">
            <div class="bg-light p-2 rounded text-start">
                Hai! Silahkan bertanya seputar Organisasi 🙌
            </div>
        </div>
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


</style>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const chatIcon = document.getElementById('chat-icon');
    const chatBox = document.getElementById('chatbot-box');
    const closeChat = document.getElementById('close-chat');
    const sendBtn = document.getElementById('send-btn');
    const chatbox = document.getElementById('chatbox');
    const input = document.getElementById('user-input');

    const menuGroups = {
        "tentang organisasi": ["pengertian", "tujuan", "ciri"],
        "struktur & tugas": ["struktur", "tugas", "ketua"],
        "visi & misi": ["visi", "misi"],
        "pendaftaran": ["daftar", "regist"]
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

    let selectedMainMenu = null;

    function scrollBottom() {
        chatbox.scrollTop = chatbox.scrollHeight;
    }

    function addMessage(msg, type) {
        const div = document.createElement('div');
        div.className = `d-flex mb-2 ${type === 'user' ? 'justify-content-end' : ''}`;
        div.innerHTML = `<div class="${type === 'user' ? 'user-msg' : 'bot-msg'}">${msg}</div>`;
        chatbox.appendChild(div);
        scrollBottom();
    }

    function showMainMenuHint() {
        let html = `<p>Ketik salah satu topik utama berikut:</p><ul>`;
        for (const group in menuGroups) {
            html += `<li><strong>${group}</strong></li>`;
        }
        html += `</ul>`;
        addMessage(html, 'bot');
    }

    function showSubMenuHint(mainMenu) {
        const subMenus = menuGroups[mainMenu];
        let html = `<p>Kamu memilih <strong>${mainMenu}</strong>. Ketik salah satu sub topik berikut:</p><ul>`;
        subMenus.forEach(sub => {
            html += `<li>${sub}</li>`;
        });
        html += `</ul>`;
        addMessage(html, 'bot');
    }

    function handleUserInput(message) {
        const msg = message.trim().toLowerCase();
        if (!msg) return;

        addMessage(message, 'user');

        if (!selectedMainMenu) {
            if (menuGroups[msg]) {
                selectedMainMenu = msg;
                showSubMenuHint(msg);
            } else {
                addMessage("Maaf, topik utama tidak dikenali. Coba ketik salah satu topik berikut.", 'bot');
                showMainMenuHint();
            }
        } else {
            const subMenus = menuGroups[selectedMainMenu];
            if (subMenus.includes(msg)) {
                if (responses[msg]) {
                    addMessage(responses[msg], 'bot');
                } else {
                    addMessage("Maaf, saya belum punya jawaban untuk itu.", 'bot');
                }
                selectedMainMenu = null;
                setTimeout(showMainMenuHint, 600);
            } else {
                addMessage("Sub topik tidak dikenali. Ketik salah satu dari sub topik berikut.", 'bot');
                showSubMenuHint(selectedMainMenu);
            }
        }
    }

    sendBtn.addEventListener('click', () => {
        const message = input.value.trim();
        input.value = '';
        handleUserInput(message);
    });

    input.addEventListener('keypress', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendBtn.click();
        }
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
            scrollBottom();
        }
    });

    closeChat.addEventListener('click', () => {
        chatBox.classList.add('d-none');
        const icon = chatIcon.querySelector('i');
        icon.classList.remove('fa-times');
        icon.classList.add('fa-comment-dots');
    });

    // Awal tampilkan sapaan dan menu utama
    setTimeout(() => {
        addMessage("Hai! Ada yang bisa saya bantu? 😊", 'bot');
        showMainMenuHint();
    }, 500);
});




</script>
