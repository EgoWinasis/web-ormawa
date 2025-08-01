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
    document.addEventListener('DOMContentLoaded', function () {
        const chatIcon = document.getElementById('chat-icon');
        const chatBox = document.getElementById('chatbot-box');
        const closeChat = document.getElementById('close-chat');
        const sendBtn = document.getElementById('send-btn');
        const chatbox = document.getElementById('chatbox');
        const input = document.getElementById('user-input');

        const menuGroups = {
            "Tentang Organisasi": ["pengertian", "tujuan", "ciri"],
            "Struktur & Tugas": ["struktur", "tugas", "ketua"],
            "Visi & Misi": ["visi", "misi"],
            "Pendaftaran": ["daftar", "regist"]
        };
        const allKeywords = Object.values(menuGroups).flat();
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


        function showInitialMessage() {
    // Bot greeting
    addMessage('Hai! Silahkan bertanya seputar Organisasi 🧑‍🤝‍🧑', 'bot');

    // List menu utama (topik yang bisa ditanyakan)
    const topikHTML = `
        Berikut beberapa topik yang bisa kamu tanyakan:
        <div class="quick-options mt-2">
            <button class="btn btn-outline-secondary" disabled>Tentang Organisasi</button>
            <button class="btn btn-outline-secondary" disabled>Struktur & Tugas</button>
            <button class="btn btn-outline-secondary" disabled>Visi & Misi</button>
            <button class="btn btn-outline-secondary" disabled>Pendaftaran</button>
        </div>
    `;
    addMessage(topikHTML, 'bot');
}

// Panggil fungsi ini setelah chat dibuka
document.getElementById('chat-icon').addEventListener('click', function () {
    chatboxContainer.classList.toggle('d-none');
    if (!chatboxContainer.classList.contains('d-none') && chatbox.innerHTML.trim() === '') {
        showInitialMessage(); // hanya muncul pertama kali
    }
});



       function addMessage(msg, type) {
    const div = document.createElement('div');
    div.className = `d-flex mb-3 ${type === 'user' ? 'justify-content-end' : 'justify-content-start'}`;

    const avatarSrc = type === 'user'
        ? 'https://cdn-icons-png.flaticon.com/512/1077/1077012.png'
        : 'https://cdn-icons-png.flaticon.com/512/4712/4712109.png';

    div.innerHTML = `
        ${type === 'bot' ? `<img src="${avatarSrc}" class="chat-avatar me-2">` : ''}
        <div class="${type === 'user' ? 'user-msg' : 'bot-msg'}">${msg}</div>
        ${type === 'user' ? `<img src="${avatarSrc}" class="chat-avatar ms-2">` : ''}
    `;

    chatbox.appendChild(div);
    scrollBottom();
}




        function showMenu() {
            let html = `<p>Berikut beberapa topik yang bisa kamu tanyakan:</p><div class="quick-options">`;
            for (const group in menuGroups) {
                html += `<button class="btn btn-outline-secondary btn-sm" disabled>${group}</button>`;
            }
            html += `</div>`;
            const wrapper = document.createElement('div');
            wrapper.className = 'd-flex mb-2';
            wrapper.innerHTML = `<div class="bot-msg">${html}</div>`;
            chatbox.appendChild(wrapper);
            scrollBottom();
        }

        function handleUserInput(message) {
            addMessage(message, 'user');
            const lower = message.trim().toLowerCase();
            setTimeout(() => {
                if (allKeywords.includes(lower)) {
                    addMessage(responses[lower], 'bot');
                } else {
                    addMessage("Maaf, saya belum punya jawaban untuk itu.", 'bot');
                    showMenu();
                }
            }, 500);
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
            }
        });


    });

</script>
