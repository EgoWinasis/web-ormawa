<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link ke css root -->
    <link rel="stylesheet" href="css/root.css">
    <!-- link ke css landing -->
    <link rel="stylesheet" href="css/landing.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <style>.chatbox {
      height: 400px;
      overflow-y: auto;
      padding: 1rem;
      background-color: #f8f9fa;
      border-radius: 0.5rem;
    }

    .chat.incoming p {
      background-color: #e9ecef;
      border-radius: 1rem;
      padding: 0.5rem 1rem;
      max-width: 75%;
    }

    .chat.outgoing p {
      background-color: #0d6efd;
      color: white;
      border-radius: 1rem;
      padding: 0.5rem 1rem;
      max-width: 75%;
      margin-left: auto;
    }

    .chat-option {
      cursor: pointer;
      border: 1px solid #dee2e6;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      transition: background-color 0.2s;
    }

    .chat-option:hover {
      background-color: #f1f1f1;
    }

    .dots span {
      width: 8px;
      height: 8px;
      background: #adb5bd;
      border-radius: 50%;
      display: inline-block;
      animation: blink 1.2s infinite ease-in-out;
    }

    .dots span:nth-child(2) { animation-delay: 0.2s; }
    .dots span:nth-child(3) { animation-delay: 0.4s; }

    @keyframes blink {
      0%, 80%, 100% {
        opacity: 0.2;
        transform: scale(0.8);
      }
      40% {
        opacity: 1;
        transform: scale(1);
      }
    }
</style>

    <title>@yield('title', 'Website ORMAWA')</title>
</head>

<body>
    @if (session('success'))
        <script>
            alert('berhasil mendaftar');
        </script>
    @endif

    {{-- Chatbot --}}
    <button class="chatbot-toggler">
        <span class="material-symbols-outlined">chat</span>
        <span class="material-symbols-outlined">close</span>
    </button>
    <div class="chatbot">
        <header>
            <h2>Chatbot</h2>
        </header>
        <ul class="chatbox active">
            <li class="chat incoming">
                <span class="material-symbols-outlined">smart_toy</span>
                <p>Hai, Silahkan bertanya seputar Organisasi🙌</p>
            </li>
     <div id="menu-container" class="mb-3"></div>
          <div class="chat incoming typing" style="display:none;">
            <div class="dots">
              <span></span><span></span><span></span>
            </div>
          </div>
        </ul>
        <div class="chat-input">
            <textarea placeholder="Masukan pertanyaan" required></textarea>
            <span id="send-btn" class="material-symbols-outlined">send</span>
        </div>
    </div>

    {{-- Header --}}
    <header>
        @include('layout.header')
    </header>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer or additional scripts --}}
    <script src="{{ asset('js/landing.js') }}"></script>
 <script>
  const chatbox = document.querySelector('.chatbox');
  const input = document.getElementById('user-input');
  const sendBtn = document.getElementById('send-btn');

  const menuGroups = {
    "Tentang Organisasi": ["pengertian", "tujuan", "ciri"],
    "Struktur & Tugas": ["struktur", "tugas", "ketua"],
    "Visi & Misi": ["visi", "misi"],
    "Pendaftaran": ["daftar", "regist"]
  };

  function scrollToBottom() {
    chatbox.scrollTop = chatbox.scrollHeight;
  }

  function addBotMessage(text) {
    const li = document.createElement('li');
    li.className = 'chat incoming';
    li.innerHTML = `<p>${text}</p>`;
    chatbox.appendChild(li);
    scrollToBottom();
  }

  function addUserMessage(text) {
    const li = document.createElement('li');
    li.className = 'chat outgoing';
    li.innerHTML = `<p>${text}</p>`;
    chatbox.appendChild(li);
    scrollToBottom();
  }

  function getBotResponse(keyword) {
    const responses = {
      "pengertian": "Organisasi adalah sekumpulan orang yang bekerja sama untuk mencapai tujuan tertentu.",
      "tujuan": "Tujuan organisasi adalah untuk mencapai visi dan misi yang telah ditetapkan.",
      "ciri": "Ciri organisasi antara lain: struktur jelas, tujuan bersama, pembagian tugas.",
      "struktur": "Struktur organisasi biasanya terdiri dari ketua, sekretaris, bendahara, dan divisi-divisi.",
      "tugas": "Tugas anggota organisasi tergantung pada posisi dan peran masing-masing.",
      "ketua": "Ketua organisasi adalah pemimpin utama yang bertanggung jawab atas jalannya organisasi.",
      "visi": "Visi adalah gambaran jangka panjang tentang tujuan besar organisasi.",
      "misi": "Misi adalah langkah-langkah strategis yang dilakukan untuk mencapai visi.",
      "daftar": "Untuk mendaftar, silakan isi formulir pendaftaran melalui panitia atau link yang tersedia.",
      "regist": "Registrasi dilakukan setiap awal periode kepengurusan. Pastikan kamu memenuhi syarat ya!"
    };
    return responses[keyword.toLowerCase()] || "Maaf, saya belum mengerti pertanyaan tersebut.";
  }

  function showMainCategories() {
    const li = document.createElement('li');
    li.className = 'chat incoming';
    li.innerHTML = `<p>Silahkan pilih kategori:</p>`;

    const buttonContainer = document.createElement('div');
    buttonContainer.className = 'quick-options';

    for (const category in menuGroups) {
      const button = document.createElement('button');
      button.className = 'option-btn';
      button.innerHTML = `${category} &#8250;`;
      button.onclick = () => showSubMenu(category);
      buttonContainer.appendChild(button);
    }

    li.appendChild(buttonContainer);
    chatbox.appendChild(li);
    scrollToBottom();
  }

  function showSubMenu(category) {
    const li = document.createElement('li');
    li.className = 'chat incoming';
    li.innerHTML = `<p>Pilih topik dari <b>${category}</b>:</p>`;

    const buttonContainer = document.createElement('div');
    buttonContainer.className = 'quick-options';

    menuGroups[category].forEach(keyword => {
      const button = document.createElement('button');
      button.className = 'option-btn';
      button.textContent = keyword.charAt(0).toUpperCase() + keyword.slice(1);
      button.onclick = () => {
        addUserMessage(keyword);
        simulateBotResponse(keyword);
      };
      buttonContainer.appendChild(button);
    });

    li.appendChild(buttonContainer);
    chatbox.appendChild(li);
    scrollToBottom();
  }

  function simulateBotResponse(keyword) {
    const loading = document.createElement('li');
    loading.className = 'chat incoming';
    loading.innerHTML = `<p><i>Sedang berpikir</i> <span class="dots">.</span></p>`;
    chatbox.appendChild(loading);
    scrollToBottom();

    let dotCount = 1;
    const dotInterval = setInterval(() => {
      const span = loading.querySelector('.dots');
      dotCount = (dotCount % 3) + 1;
      span.textContent = '.'.repeat(dotCount);
    }, 500);

    setTimeout(() => {
      clearInterval(dotInterval);
      loading.remove();
      addBotMessage(getBotResponse(keyword));
    }, 1000);
  }

  sendBtn.addEventListener('click', () => {
    const userText = input.value.trim();
    if (!userText) return;
    addUserMessage(userText);
    input.value = '';
    simulateBotResponse(userText);
  });

  input.addEventListener('keypress', e => {
    if (e.key === 'Enter') {
      sendBtn.click();
      e.preventDefault();
    }
  });

  // Saat pertama dibuka
  window.addEventListener('DOMContentLoaded', () => {
    addBotMessage("Hai! Silahkan pilih kategori untuk mulai bertanya 🙌");
    showMainCategories();
  });
</script>


</body>
</html>
