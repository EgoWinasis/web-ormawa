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

    <style>
        .quick-options {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}
.option-btn {
    padding: 6px 12px;
    bac<style>
.chatbox {
  list-style: none;
  padding: 0;
  margin: 0;
}

.chat-option {
  background: #fff;
  border-radius: 12px;
  margin: 6px 0;
  padding: 12px 16px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  cursor: pointer;
  box-shadow: 0 1px 3px rgba(0,0,0,0.1);
  border: 1px solid #eee;
  transition: background 0.2s;
}

.chat-option:hover {
  background: #f2f2f2;
}

.arrow {
  font-weight: bold;
  color: #888;
  font-size: 16px;
}

.typing .dots {
  display: flex;
  gap: 4px;
  padding: 10px;
}

.dots span {
  width: 8px;
  height: 8px;
  background: #bbb;
  border-radius: 50%;
  animation: blink 1.4s infinite ease-in-out both;
}

.dots span:nth-child(2) { animation-delay: 0.2s; }
.dots span:nth-child(3) { animation-delay: 0.4s; }

@keyframes blink {
  0%, 80%, 100% {
    opacity: 0.2;
    transform: scale(0.9);
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
            <!-- Menu pilihan akan ditambahkan di sini lewat JS -->
    <li class="chat incoming" id="menu-container"></li>

    <!-- Typing animation -->
    <li class="chat incoming typing">
      <div class="dots">
        <span></span><span></span><span></span>
      </div>
    </li>
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

const menuContainer = document.getElementById('menu-container');
const menuWrapper = document.createElement('div');

keywords.forEach(keyword => {
  const item = document.createElement('div');
  item.className = 'chat-option';
  item.innerHTML = `<span>${capitalize(keyword)}</span><span class="arrow">›</span>`;
  
  // Tambahkan event jika diklik
  item.addEventListener('click', () => {
    sendUserMessage(keyword);
  });

  menuWrapper.appendChild(item);
});

menuContainer.appendChild(menuWrapper);

// Fungsi bantu kapitalisasi awal kata
function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}

// Fungsi untuk menampilkan pesan user di chat
function sendUserMessage(msg) {
  const chatbox = document.querySelector('.chatbox');
  const userMsg = `<li class="chat outgoing"><p>${msg}</p></li>`;
  chatbox.innerHTML += userMsg;

  // Scroll otomatis
  chatbox.scrollTop = chatbox.scrollHeight;

  // Simulasi bot berpikir
  setTimeout(() => {
    const botResponse = `<li class="chat incoming"><p>Kamu bertanya tentang: <strong>${msg}</strong></p></li>`;
    chatbox.innerHTML += botResponse;
    chatbox.scrollTop = chatbox.scrollHeight;
  }, 1000);
}
</script>


</body>
</html>
