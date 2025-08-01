<div class="container my-5">
    <div class="card shadow chatbot">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Chatbot Organisasi</h5>
        </div>
        <div class="card-body p-3" style="max-height: 400px; overflow-y: auto;" id="chatbox">
            <div class="d-flex mb-3">
                <div class="bg-light p-2 rounded text-start">
                    Hai! Silahkan bertanya seputar Organisasi 🙌
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <div class="input-group">
                <input type="text" id="user-input" class="form-control" placeholder="Masukkan pertanyaan...">
                <button class="btn btn-primary" id="send-btn">Kirim</button>
            </div>
        </div>
    </div>
</div>

<style>
    .bot-msg, .user-msg {
        max-width: 75%;
        padding: 10px 15px;
        border-radius: 20px;
    }

    .bot-msg {
        background-color: #f1f1f1;
    }

    .user-msg {
        background-color: #0d6efd;
        color: white;
    }

    .quick-options {
        margin-top: 10px;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .quick-options button {
        border-radius: 15px;
        font-size: 0.875rem;
        pointer-events: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chatbox = document.getElementById('chatbox');
        const userInput = document.getElementById('user-input');
        const sendBtn = document.getElementById('send-btn');

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

        function addMessage(text, sender = 'bot') {
            const wrapper = document.createElement('div');
            wrapper.className = 'd-flex mb-3 ' + (sender === 'user' ? 'justify-content-end' : '');

            const bubble = document.createElement('div');
            bubble.className = (sender === 'user' ? 'user-msg' : 'bot-msg');
            bubble.innerText = text;

            wrapper.appendChild(bubble);
            chatbox.appendChild(wrapper);
            chatbox.scrollTop = chatbox.scrollHeight;
        }

        function showMenuOptions() {
            const wrapper = document.createElement('div');
            wrapper.className = 'd-flex mb-3';

            const div = document.createElement('div');
            div.className = 'bot-msg';

            div.innerHTML = 'Berikut beberapa topik yang bisa kamu tanyakan:';

            const optionWrap = document.createElement('div');
            optionWrap.className = 'quick-options';

            for (const [group, keywords] of Object.entries(menuGroups)) {
                const btn = document.createElement('button');
                btn.className = 'btn btn-outline-secondary btn-sm';
                btn.innerText = group;
                optionWrap.appendChild(btn);
            }

            div.appendChild(optionWrap);
            wrapper.appendChild(div);
            chatbox.appendChild(wrapper);
            chatbox.scrollTop = chatbox.scrollHeight;
        }

        sendBtn.addEventListener('click', () => {
            const message = userInput.value.trim().toLowerCase();
            if (!message) return;

            addMessage(message, 'user');
            userInput.value = '';

            setTimeout(() => {
                if (allKeywords.includes(message)) {
                    addMessage(responses[message]);
                } else {
                    addMessage("Maaf, saya belum punya jawaban untuk itu.");
                    showMenuOptions();
                }
            }, 500);
        });

        setTimeout(showMenuOptions, 1000);
    });
</script>
