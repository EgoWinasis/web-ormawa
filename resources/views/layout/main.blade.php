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
    const keywords = ['visi', 'misi', 'pengertian', 'ciri', 'tujuan', 'daftar', 'regist', 'struktur', 'tugas', 'ketua'];
    const chatbox = document.getElementById('chatbox');
    const textarea = document.getElementById('chat-input');
    const menuContainer = document.getElementById('menu-container');

    // Buat menu keyword otomatis
    keywords.forEach(k => {
      let div = document.createElement('div');
      div.className = 'chat-option d-flex justify-content-between align-items-center mb-2';
      div.innerHTML = `
        <span>${capitalize(k)}</span>
        <span>&#8250;</span>
      `;
      div.onclick = () => {
        addUserMessage(k);
        simulateBotResponse(k);
      };
      menuContainer.appendChild(div);
    });

    function addUserMessage(message) {
      const div = document.createElement('div');
      div.className = 'chat outgoing mb-2';
      div.innerHTML = `<p class="ms-auto">${message}</p>`;
      chatbox.appendChild(div);
      scrollToBottom();
    }

    function simulateBotResponse(keyword) {
      const dots = document.querySelector('.typing');
      dots.style.display = 'block';

      setTimeout(() => {
        dots.style.display = 'none';
        const response = getBotResponse(keyword);

        const div = document.createElement('div');
        div.className = 'chat incoming mb-2';
        div.innerHTML = `<p>${response}</p>`;
        chatbox.appendChild(div);
        scrollToBottom();
      }, 1000);
    }

    function getBotResponse(keyword) {
      switch (keyword.toLowerCase()) {
        case 'visi':
          return "Visi kami adalah menjadi organisasi yang menciptakan pemimpin muda berintegritas.";
        case 'misi':
          return "Misi kami:\n1. Mengembangkan potensi anggota\n2. Menumbuhkan rasa tanggung jawab\n3. Meningkatkan kolaborasi tim.";
        case 'pengertian':
          return "Organisasi adalah wadah bagi sekelompok orang untuk mencapai tujuan bersama.";
        case 'ciri':
          return "Ciri organisasi:\n- Memiliki tujuan\n- Struktur jelas\n- Kerjasama antar anggota.";
        case 'tujuan':
          return "Tujuan kami adalah membentuk karakter dan kepemimpinan anggota.";
        case 'daftar':
        case 'regist':
          return "Silakan daftar melalui form pendaftaran di website kami atau hubungi admin.";
        case 'struktur':
          return "Struktur organisasi terdiri dari: Ketua, Wakil, Sekretaris, Bendahara, dan Divisi.";
        case 'tugas':
          return "Setiap divisi memiliki tugas khusus seperti humas, logistik, dokumentasi, dan lainnya.";
        case 'ketua':
          return "Ketua saat ini adalah Andi Saputra, menjabat sejak Januari 2025.";
        default:
          return "Maaf, saya tidak mengerti pertanyaan kamu.";
      }
    }

    function scrollToBottom() {
      chatbox.scrollTop = chatbox.scrollHeight;
    }

    document.getElementById('send-btn').addEventListener('click', () => {
      const message = textarea.value.trim();
      if (!message) return;
      addUserMessage(message);
      simulateBotResponse(message);
      textarea.value = '';
    });

    function capitalize(text) {
      return text.charAt(0).toUpperCase() + text.slice(1);
    }
  </script>


</body>
</html>
