const links = document.querySelectorAll('.link-bar li');
const main_contents = document.querySelectorAll('.container-content .d-flex');
const tambah = document.querySelectorAll('.addButton');
// kegiatan.onClick = alert('hai')
links.forEach((link) => {
    link.addEventListener('click', () => {
        links.forEach(link => link.classList.remove('active'));
        link.classList.add('active');
        let nav = link.dataset.name;
        main_contents.forEach(main => {main.classList.remove('active')});
        // document.querySelector(`#tambah-${nav}`).style.display = 'none';
        tambah.forEach((add) => {
            let plus = add.dataset.name;
            document.querySelector(`#tambah-${plus}`).style.display = 'none';
            // document.querySelector(`#tambah-${plus}`).classList.remove('active');
        })
        document.querySelector(`.container-${nav}`).classList.add('active');
        

    })
})