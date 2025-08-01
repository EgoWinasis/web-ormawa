const chatbox = document.querySelector('.chatbox');
const sendBtn = document.getElementById('send-btn');
const userInput = document.getElementById('user-input');

// Menu kategori dan sub-menu
const menuGroups = {
  "Tentang Organisasi": ["pengertian", "tujuan", "ciri"],
  "Struktur & Tugas": ["struktur", "tugas", "ketua"],
  "Visi & Misi": ["visi", "misi"],
  "Pendaftaran": ["daftar", "regist"]
};

// Balasan dari bot untuk tiap keyword
function getBotResponse(keyword) {
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
  return responses[keyword.toLowerCase()] || "Maaf, saya belum punya jawaban untuk itu.";
}

// Tampilkan pesan user
function addUserMessage(message) {
  const li = document.createElement('li');
  li.className = 'chat outgoing';
  li.innerHTML = `<p>${message}</p>`;
  chatbox.appendChild(li);
  scrollToBottom();
}

// Tampilkan pesan bot
function addBotMessage(message) {
  const li = document.createElement('li');
  li.className = 'chat incoming';
  li.innerHTML = `<p>${message}</p>`;
  chatbox.appendChild(li);
  scrollToBottom();
}

// Scroll otomatis ke bawah
function scrollToBottom() {
  chatbox.scrollTop = chatbox.scrollHeight;
}

// Tampilkan kategori utama
function showMainCategories() {
  const li = document.createElement('li');
  li.className = 'chat incoming';
  li.innerHTML = `<p>Silakan pilih kategori:</p>`;

  const buttonContainer = document.createElement('div');
  buttonContainer.className = 'quick-options';

  for (const category in menuGroups) {
    const button = document.createElement('button');
    button.className = 'option-btn';
    button.innerHTML = `${category} &#8250;`; // › arrow
    button.onclick = () => showSubMenu(category);
    buttonContainer.appendChild(button);
  }

  li.appendChild(buttonContainer);
  chatbox.appendChild(li);
  scrollToBottom();
}

// Tampilkan submenu berdasarkan kategori
function showSubMenu(category) {
  const li = document.createElement('li');
  li.className = 'chat incoming';
  li.innerHTML = `<p>Pilih topik dari kategori <b>${category}</b>:</p>`;

  const buttonContainer = document.createElement('div');
  buttonContainer.className = 'quick-options';

  menuGroups[category].forEach(keyword => {
    const button = document.createElement('button');
    button.className = 'option-btn';
    button.innerText = keyword.charAt(0).toUpperCase() + keyword.slice(1);
    button.onclick = () => {
      addUserMessage(keyword);
      setTimeout(() => {
        addBotMessage(getBotResponse(keyword));
        setTimeout(showMainCategories, 800); // tampilkan menu lagi setelah bot jawab
      }, 500);
    };
    buttonContainer.appendChild(button);
  });

  li.appendChild(buttonContainer);
  chatbox.appendChild(li);
  scrollToBottom();
}

// Proses input manual
sendBtn.addEventListener('click', () => {
  const message = userInput.value.trim();
  if (message) {
    addUserMessage(message);
    setTimeout(() => {
      addBotMessage(getBotResponse(message));
      setTimeout(showMainCategories, 800);
    }, 500);
    userInput.value = '';
  }
});

// Inisialisasi awal
window.addEventListener('DOMContentLoaded', () => {
  showMainCategories();
});
