// sidebar toogle
// const links = document.querySelectorAll('.link-bar li');
// const main_contents = document.querySelectorAll('.container-content .d-flex');
// const tambah = document.querySelectorAll('.addButton');
// // kegiatan.onClick = alert('hai')
// links.forEach((link) => {
//     link.addEventListener('click', () => {
//         links.forEach(link => link.classList.remove('active'));
//         link.classList.add('active');
//         let nav = link.dataset.name;
//         main_contents.forEach(main => {main.classList.remove('active')});
//         // document.querySelector(`#tambah-${nav}`).style.display = 'none';
//         tambah.forEach((add) => {
//             let plus = add.dataset.name;
//             document.querySelector(`#tambah-${plus}`).style.display = 'none';
//             // document.querySelector(`#tambah-${plus}`).classList.remove('active');
//         })
//         document.querySelector(`.container-${nav}`).classList.add('active');
        

//     })
// })
// tambahUser.addEventListener('click', ()=> {
//     main_contents.forEach(main => {main.classList.remove('active')});
//     document.querySelector(`.container-addUser`).classList.add('active');

// })
tambah.forEach((add) => {
    add.addEventListener('click', ()=> {    
    let plus = add.dataset.name;
    main_contents.forEach(main => {main.classList.remove('active')});
    document.querySelector(`#tambah-${plus}`).style.display = 'flex';
    })
    
})

//  {{-- update --}}
// cek kekuatan password
let password = document.getElementById("password");
let power = document.getElementById("power-point");
password.oninput = function () {
    let point = 0;
    let value = password.value;
    let widthPower = 
        ["Sangat Lemah", "Lemah", "Cukup", "Kuat", "Sangat Kuat"];
    let colorPower = 
        ["#D73F40", "#DC6551", "#F2B84F", "#BDE952", "#3ba62f"];

    if (value.length >= 6) {
        let arrayTest = 
            [/[0-9]/, /[a-z]/, /[A-Z]/, /[^0-9a-zA-Z]/];
        arrayTest.forEach((item) => {
            if (item.test(value)) {
                point += 1;
            }
        });
    }
    power.textContent = widthPower[point];
    power.style.color = colorPower[point];
};
let flyouts = document.querySelectorAll('.flyout'); 
    function toggleFlyout(event) {  
        // Mencegah klik pada tombol dari propagasi ke elemen lain   
        event.stopPropagation();  

        // Mendapatkan elemen flyout yang bersangkutan  
        let flyout = event.target.nextElementSibling;  

        // Toggle visibilitas flyout  
        if (flyout.style.display === "none" || flyout.style.display === "") {  
            // flyouts.forEach(function(fly) {  
            //     fly.style.display = 'none';  
            // });  
            flyout.style.display = "block";  
            
        } else {  
            flyout.style.display = "none";  
        }  
    }  

    // Menutup flyout ketika mengklik di luar tombol  
    document.addEventListener('click', function() {  
        flyouts.forEach(function(flyout) {  
            flyout.style.display = 'none';  
        });  
    });


   
   


    