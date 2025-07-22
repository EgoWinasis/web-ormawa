let orgs = document.querySelectorAll('.list-org');
let title = document.querySelector('.title');
const units = document.querySelectorAll('.container-unit');
const dropdown = document.querySelector('.dropdown');
const links = document.querySelectorAll('header a');


links.forEach((link) => {
    link.addEventListener('click', ()=> {
        links.forEach(link => link.classList.remove('active'));
        link.classList.add('active');
        document.body.classList.remove('show-chatbot');
        document.querySelector('.dropdown').classList.remove('active');
    })
});


document.querySelector('.showOrg').addEventListener('click', function(){
    dropdown.classList.toggle('active');
    
});






function toggleLink() {
    units.forEach((unit)=> unit.classList.remove('active'));
     let header = this.dataset.name;
    title.innerHTML = `INFORMASI KEGIATAN<br> UNIT ${header.toUpperCase()}`;
    document.querySelector(`#${header}`).classList.add('active');
    document.querySelector('.dropdown').classList.remove('active');
}
orgs.forEach((org) => {
    document.body.classList.remove('show-chatbot');
    org.addEventListener('click', toggleLink);
})

// document.querySelector('.dropdown-options li:last-child').addEventListener('click', ()=> {
//     dropdown.classList.remove('active');
// });

// showChatboot
const chatbotToggler = document.querySelector('.chatbot-toggler');

chatbotToggler.addEventListener('click', ()=> {
    document.body.classList.toggle('show-chatbot');
})

// chat handler
const chatInput = document.querySelector('.chat-input textarea');
const senderChat = document.querySelector('.chat-input span');
const chatBox = document.querySelector('.chatbox')
const botChat = document.querySelector('.chatbox incoming')

// QnA

let answers = [];
answers['visi'] = ['Dengan visi kami "Menjadikan BEM Politeknik Harapan Bersama Sebagai Wadah Untuk Mewujudkan Mahasiswa yang Cerah (Cerdas, Religius, Aktif, & Harmonis)"','Visi BPM KM PHB adalah “Mewujudkan lembaga perwakilan mahasiswa yang inovatif, aspiratif, dan berintegritas berasaskan pancasila” <br>']
answers['misi'] = ['Misi: <br>1. Mendorong Pengembangan Kualitas Sumber daya Mahasiswa PHB. <br>2. Meningkatnya Produktifitas dan Kreatifitas. <br>3. Terciptanya solidaritas mahasisiwa yang advokatif dan Berkesinambungan.<br>4. Terwujudnya BEM yang Harmonis dan aspiratif.','Misi: <br> 1. Menampung dan menyalurkan aspirasi mahasiswa yang bersifat membangun.<br> 2. Mengawasi dan mengevaluasi kinerja KM PHB.']
answers['ciri'] = 'Terdapat beberapa ciri organisasi antara lain terdiri dari dua orang atau lebih, memiliki tujuan yang sama dan ingin mewujudkannya, saling bekerja sama, memiliki peraturan, serta ada pembagian tugas juga tanggung jawab bagi anggotanya.';
answers['struktur'] = [
    '1. PRESMA<br>2. WAPRESMA<br>3. Sekretaris<br>4. Bendahara<br>5. KOMINFO<br>6. DEPSOS<br>8. ADKESMA<br>9. KMB<br> 10. KKP',
    '1. Ketua Umum<br>2. Sekretaris Umum<br>3. Bendahara<br>4. Hubungan Mahasiswa I<br>5. Hubungan Mahasiswa II<br>6. Komisi I<br>8. Komisi II<br>9. Komisi III<br> 10. Komisi IV',
    '1. Ketua<br>2. Wakil Ketua<br>3. Wakil Ketua<br>4. Sekretaris I<br>5. Sekertaris II<br>6. Bendahara I<br>8. Bendahara II<br>9. Koordinator Department RnD (Research and Development Department)<br> 10. Anggota Department RnD (Research and Development Departement)<br> 11. Koordinator Department HRD (Human Resource Departement)<br> 12. Anggota Department HRD (Human Resource Departement) <br> 13. Koordinator Department Enterpreneur (Entrepreneur Department)<br>14. Koordinator Department Enterpreneur (Entrepreneur Department)<br>15. Anggota Department Enterpreneur (Enterpreneur Departement)<br>16. Koordinator Department PR (Public Relation Department)<br>17. Anggota Department PR (Public Relation Departement)',
    '1. Ketua<br>2. Wakil Ketua<br>3. Sekretaris<br>4. Bendahara<br>5. Ketua Divisi RnD (Riset and Development<br>6. Anggota Divisi RnD (Riset and Development)<br>8. Ketua Divisi JIK (Jaringan Informasi dan Komunikasi)<br>9. Anggota Divisi JIK (Jaringan Informasi dan Komunikasi)<br> 10. Ketua Divisi DP2M (Divisi Pengembangan Potensi Mahasiswa)',

    '1. Ketua <br>\
     2. Wakil Ketua<br>\
     3. Sekretaris<br>\
     4. Bendahara<br>\
     5. Departemen Pengembangan Keterampilan Mahasiswa<br>\
     6. Departemen Humas<br>\
     7.Departemen Komunikasi dan Informasi<br>\
     8. Departemen Konten Kreatif<br>\
     ',
    '1. Ketua <br>\
     2. Wakil Ketua<br>\
     3. Sekretaris<br>\
     4. Bendahara<br>\
     5. Divisi Pengembangan Minat Bakat<br>\
     6. Divisi Social<br>\
     7. Divisi Kewirausahaan<br>\
     8. Divisi Publikasi<br>\
     9. Divisi Humas',
     '1. Ketua<br>\
     2. Wakil Ketua<br>\
     3. Sekretaris<br>\
     4. Bendahara<br>\
     5. Divisi Humas<br>\
     6. Divisi Kominfo<br>\
     7. Divisi Kekeluargaan<br>\
     8. Divisi Minat Bakat',

     'Ketua<br>\
     Wakil Ketua<br>\
     Sekretaris I<br>\
     Sekretaris II <br>\
     Sekretaris III<br>\
     Bendahara I <br>\
     Bendahara II<br>\
     Divisi Humas<br>\
     Divisi Sosial<br>\
     Divisi kewirausahaan<br>\
     Divisi Komunikasi dan informasi<br>\
     Divisi Minat & Bakat',
     'Ketua<br>\
    Wakil Ketua<br>\
    Sekretaris <br>\
    Bendahara<br>\
    Divisi Akademik<br>\
    Divisi Kerumahtanggaan<br>\
    Divisi Humas<br>\
    Divisi Jurnalistik<br>',
    'Ketua Himpunan<br>\
    Wakil Ketua Himpunan<br>\
    Sekertaris<br>\
    Bendahara<br>\
    Departemen<br>\
    BPHM ( Badan Pengawas Himaprodi Mesin)<br>\
    Ketua Himpunan<br>\
    Wakil Ketua Himpunan<br>\
    Sekertaris<br>\
    Bendahara<br>\
    Departemen<br>\
    BPHM ( Badan Pengawas Himaprodi Mesin)<br>\
    Divisi Minat Bakat<br>\
    Divisi Kewirausahaan<br>\
    Divisi Media Komunikasi dan Informasi<br>\
    Divisi Pengembangan Sumber Daya Manusia<br>\
    Humas', 
    'Ketua<br>\
    Wakil Ketua<br>\
    Sekretaris<br>\
    Bendahara <br>\
    Divisi Humas Internal & Eksternal <br>\
    Divisi Pengabdian Masyarakat<br>\
    Divisi Enterpreneur atau Kewirausahaan<br>\
    Divisi Kominfo (Kominikasi dan Informasi)<br>\
    Divisi Prestasi dan akademik',
    'Ketua<br>\
    Wakil Ketua<br>\
    Sekretaris<br>\
    Bendahara<br>\
    Divisi Humas Internal<br>\
    Divisi Humas Eksternal <br>\
    Divisi Akademik<br>\
    Divisi Kominfo (Komunikasi dan Informasi) <br>\
    Divisi Sosial <br>\
    Divisi Kekeluargaan',


];
answers['tugas'] = ['#Ketua BEM<br>\
1.Memimpin dan mengkoordinasikan kegiatan BEM KM PHB><br>\
2.Memberikan laporan pertanggung jawaban diakhir periode kepada BPM<br>\
3.Mengkoordinasikan kinerja Himpunan Mahasiswa Program Studi yang ada di 4.Politeknik Harapan Bersama<br>\
5.Mengangkat dan memberhentikan anggota BEM KM PHB<br>\
6.Menjalankan tugas menurut AD / ART BEM KM PHB<br>\
7.Memberikan sanksi dengan tegas anggota BEM KM PHB sesuai AD/ART<br>\
#Wakil Ketua BEM<br>\
1.Membantu ketua BEM dalam menjalankan tugasnya<br>\
2.Menjalankan tugas-tugas ketua BEM apabila ketua BEM tidak bisa hadir atau 3.sedang berhalangan<br>\
4.Mengelola Rumah Tangga di Lembaga BEM KM PHB<br>\
5.Menjalankan tugas menurut AD / ART BEM KM PHB <br>\
#Sekretaris 1<br>\
1.Berkoordinasi dan merumuskan Standard Operating Procedure lembaga KM PHB bersama Sekretaris Umum BPM. <br>\
2.Menguasai birokrasi proposal, undangan, dan surat menyurat<br>\
3.Bertanggung jawab terhadap tata naskah dinas yang dibutuhkan<br>\
4.Mengelola absensi BEM KM PHB<br>\
5.Mampu membantu permasalahan birokrasi proposal ormawa dengan melakukan pengecekan format sesuai SOP. <br>\
6.Melakukan pengarsipan dan perapihan dokumen BEM KM PHB.<br>\
#Sekretaris 2<br>\
1.Menjalankan tugas-tugas Sekretaris 1 apabila sekretaris 1 tidak bisa hadir atau sedang berhalangan.<br>\
2.Mengelola Inventaris penunjang organisasi <br>\
3.Pengawasan Inventaris BEM KM PHB<br>\
4.Membantu sekretaris I dalam mengkoordinasikan dan menjalankan tugas menurut AD / ART BEM KM PHB.<br>\
#Bendahara 1<br>\
1.Pengelolaan keuangan BEM KM PHB menjadi tanggung jawab utama <br>\
2.Mengatur keuangan dan mengawasi arus dana masuk dan dana keluar BEM dan ormawa<br>\
3.Merumuskan dan menetapkan kebijakan dibidang keuangan <br>\
4.Berusaha menopang kemandirian keuangan BEM KM PHB<br>\
#Bendahara 2<br>\
1.Menjalankan tugas-tugas bendahara 1 apabila bendahara 1 tidak bisa hadir atau sedang berhalangan.<br>\
2.Bertugas membantu bendahara 1 dalam mengkoordinasikan dan menjalankan tugas menurut AD/ART BEM KM PHB.<br>\
#Kepala Departeman Advokasi dan Kesejahteraan Mahasiswa, Divisi Mahasiswa dan Divisi Masyarakat<br>\
1.Bertanggung jawab kepada Ketua BEM KM PHB<br>\
2.Kepala Departemen Advokasi dan Kesejahteraan Mahasiswa Penanggung jawab tertinggi Departemen Advokasi dan Kesejahteraan Mahasiswa.<br>\
3.Berorientasi pada kajian dan responsife terhadap gerakan serta permasalahan isu masyarakat.<br>\
#Kepala Departemen Sosial, Divisi Mahasiswa, Divisi Masyarakat<br>\
1.Bertanggung jawab kepada Ketua BEM KM PHB<br>\
2.Kepala Departemen Sosial Penanggung jawab tertinggi Departemen Sosial<br>\
3.Berorientasi pada kegiatan sosial dan kerohanian dalam lingkungan PHB.<br>\
#Kepala Departemen Komunikasi dan Informasi, Divisi Internal, Divisi Eksternal<br>\
1.Bertanggung jawab kepada Ketua BEM KM PHB<br>\
2.Kepala Departmen Komunikasi dan Informasi  Penanggung jawab tertinggi Departemen Komunikasi dan Informasi.<br>\
3.Mengetahui secara umum tentang Politeknik Harapan Bersama membuat dan  mengupdate data base anggota ormawa KM PHB <br>\
#Kepala Departemen Kepemudaan dan Minat Bakat, Divisi Kepemudaan, Divisi Minat Bakat<br>\
1.Bertanggung jawab kepada ketua BEM KM PHB<br>\
2.Kepala Departemen Kepemudaan dan Minat Bakat merupakan penanggung jawab tertinggi Departemen KMB.<br>\
3.Melakukan tugas kaderisasi bersama seluruh Himpunan Mahasiswa Program Studi (HIMAPRODI) untuk mewujudkan organisasi yang baik<br>\
#Kepala Departemen Kekaryaan, kewirausahaan dan Penalaran<br>\
1.Bertanggung jawab kepada Ketua BEM KM PHB<br>\
2.Kepala Departemen Kekaryaan.Kewirausahaan dan penalaran penanggung jawab tertinggi Departemen Kekaryaan.  Kewirausahaan dan penalaran<br>\
3.Menjalin hubungan mitra dengan Internal maupun Eksternal dalam kewirausahaan'
,'#Tugas Pokok struktural BPM\
#Ketua Umum BPM<br>\
1.Memimpin BPM KM PHB dalam kegiatan keorganisasian.<br>\
2.Mengkoordinir dan mengawasi pelaksanaan program kerja.<br>\
3.Membuat keputusan bijak dan bertanggung jawab atas segala hal yang dilakukan BPM KM PHB tanpa menyimpang dari AD/ART.<br>\
#Sekretaris Umum:<br>\
1.Membantu Ketua Umum dalam melaksanakan tugas-tugas yang berhubungan dengan BPM KM PHB.<br>\
2.Mengatur segala urusan yang berhubungan dengan kesekretariatan KM PHB.<br>\
3.Melakukan pengawasan pada alur keluar dan masuk kesekretariatan BPM KM PHB.<br>\
4.Berkoordinasi dengan Sekretaris BEM untuk Merumuskan Standard Operating Procedure unit KM PHB.<br>\
#Bendahara Umum:<br>\
1.Mengatur keuangan BPM KM PHB.<br>\
2.Membuat laporan anggaran pengeluaran dan pemasukan BPM KM PHB.<br>\
3.Merancang Rencana Anggaran Biaya BPM KM PHB.<br>\
#Hubungan Mahasiswa I:<br>\
1.Menyusun dan menyampaikan informasi kepada internal kampus.<br>\
2.Bertanggungjawab untuk mengatur dan menjalankan penyebaran informasi kepada pihak internal kampus.<br>\
3.Mempublikasikan informasi mengenai kegiatan dan program kerja KM PHB, serta merancang desain dan konten kreatif yang mencakup informasi <br>\tentang Badan Perwakilan Mahasiswa KM PHB.<br>\
#Hubungan Mahasiswa II:<br>\
1.Menjalin dan mengembangkan hubungan antar lembaga di luar kampus, baik secara bilateral maupun multilateral. <br>\
2.Bertanggungjawab untuk mengatur penyebaran informasi kepada pihak eksternal kampus.<br>\
3.Membantu Humas I dalam mempublikasikan informasi mengenai kegiatan dan program kerja KM PHB, serta merancang desain dan konten kreatif <br>\yang mencakup informasi tentang Badan Perwakilan Mahasiswa KM PHB.<br>\
#Ketua Komisi:<br>\
1.Bertanggung jawab atas segala hal yang berkaitan dengan komisinya.<br>\
2.Bertanggung jawab atas anggotanya dan memberikan motivasi serta arahan kepada anggotanya agar melaksanakan tugas yang ada dengan baik.<br>\
3.Merumuskan Undang-Undang bersama Badan Pengurus Harian BPM KM<br>\
PHB.<br>\
#Komisi I (Yudisial):<br>\
1.Merumuskan AD/ART BPM KM PHB.<br>\
2.Mengeluarkan Surat Keputusan untuk setiap kegiatan KM PHB.<br>\
#Komisi II (Pengawasan):<br>\
1.Membantu menindaklanjuti anggota KM PHB yang telah melakukan pelanggaran tata tertib yang telah ditentukan.<br>\
2.Mengawasi dan menilai kedisiplinan pelaksanaan program kerja yang dilaksanakan oleh Pengurus KM PHB.<br>\
3.Mengevaluasi program kerja yang telah dijalankan KM PHB.<br>\
#Komisi III (Budgeting): <br>\
1.Mengawasi alur masuk dan keluarnya anggaran yang digunakan KM PHB.<br>\
2.Mengawasi kinerja Bendahara BEM.<br>\
3.Mengawasi alur masuk dan keluarnya dana sosial serta dana denda LPJ yang       dikelola oleh Departemen Sosial dan Bendahara BEM.<br>\
#Komisi IV (Advokasi): <br>\
1.Menampung aspirasi seluruh mahasiswa Politeknik Harapan Bersama.<br>\
2.Berkoordinasi dengan Departemen Adkesma BEM KM PHB dalam menindaklanjuti aspirasi mahasiswa yang bersifat membangun.<br>\
3.Mencari informasi di internal dan di eksternal kampus.'
,'#Tugas Pokok struktural Hmp Akuntansi</br>\
#Ketua HIMAPRODI Akuntansi KM PHB :</br>\
1.Menjalankan atau memimpin rapat organisasi.</br>\
2.Menjalankan tugas menurut AD/ART HIMAPRODI Akuntansi KM PHB.</br>\
3.Memimpin dan mengkoordinasikan kegiatan HIMAPRODI Akuntansi KM PHB.</br>\
4.Memberikan laporan pertanggung jawaban diakhir periode.</br>\
#Wakil Ketua HIMAPRODI Akuntansi KM PHB :</br>\
1.Membantu Ketua dalam menjalankan organisasi.</br>\
2.Mewakili Ketua apabila yang bersangkutan berhalangan hadir.</br>\
#Sekretaris I HIMAPRODI Akuntansi KM PHB :</br>\
1.Melakukan pengarsipan dan perapihan dokumen HIMAPRODI Akuntansi KM PHB.</br>\
2.Memebuat dokumentasi hasil rapat.</br>\
3.Pembuatan dokumen-dokumen kesekretariatan.</br>\
4.Bertanggung jawab terhadap tata naskah dinas yang dibutuhkan.</br>\
5.Mengelola Inventaris penunjang organisasi.</br>\
#Sekretaris II HIMAPRODI Akuntansi KM PHB :</br>\
1.Aktif membantu pelaksanaan tugas sekretaris I</br>\
2.Menggantikan sekretaris I, jika sekretaris I berhalangan</br>\
3.Pengawas Inventaris HIMAPRODI Akuntansi KM PHB</br>\
#Bendahara I :</br>\
1.Pengelolaan keuangan HIMAPRODI Akuntansi KM PHB menjadi tanggung jawab utama.</br>\
2.Mengatur keuangan dan mengawasi arus kas masuk dan kas keluar HIMAPRODI Akuntansi KM PHB.</br>\
3.Merumuskan dan menetapkan kebijakan dibidang keuangan.</br>\
#Bendahara II  : </br>\
1.Mewakili bendahara I apabila yang bersangkutan berhalangan hadir</br>\
2.Membantu bendahara I dalam mengkoordinasikan dan menjalankan tugas menurut AD/ART HIMAPRODI Akuntansi KM PHB</br>\
#Department RnD (Research and Development Departement) :</br>\
1.Bertanggung jawab kepada Ketua HIMAPRODI Akuntansi KM PHB</br>\
2.Penanggung jawab tertinggi Research and Development Departement</br>\
3.Bertujuan untuk mengembangkan akademik mahasiswa</br>\
4.Memfasilitasi mahasiswa dalam mengembangkan akademik mahasiswa</br>\
#Department HRD (Human Resource Departement)</br>\
1.Bertanggung jawab kepada Ketua HIMAPRODI Akuntansi KM PHB</br>\
2.Penanggung jawab tertinggi Human Resource Departement</br>\
3.Menampung aspirasi mahasiswa yang bersifat membangun</br>\
4.Mengadakan diskusi rutin setelah UTS dengan PRODI Akuntansi dan komting kelas</br>\
5.Mengembangkan kompetensi mahasiswa secara aktif maupun pasif</br>\
#Department Enterpreneur (Entrepreneur Department)</br>\
1.Bertanggung jawab kepada Ketua HIMAPRODI Akuntansi KM PHB</br>\
2.Penanggung jawab tertinggi Department Entrepreneur </br>\
3.Sebagai penampung jiwa kewirausahaan mahasiswa </br>\
4.Bertanggung jawab dalam menjalankan Pojok Enterpreneur</br>\
#Department PR (Public Relation Department) :</br>\
1.Bertanggung jawab kepada Ketua HIMAPRODI Akuntansi KM PHB</br>\
2.Penanggung jawab tertinggi Public Relation Department</br>\
3.Menangani dan mengelolah kegiatan keseimbangan antara kegiatan internal dan eksternal</br>\
4.Memperkenalkan HIMAPRODI Akuntansi KM PHB secara luas di lingkungan intern maupun ekstern kampus.</br>\
#Departement MP (Media and Publication) </br>\
1.Bertanggung jawab kepada Ketua HIMAPRODI Akuntansi KM PHB</br>\
2.Penanggung jawab tertinggi Media and Publication Department</br>\
3.Bertanggung jawab dalam pengelolaan sosial media HIMAPRODI Akuntansi KM PHB</br>\
4.Bertanggung jawab dalam penerbitan (Publishing) kegiatan-kegiatan  atau hal yang terkait HIMAPRODI Akuntansi KM PHB melalui berbagai media',
'#Tugas Pokok struktural HMP ASP</br>\
#Ketua HIMAPRODI ASP :</br>\
1.Menjalankan atau memimpin rapat organisasi.</br>\
2.Menjalankan tugas menurut AD/ART HIMAPRODI ASP KM PHB.</br>\
3.Memimpin dan mengkoordinasikan kegiatan HIMAPRODI ASP KM PHB.</br>\
4.Memberikan laporan pertanggung jawaban diakhir periode.</br>\
#Wakil Ketua HIMAPRODI ASP KM PHB :</br>\
1.Membantu Ketua dalam menjalankan organisasi.</br>\
2.Mewakili Ketua apabila yang bersangkutan berhalangan hadir</br>\
#Sekretaris HIMAPRODI ASP KM PHB :</br>\
1.Melakukan pengarsipan dan perapihan dokumen HIMAPRODI ASP KM PHB.</br>\
2.Menjadi Notulensi setiap Rapat</br>\
3.Bertanggung jawab terhadap arsip-arsip</br>\
4.Menjalankan Tugas menurut AD/ART HIMAPRODI ASP KM PHB.</br>\
#Bendahara :</br>\
1.Pengelolaan keuangan HIMAPRODI ASP KM PHB menjadi tanggung jawab utama.</br>\
2.Mengatur keuangan dan mengawasi arus kas masuk dan kas keluar HIMAPRODI ASP KM PHB.</br>\
3.Merumuskan dan menetapkan kebijakan dibidang keuangan.</br>\
4.Menjalankan Tugas menurut AD/ART HIMAPRODI ASP KM PHB.</br>\
#Divisi RnD (Research and Development) :</br>\
1.Bertanggung jawab kepada Ketua HIMAPRODI ASP KM PHB</br>\
2.Penanggung jawab tertinggi Riset and Development</br>\
3.Bertujuan untuk mengembangkan akademik mahasiswa</br>\
4.Memfasilitasi mahasiswa dalam hal kelompok belajar yang diadakan</br>\
#Divisi JIK (Jaringan Informasi dan Komunikasi)</br>\
1.Bertanggung jawab kepada Ketua HIMAPRODI ASP KM PHB</br>\
2.Penanggung jawab tertinggi JIK</br>\
3.Mengembangkan komunikasi mahasiswa</br>\
4.Bertanggung jawab atas segala informasi terkait mahasiswa</br>\
#Divisi DP2M (Divisi Pengembangan Potensi Mahasiswa)</br>\
1.Bertanggung jawab kepada Ketua HIMAPRODI ASP KM PHB</br>\
2.Penanggung jawab tertinggi DP2M</br>\
3.Sebagai penampung aspirasi mahasiswa</br>\
4.Mempublikasikan informasi kegiatan dan proker HIMAPRODI ASP KM PHB',
'#Tugas Pokok Struktural HMP Dkv</br>\
#Ketua :</br>\
1.Mewakili nama Hima Prodi Desain Komunikasi Visual Politeknik Harapan Bersama Tegal dalam setiap kegiatan keorganisasian. </br>\
2.Mengangkat dan memberhentikan Pengurus Hima Prodi Desain Komunikasi Visual Politeknik Harapan Bersama Tegal.</br>\
3.Memimpin dan mengkoordinasikan kegiatan Hima Prodi Desain Komunikasi Visual Politeknik Harapan Bersama Tegal.</br>\
4.Menandatangani surat-surat, baik kedalam maupun keluar organisasi.</br>\
#Wakil Ketua :</br>\
1.Membantu ketua dalam menjalankan tugasnya.</br>\
2.Menggantikan ketua dalam menjalankan tugas bila ketua tidak hadir atau berhalangan seizin ketua.</br>\
3.Ikut aktif dalam kegiatan yang dilaksanakan oleh Hima Prodi Desain Komunikasi Visual Politeknik Harapan Bersama Tegal.</br>\
#Sekretaris :</br>\
1.Menciptakan sistem administrasi kesekretariatan yang profesional.</br>\
2.Melakukan pengarsipan dan perapihan dokumen Hima Prodi Desain Komunikasi Visual.</br>\
3.Pembuatan dokumen-dokumen kesekretariatan.</br>\
4.Bertanggung jawab terhadap tata naskah dinas yang dibutuhkan.</br>\
#Bendahara :</br>\
1.Pengelolaan keuangan Hima Prodi Desain Komunikasi Visual menjadi tanggung jawab utama.</br>\
2.Mengatur keuangan dan mengawasi arus kas masuk dan kas keluar Hima Prodi Desain Komunikasi Visual </br>\
3.Merumuskan dan menetapkan kebijakan dibidang keuangan.</br>\
4.Mengelola inventaris penunjang kegiatan Hima Prodi Desain Komunikasi Visual.</br>\
#Departemen Pengembangan Keterampilan Mahasiswa</br>\
1.Bertanggung jawab untuk mencari dan menyalurkan bakat –bakat yang ada pada mahasiswa Desain Komunikasi Visual.</br>\
2.Bertanggung jawab untuk mengembangkan minat dan bakat mahasiswa Desain Komunikasi Visual melalui pelatihan, projek, dan seminar atau webinar  yang diadakan oleh Hima Prodi Desain Komunikasi Visual bekerja sama dengan Prodi Desain Komunikasi Visual.</br>\
3.Menaungi kegiatan sosial Desain Komunikasi Visual demi terwujudnya lingkungan mahasiswa yang berdasarkan asas kemanusiaan dan beradab.</br>\
#Departemen Humas </br>\
1.Menjalin kerjasama dengan pihak internal maupun eksternal.</br>\
2.Menjadi fasilitator dengan berbagai pihak, baik lingkungan internal maupun eksternal.</br>\
3.Membangun dan menjaga kinerja yang aktif antar anggota Hima Prodi Desain Komunikasi Visual.</br>\
4.Menjalin bidang humas dalam setiap kegiatan yang diselenggarakan atau dinaungi oleh Hima Prodi Desain Komuniksi Visual.</br>\
#Departemen Komunikasi dan Informasi</br>\
Bertanggung jawab untuk menjalin komunikasi dan menyebarkan informasi kearah internal dan eksternal yaitu menyebarkan informasi yang bisa diterima didalam lingkup mahasiswa Desain Komunikasi Visual dan Non Desain Komunikasi Visual serta masyarakat luas.</br>\
#Departemen Konten Kreatif</br>\
1.Menulis, meninjau, mengedit, dan membuat konten untuk platform yang digunakan oleh Hima Prodi Desain Komunikasi Visual</br>\
2.Melakukan riset dan interview untuk mempelajari tren terkini serta dalam pengembangan konten.</br>\
3.Bekerja sama dengan departemen komunikasi dan informasi untuk mempersiapkan materi konten.',
'#Tugas Pokok Struktural HMP Elektro</br>\
#Ketua:</br>\
1.Mengkoordinasikan, merencanakan, menggerakan dan mengawasi kegiatan HIMAPRODI ELEKTRONIKA KM PHB.</br>\
2.Bertanggung jawab atas kegiatan yang dilaksanakan.</br>\
3.Berkoordinasi dengan Bidang Kemahasiswaan Program Studi DIII Teknik Elektronika.</br>\
4.Memberikan laporan pertanggungjawaban di akhir periode.</br>\
#Sekretaris :</br>\
1.Menciptakan sistem administrasi kesekretariatan yang baik dan sesuai SOP.</br>\
2.Melakukan Pengarsipan dan mengelola dokumen HIMAPRODI ELEKTRONIKA KM PHB.</br>\
3.Pendokumentasian hasil rapat.</br>\
4.Pembuatan dokumen-dokumen kesekretariatan.</br>\
5.Bertanggung jawab terhadap tata naskah dinas yang dibutuhkan.</br>\
#Bendahara :</br>\
1.Pengelolaan keuangan HIMAPRODI ELEKTRONIKA KM PHB menjadi tanggung jawab utama.</br>\
2.Membukukan segala pengeluaran, menerima dan mencatat tanggal uang masuk beserta jumlah dana.</br>\
3.Menyediakan nota masuk dan meminta nota pembelian atas keuangan dana.</br>\
4.Meminta persetujuan ketua sebelum mengeluarkan uang dan berkoordinasi dengan semua anggota.</br>\
#Divisi Pengembangan Minat Bakat :</br>\
1.Menyelenggarakan kegiatan dalam bidang akademik, seni, dan olahraga untuk meningkatkan potensi mahasiswa.</br>\
2.Bertanggung jawab terhadap segala bentuk pengembangan minat dan bakat mahasiswa.</br>\
3.Berkoordinasi dengan ketua HIMAPRODI ELEKTRONIKA KM PHB</br>\
#Divisi Social :</br>\
1.Menjalin hubungan baik dalam kehidupan bermasyarakat.</br>\
2.Menumbuhkan rasa kemanusiaan terhadap sesama.</br>\
3.Sebagai media untuk memberikan bantuan kepada sesama.</br>\
#Divisi Humas  :</br>\
1.Menjalin hubungan baik dengan mahasiswa, civitas akademika, dan pihak-pihak yang terkait dengan HIMAPRODI ELEKTRONIKA KM PHB.</br>\
2.Mencari pengetahuan baru dan menerapkannya di dalam organisasi.</br>\
3.Bekerja sama dengan lembaga eksternal demi meningkatkan kompetensi anggota HIMAPRODI ELEKTRONIKA KM PHB.</br>\
#Divisi Publikasi :</br>\
1.Membuat dan mengelola konten sosial media HIMAPRODI ELEKTRONIKA KM PHB.</br>\
2.Mendokumentasikan semua kegiatan yang dilaksanakan HIMAPRODI ELEKTRONIKA KM PHB.</br>\
#Divisi Kewirausahaan :</br>\
1.Melakukan kegiatan kewirausahaan dalam lingkungan Program Studi Teknik Elektronika secara kreatif dan inovatif.</br>\
2.Menggerakkan kemandirian pengurus dan anggota HIMAPRODI ELEKTRONIKA KM PHB melalui edukasi mengenai peluang usaha kreatif dan inovatif.',
'#Tugas Pokok Struktural HMP Farmasi</br>\
#Ketua HIMAPRODI FARMASI :</br>\
1.Pemegang dan pengambil kebijakan umum organisasi.</br>\
2.Bertanggung jawab atas semua kegiatan dan program kerja organisasi.</br>\
3.Menyampaikan informasi internal dan eksternal kampus.</br>\
4.Menjalin komunikasi baik antar anggota.</br>\
5.Membantu anggota yang mengalami kesulitan dalam mengerjakan tugasnya.</br>\
#Wakil Ketua HIMAPRODI FARMASI :</br>\
1.Membantu dan mendampingi Ketua dalam menjalankan organisasi</br>\
2.Mewakili tugas-tugas Ketua HIMAPRODI FARMASI KM PHB apabila berhalangan</br>\
3.Memfokuskan tugas-tugas dan kegiatan yang ada di internal HIMAPRODI FARMASI KM PHB.</br>\
4.Bertanggung jawab kepada Ketua HIMAPRODI FARMASI KM PHB</br>\
#Sekretaris HIMAPRODI FARMASI :</br>\
1.Membuat Proposal dan Laporan Pertanggungjawaban serta mencatat hasil kerja/diskusi setiap rapat.</br>\
2.Membuat/mengadakan, mengelola dan mendeskripsikan berkas-berkas dan hal-hal yang berkaitan dengan HIMAPRODI FARMASI KM PHB.</br>\
3.Membantu dan mendampingi Ketua dalam menjalankan organisasi.</br>\
4.Bertanggung jawab terhadap Ketua HIMAPRODI FARMASI KM PHB.</br>\
#Bendahara HIMAPRODI FARMASI :</br>\
1.Pemegang kebijakan umum dalam pengelolaan keuangan organisasi.</br>\
2.Mencatat, menyimpan, dan mengatur keuangan organisasi.</br>\
3.Membantu dan mendampingi Ketua/Wakil Ketua dalam menjalankan organisasi.</br>\
4.Bertanggung jawab kepada Ketua HIMAPRODI FARMASI KM PHB.</br>\
#Divisi Humas HIMAPRODI FARMASI :</br>\
1.Memberikan informasi tentang perkembangan organisasi/program kerja yang ada di internal HIMAPRODI FARMASI KM PHB.</br>\
2.Tim pembuka dalam mengadakan hubungan kerja sama dengan organisasi lain.</br>\
3.Mengumpulkan	dan	menyampaikan	informasi	demi	kepentingan	organisasi HIMAPRODI FARMASI KM PHB.</br>\
4.Memberikan surat-surat/undangan mengenai program kerja/agenda HIMAPRODI FARMASI KM PHB kepada organisasi/pihak lainnya.</br>\
#Divisi Kominfo HIMAPRODI FARMASI :</br>\
1.Penampung serta penyalur berbagai aspirasi dan informasi yang berhubungan dengan kegiatan organisasi HIMAPRODI FARMASI KM PHB.</br>\
2.Bertanggung jawab atas dokumentasi foto dan dokumentasi video dari seluruh kegiatan HIMAPRODI FARMASI KM PHB selama periode kepengurusan.</br>\
3.Memfasilitasi divisi lain untuk mempublikasikan atau menyampaikan informasi terkait aktivitas yang bersangkutan.</br>\
#Divisi Kekeluargaan HIMAPRODI FARMASI :</br>\
1.Mengendalikan organisasi dalam pelaksanaan seluruh program kerja HIMAPRODI FARMASI KM PHB.</br>\
2.Menata dan menjalin komunikasi yang baik agar terjalin hubungan yang harmonis antar anggota farmasi.</br>\
3.Bekerja sama antardivisi HIMAPRODI FARMASI KM PHB.</br>\
#Divisi Minat Bakat HIMAPRODI FARMASI :</br>\
1.Bertanggungjawab terhadap penyaluran informasi terkait pengembangan minat dan bakat mahasiswa Prodi Farmasi.</br>\
2.Membantu mahasiswa Prodi Farmasi dalam pengembangan wawasan dan 3.keterampilan di bidang akademik maupun non akademik.',
'#Tugas Pokok Struktural HMP Kebidanan</br>\
#Ketua</br>\
1.Merencanakan, mengorganisasikan, dan mengawasi.</br>\
2.Bertanggung jawab atas kegiatan yang dilaksanakan.</br>\
3.Menyusun organisasi dan pengarahan organisasi.</br>\
#Wakil</br>\
1.Membantu ketua HIMA PRODI KEBIDANAN KMP HB dalam menjalankan tugasnya.</br>\
#Sekretaris</br>\
1.Bertanggung jawab atas kesekretariatan administrasi HIMAPRODI KEBIDANAN KM PHB.</br>\
2.Pendokumentasian hasil rapat.</br>\
3.Bertanggung jawab pada tata naskah Dinas yang dibutuhkan.</br>\
4.Mengelola inventaris penunjang organisasi.</br>\
#BENDAHARA I</br>\
1.Mengelola keuangan. </br>\
2.Membuat laporan keluar masuk keuangan.</br>\
#BENDAHARA II</br>\
1.Membantu tugas bendahara I.</br>\
#DIVISI HUMAS</br>\
1.Bertanggung jawab kepada Ketua HIMAPRODI KEBIDANAN KM PHB.</br>\
2.Menjembatani dan menjalin kerja sama antara Pengurus dengan Anggota, Lembaga, dan Organisasi Kemahasiswaan lain baik di dalam maupun di luar kampus.</br>\
3.Membuat suatu publikasi dan dokumentasi. </br>\
#DIVISI SOSIAL</br>\
1.Bertanggung jawab kepada Ketua HIMAPRODI KEBIDANAN KM PHB.</br>\
2.Menjalin hubungan baik dengan masyarakat dan mewujudkan mahasiswa yang mampu berperan aktif dan berwawasan luas dalam hal pengabdian masyarakat.</br>\
3.Membukukan segala pengeluaran,menerima,dan mencatat tanggal uang masuk beserta jumlah dana.</br>\
#DIVISI KEWIRAUSAHAAN</br>\
1.Bertanggung jawab kepada Ketua HIMAPRODI KEBIDANAN KM PHB.</br>\
2.Bertanggung jawab dalam hal pencarian sumber pemasukan dan pengelolaan keuangan untuk mewujudkan kemandirian dan kesejahteraan HIMAPRODI KEBIDANAN KM PHB.</br>\
3.Bertanggung jawab dalam pengembangan kreatifitas dalam bidang kewirausahaan.</br>\
4.Menjalankan tugas sesuai AD/ART HIMAPRODI KEBIDANAN KM PHB.</br>\
#DIVISI KOMUNIKASI DAN INFORMASI</br>\
1.Bertanggung jawab kepada Ketua HIMAPRODI KEBIDANAN KM PHB.</br>\
2.Melaksanakan mekanisme serta pengawasan penyaluran informasi HIMAPRODI KEBIDANAN KM PHB.</br>\
3.Ikut serta dalam menyukseskan penerimaan mahasiswa baru.</br>\
4.Sebagai sarana memberikan informasi kepada mahasiswa mengenai kegiatan HIMAPRODI KEBIDANAN KM PHB dengan cara langsung ataupun melalui Media Sosial.</br>\
#DIVISI MINAT & BAKAT</br>\
1.Bertanggung jawab kepada Ketua HIMAPRODI KEBIDANAN KM PHB.</br>\
2.Mengembangkan dan menyalurkan minat dan bakat mahasiswa HIMAPRODI KEBIDANAN KM PHB di bidang Akademik dan non akademik.</br>\
3.Menjalankan tugas sesuai AD/ART HIMAPRODI KEBIDANAN KM PHB.'
,
'#Tugas Pokok Struktural HMP Komputer</br>\
#Ketua HIMAPRODI KOMPUTER :</br>\
1.Menjalankan atau memimpin rapat organisasi.</br>\
2.Memimpin dan mengoordinasikan kegiatan HIMAPRODI KOMPUTER KM PHB.</br>\
3.Berkoordinasi dengan Bidang Kemahasiswaan Program Studi DIII Teknik Komputer.</br>\
4.Memberikan laporan pertanggung jawaban di akhir periode.</br>\
5.Mengangkat dan memberhentikan anggota HIMAPRODI KOMPUTER KM PHB.</br>\
6.Menjalankan tugas menurut AD / ART HIMAPRODI KOMPUTER KM PHB.</br>\
#Wakil Ketua HIMAPRODI KOMPUTER :</br>\
1.Membantu ketua HIMAPRODI KOMPUTER KM PHB dalam menjalankan tugasnya.</br>\
2.Menjalankan tugas-tugas ketua HIMAPRODI KOMPUTER KM PHB bila tidak hadir atau berhalangan.</br>\
3.Menjalankan tugas menurut AD / ART HIMAPRODI KOMPUTER KM PHB.</br>\
#Sekretaris:</br>\
1.Menciptakan sistem administrasi kesekretariatan yang baik dan sesuai.</br>\
2.Melakukan pengarsipan dan mengelola dokumen HIMAPRODI KOMPUTER KM PHB.</br>\
3.Pendokumentasian hasil rapat.</br>\
4.Pembuatan dokumen-dokumen kesekretariatan.</br>\
#Bendahara:</br>\
1.Pengelolaan keuangan HIMAPRODI KOMPUTER KM PHB menjadi tanggung jawab utama.</br>\
2.Mengatur keuangan dan mengawasi arus kas masuk dan kas keluar HIMAPRODI KOMPUTER KM PHB.</br>\
3.Merumuskan dan menetapkan kebijakan di bidang keuangan.</br>\
4.Bertanggung jawab terhadap fondasi ekonomi organisasi.</br>\
#Divisi Akademik:</br>\
1.Bertanggung jawab terhadap segala kegiatan yang terkait dengan peningkatan kompetensi akademis Mahasiswa Program Studi DIII Teknik Komputer.</br>\
2.Menciptakan sistem pelatihan yang dilakukan oleh HIMAPRODI KOMPUTER KM PHB.</br>\
3.Menjalin hubungan baik dengan Bagian Akademik Program Studi DIII Teknik Komputer dan Wakil Direktur I Bagian Akademik.</br>\
#Divisi Kerumahtanggaan:</br>\
1.Mengelola dan bertanggung jawab terhadap kebutuhan kerumahtanggaan HIMAPRODI KOMPUTER KM PHB.</br>\
2.Menjalin hubungan kekeluargaan baik dengan seluruh anggota aktif, anggota biasa dan demisioner HIMAPRODI KOMPUTER KM PHB.</br>\
3.Melaksanakan mekanisme serta pengawasan dalam lingkup keanggotaan HIMAPRODI KOMPUTER KM PHB.</br>\
#Divisi Humas:</br>\
1.Menjalin hubungan baik dengan mahasiswa, pengurus Program Studi DIII Teknik Komputer dan pihak-pihak yang terkait dengan HIMAPRODI KOMPUTER KM PHB.</br>\
2.Menampung dan menindaklanjuti aspirasi mahasiswa Program Studi DIII Teknik Komputer.</br>\
3.Membantu pelaksanaan program kerja HIMAPRODI KOMPUTER KM PHB untuk mengoordinir tiap kelas.</br>\
#Divisi Jurnalistik:</br>\
1.Membuat dan mengelola konten sosial media HIMAPRODI KOMPUTER KM PHB.</br>\
2.Sebagai sarana memberikan informasi tentang kegiatan yang dilaksanakan oleh HIMAPRODI KOMPUTER KM PHB secara langsung ataupun melalui media sosial.</br>\
3.Melaksanakan mekanisme serta pengawasan penyaluran informasi HIMAPRODI KOMPUTER KM PHB.',
'#Tugas pokok struktural HMP MESIN<br>\
#Ketua<br>\
1.Mewakili nama HIMAPRODI Teknik Mesin Politeknik Harapan Bersama Tegal dalam setiap kegiatan keorganisasian.<br>\
2.Menentukan kebijakan organisasi dengan tepat berdasarkan AD / ART HimaProdi Teknik Mesin Politeknik Harapan Bersama Tegal.<br>\
3.Mengangkat dan memberhentikan Pengurus HIMAPRODI Teknik Mesin Politeknik Harapan Bersama Tegal.<br>\
4.Memimpin dan mengkoordinasikan kegiatan HIMAPRODI Teknik Mesin Politeknik Harapan Bersama Tegal.<br>\
#Wakil ketua<br>\
1.Membantu ketua dalam menjalankan tugasnya.<br>\
2.Menjalankan tugas – tugas ketua bila ketua tidak hadir atau berhalangan.<br>\
3.Menandatangani surat – surat baik di internal maupun eksternal organisasi bila ketua berhalangan hadir dengan seizin Ketua.<br>\
4.Ikut aktif dalam kegiatan yang dilaksanakan oleh HIMAPRODI Teknik Mesin Politeknik Harapan Bersama Tegal.<br>\
5.Menjalankan tugas menurut AD / ART HIMAPRODI Teknik Mesin Politeknik Harapan Bersama Tegal.<br>\
#Sekretaris<br>\
1.Membantu ketua dalam menertibkan administrasi organisasi.<br>\
2.Mempertanggungjawabkan segala kegiatan yang telah dilaksanakan kepada ketua.<br>\
3.Mengatur, menertibkan dan merawat inventaris dan aset organisasi.<br>\
4.Melaksanakan	pengumpulan, pencatatan,	pengelolaan,	penyusunan,<br>\
pemeliharaan dokumen, hasil laporan dan bahan – bahan yang berkenaan data intern dan ekstern organisasi.<br>\
#Bendahara<br>\
1.Meminta pertanggungjawaban keuangan organisasi dari kepanitiaan yang melaksanakan kegiatan organisasi.<br>\
2.Menandatangani surat – surat yang berkenaan dengan kebendaharaan organisasi.<br>\
Mengatur dan mendata pemasukan serta pengeluaran organisasi.<br>\
3.Ikut aktif dalam kegiatan yang dilaksanakan oleh HIMAPRODI Teknik Mesin Politeknik Harapan Bersama Tegal.<br>\
#Divisi Minat Bakat<br>\
Bertanggung jawab untuk mencari dan menyalurkan bakat – bakat yang ada pada mahasiswa mesin.<br>\
#Divisi Kewirausahaan<br>\
Bertanggung jawab membangun dan mengembangkan saran kewirausahaan yang akan diadakan maupun yang sudah diadakan dalam program kerja HIMAPRODI Teknik Mesin.<br>\
#Divisi Media Komunikasi dan Informasi<br>\
Bertanggung jawab di bagian publikasi segala informasi dan dokumentasi atas kegiatan yang akan dilakukan oleh Himpunan.<br>\
#Divisi Pengembangan Sumber Daya Manusia<br>\
Bertanggung jawab di bagian pengembangan kemampuan mahasiswa dalam bidang akademik maupun non akademik.<br>\
#Humas<br>\
1.Menyebarkan informasi secara cepat, tepat dan akurat kepada pihak internal maupun eksternal.<br>\
2.Menciptakan suasana harmonis dengan seluruh pihak prodi, ormawa dan perguruan tinggi lainnya.<br>\
3.Menjadi mediator dan fasilitator bagi mahasiswa mesin yang berhubungan dengan akademik dan himpunan.',
'#Tugas Pokok HMP Perhotelan<br>\
#Ketua HIMAPRODI Perhotelan <br>\
1.Merencanakan, mengorganisir, dan mengkoordinasikan berbagai acara dan kegiatan himpunan, seperti seminar, workshop, atau kegiatan social.<br>\
2.Memimpin rapat-rapat himpunan untuk membahas agenda, evaluasi kegiatan, dan perencanaan program ke depan.<br>\
3.Menjaga dan memelihara tradisi serta identitas himpunan agar tetap konsisten dengan visi, misi, dan nilai-nilai himpunan.<br>\
#Sekretaris HIMAPRODI Perhotelan<br>\
1.Menangani surat-menyurat yang berkaitan dengan kegiatan himpunan, termasuk surat permohonan kerjasama, undangan, dan surat resmi lainnya.<br>\
2.Menyusun laporan berkala tentang kegiatan. <br>\
3.Merapikan dan menyimpan arsip kegiatan himpunan agar mudah diakses di masa mendatang.<br>\
#Bendahara HIMAPRODI Perhotelan <br>\
1.Mengelola dan mencatat semua transaksi keuangan HIMAPRODI Perhotelan KM PHB.<br>\
2.Menyusun dan mengelola anggaran HIMAPRODI Perhotelan KM PHB.<br>\
3.Mengajukan proposal pendanaan dan mencari sumber pendanaan tambahan jika diperlukan.<br>\
4.Memastikan semua kegiatan keuangan dilakukan dengan akuntabilitas dan transparansi.<br>\
#Divisi Humas Internal & Eksternal HIMAPRODI Perhotelan<br>\
1.Membina hubungan baik antara anggota himpunan HIMAPRODI Perhotelan KM PHB.<br>\
2.Berkoordinasi dengan divisi/divisi lain di dalam himpunan untuk keberlanjutan kegiatan dan program.<br>\
3.Bekerjasama dengan bidang kemahasisawaan Program Studi Perhotelan dalam berbagai hal yang berkaitan dengan mahsisawa HIMAPRODI Perhotelan KM PHB.<br>\
4.Memastikan anggota HIMAPRODI Perhotelan KM PHB mematuhi etika dan norma yang berlaku.<br>\
#Divisi Pengabdian Masyarakat HIMAPRODI Perhotelan<br>\
1.Menyelenggarakan atau mengikuti kegiatan-kegiatan sosial, seperti bakti sosial, pelatihan ketrampilan, atau workshop yang dapat membantu masyarakat sekitar.<br>\
2.Menyebarkan informasi terkait program pengabdian masyarakat kepada mahasiswa program studi perhotelan.<br>\
#Divisi Enterpreneur atau Kewirausahaan HIMAPRODI Perhotelan<br>\
1.Menyusun rencana bisnis untuk kegiatan atau proyek kewirausahaan yang akan dilakukan oleh anggota HIMAPRODI Perhotelan KM PHB.<br>\
2.Melakukan riset pasar untuk memahami tren industri perhotelan dan potensi peluang bisnis.<br>\
3.Mengelola anggaran keuangan untuk kegiatan kewirausahaan HIMAPRODI Perhotelan KM PHB.<br>\
#Divisi Kominfo (Kominikasi dan Informasi) HIMAPRODI Perhotelan<br>\
1.Mengelola akun media sosial himpunan untuk mempromosikan kegiatan dan informasi terkini.<br>\
2.Memastikan konten yang dibagikan relevan dan menarik bagi anggota serta masyarakat umum.<br>\
3.Merancang dan membuat materi promosi, seperti poster, brosur, dan flyer untuk memasarkan kegiatan himpunan.<br>\
4.Menyusun teks dan konten yang efektif untuk promosi online dan offline.<br>\
#Divisi Prestasi dan akademik HIMAPRODI Perhotelan<br>\
1.Mengorganisir kompetisi atau event akademik yang bertujuan untuk meningkatkan keterampilan dan pengetahuan mahasiswa di bidang perhotelan.<br>\
2.Mencari informasi mengetahui perlombaan atau event yang berkaitan dengan bidang akademik Program studi perhotelan.'
,'#Tugas Pokok HMP Teknik Informatika<br>\
#Ketua HIMAPRODI TI<br>\
1.Menjalankan atau memimpin rapat organisasi.<br>\
2.Memimpin dan mengkoordinasikan kegiatan HIMAPRODI TI KM PHB.<br>\
3.Memberikan laporan pertanggung jawaban di akhir periode.<br>\
4.Menjalankan tugas menurut AD/ART HIMAPRODI TI KM PHB<br>\
#Wakil Ketua HIMAPRODI TI<br>\
1.Membantu Ketua dalam menjalankan tugasnya.<br>\
2.Menjalankan tugas-tugas ketua apabila ketua tidak hadir atau berhalangan.<br>\
3.Menjalankan tugas menurut AD/ART HIMAPRODI TI KM PHB.<br>\
#Sekretaris <br>\
1.Menciptakan sistem administrasi kesekretariatan yang profesional.<br>\
2.Melakukan pengarsipan dan perapihan dokumen HIMAPRODI TI KM PHB.<br>\
3.Mendokumentasikan hasil rapat.<br>\
4.Pembuatan dokumen-dokumen kesekretariatan.<br>\
5.Bertanggung jawab terhadap tata naskah dinas yang dibutuhkan.<br>\
6.Mengelola inventaris penunjang organisasi.<br>\
#Bendahara<br>\
1.Pengelolaan keuangan HIMAPRODI TI KM PHB menjadi tanggung jawab utama.<br>\
2.Mengatur keuangan dan mengawasi arus kas masuk dan kas keluar HIMAPRODI TI KM PHB.<br>\
3.Merumuskan dan menetapkan kebijakan dibidang keuangan.<br>\
#Divisi Humas Internal <br>\
1.Membantu ketua dalam melaksanakan program kerja HIMAPRODI TI KM PHB.<br>\
2.Melaksanakan	mekanisme	serta	pengawasan	penyaluran	informasi HIMAPRODI TI KM PHB.<br>\
3.Menjalin hubungan baik dengan pihak-pihak yang terkait dengan HIMAPRODI TI KM PHB dalam lingkup internal institusi.<br>\
#Divisi Humas Eksternal <br>\
1.Membantu ketua dalam melaksanakan program kerja HIMAPRODI TI KM PHB.<br>\
2.Melaksanakan	mekanisme	serta	pengawasan	penyaluran	informasi HIMAPRODI TI KM PHB.<br>\
3.Terlibat dalam kegiatan dan acara di luar HIMAPRODI TI KM PHB, seperti festival, pameran, atau kegiatan sosial.<br>\
#Divisi Akademik <br>\
1.Membantu ketua dalam melaksanakan program kerja HIMAPRODI TI KM PHB.<br>\
2.Membantu menjalankan program kerja di bidang akademik.<br>\
3.Sarana dalam peningkatan mutu akademik mahasiswa.<br>\
#Divisi Kominfo (Komunikasi dan Informasi)<br>\
1.Membantu ketua dalam melaksanakan program kerja HIMAPRODI TI KM PHB.<br>\
2.Mengelola informasi intern dan ekstern dengan baik dan profesional baik melalui media sosial maupun media elektronik.<br>\
3.Mengembangkan sistem informasi agar tepat guna dan manfaat.<br>\
#Divisi Sosial<br>\
1.Membantu ketua dalam melaksanakan program kerja HIMAPRODI TI KM PHB.<br>\
2.Mengelola Dana Sosial.<br>\
3.Menjalankan tugas menurut AD/ART HIMAPRODI TI KM PHB<br>\
#Divisi Kekeluargaan <br>\
1.Membantu ketua dalam melaksanakan program kerja HIMAPRODI TI KM PHB.<br>\
2.Mengakrabkan seluruh anggota HIMAPRODI TI KM PHB baik anggota aktif maupun anggota pasif.<br>\
3.Menampung aspirasi demi menjaga kesejahteraan seluruh mahasiswa Program Studi Sarjana Terapan Teknik Informatika PHB.<br>\
4.Menjalankan tugas menurut AD/ART HIMAPRODI TI KM PHB.'];


answers['pengertian'] = 'Menurut Prof. Dr. Sondang P. Siagian, organisasi adalah suatu bentuk persekutuan antara dua orang atau lebih yang bekerja bersama serta secara formal terikat dalam rangka pencapaian tujuan yang telah ditentukan dan dalam ikatan itu terdapat seorang atau sekelompok orang yang disebut bawahan.';
answers['daftar'] = 'untuk mendaftar sebagai  anggota baru, kamu bisa klik <a href="/register" class="linkDaftar">di sini</a>';
answers['regist'] = 'untuk mendaftar sebagai  anggota baru, kamu bisa klik <a href="/register" class="linkDaftar">di sini</a>';
answers['tujuan'] = 'Tujuan dibentuknya organisasi secara umum antara lain meningkatkan kemandirian, merealisasikan keinginan dan cita-cita bersama, memperoleh keuntungan atau penghasilan bersama, meningkatkan pengalaman serta interaksi dengan anggota lainnya, memperoleh pengakuan serta penghargaan, hingga mengatasi keterbatasan kemampuan guna meraih tujuan bersama.';
const defaultAnswer = 'Maaf, untuk saat ini kami belum bisa menjawab pertanyaan itu, silahkan bertanya kembali seputar organisasi 🙌';
let userMessage;


const createChatLi = (message, className) => {
    const chatLi = document.createElement('li');
    chatLi.classList.add('chat', className);
    let chatContent = className === 'outgoing' ? `<p>${message}</p>` : `<span class="material-symbols-outlined">smart_toy</span><p>${message}</p>`;
    chatLi.innerHTML = chatContent;
    return chatLi;
};
function linkDaftar() {
    document.body.classList.remove('show-chatbot');
}
 
const moveDown = chatBox.scrollTo(0, chatBox.scrollHeight);

const handleChat = () => {
    userMessage = chatInput.value.trim();
    let keywords = ['visi','misi','pengertian', 'ciri', 'tujuan','daftar','regist', 'struktur','tugas','ketua'];
    let keywordOrgs = ['bem','bpm','akuntansi', 'asp', 'dkv', 'elektro','farmasi', 'kebidanan', 'komputer', 'mesin', 'perhotelan', 'informatika'];
    let isKeywordExist = false;
    let isUndefined = true;
    if(!userMessage) return;
   

    chatBox.appendChild(createChatLi(userMessage, "outgoing"));
    moveDown;

    keywords.forEach((k)=> {
        if (userMessage.toLowerCase().includes(k)){
                keywordOrgs.forEach((org)=> {
                    let index = keywordOrgs.indexOf(org)
                if (userMessage.toLowerCase().includes(org)) {
                    if (answers[k][index] !== undefined) { 

                        setTimeout(()=> {
                          chatBox.appendChild(createChatLi(answers[k][index], "incoming"));
                          chatBox.scrollTo(0, chatBox.scrollHeight);
                          isKeywordExist = true;
                        },600)
                    } else {
                        isUndefined = false;

                    }

                } 
                
            }) 
                setTimeout(()=>{
                    if(!isKeywordExist) {
                        if(isUndefined) {
                            chatBox.appendChild(createChatLi(answers[k], "incoming"));
                            chatBox.scrollTo(0, chatBox.scrollHeight);
                            isKeywordExist = true;
                            
                        } else {
                           
                            chatBox.appendChild(createChatLi(`maaf ${k} untuk organisasi tersebut belum ada`, "incoming"));
                          chatBox.scrollTo(0, chatBox.scrollHeight);
                          isKeywordExist = true;
                        }
                        
                    } 
                }, 700)
            } 
                
            
                
            
     
    })

    setTimeout(()=> {
        if (!isKeywordExist) {
        chatBox.appendChild(createChatLi(defaultAnswer, "incoming"));
        chatBox.scrollTo(0, chatBox.scrollHeight);
        isKeywordExist = false;
        }
      },1000)
    

    
    chatBox.scrollTo(0, chatBox.scrollHeight);
    chatInput.value = '';
    
};

senderChat.addEventListener('click', handleChat);


