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
    background-color: #f1f1f1;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}
.option-btn:hover {
    background-color: #dcdcdc;
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
            <li class="chat incoming">
            <div class="quick-options">
                <button class="option-btn">Struktur Organisasi</button>
                <button class="option-btn">Visi & Misi</button>
                <button class="option-btn">Kegiatan</button>
                <button class="option-btn">Kontak Pengurus</button>
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
document.querySelectorAll('.option-btn').forEach(button => {
    button.addEventListener('click', function() {
        const message = this.textContent;
        const chatbox = document.querySelector('.chatbox');

        // Tampilkan pesan pengguna
        const userMsg = `<li class="chat outgoing"><p>${message}</p></li>`;
        chatbox.innerHTML += userMsg;

        // Auto scroll ke bawah
        chatbox.scrollTop = chatbox.scrollHeight;

        // Kamu bisa kirim pesan ini ke backend, atau respon otomatis di sini
    });
});
</script>

</body>
</html>
