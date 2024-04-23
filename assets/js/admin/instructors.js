// ---------------------------   Datalist   ---------------------------
document.addEventListener('DOMContentLoaded', function() {
    const inputElement = document.getElementById('search');
    inputElement.addEventListener('input', function() {
        if (this.value.length > 0) {
            this.setAttribute('list', 'people');
        } else {
            this.removeAttribute('list');
        }
    });
});

// -------------------   Окрашивание 'Статуса' и 'Аттестации'   -------------------
document.addEventListener("DOMContentLoaded", function() {
    let statusCells = document.getElementsByClassName("colors");
    
    for (let cell of statusCells) {
        let status = cell.textContent;
        
        if (status === "Пройдена") {
            cell.style.color = "#44944A";
        } else if (status === "Не пройдена") {
            cell.style.color = "#E32636";
        } else if (status === "Пройдена частично") {
            cell.style.color = "#F4A900";
        } else if (status === "Основной состав") {
            cell.style.color = "#44944A";
        } else if (status === "Запасной состав") {
            cell.style.color = "#E32636";
        } else if (status === "Стажировка") {
            cell.style.color = "#F4A900";
        } else if (status === "Старший инструктор") {
            cell.style.color = "#6A5ACD";
        } 
    }
});

// --------------------------   Phone Mask   --------------------------
const element = document.getElementById('exampleInputTel');
const maskOptions = {
  mask: '+{7}(000)000-00-00'
};
const mask = IMask(element, maskOptions);

// ---------------------------   Password   ---------------------------
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#exampleInputPassword');

togglePassword.addEventListener('click', function (e) {
  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', type);
  this.classList.toggle('bi-eye');
});

// ----------------------------   Select   ----------------------------
$( document ).ready(function() {
    $( '#single-select-status' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
        minimumResultsForSearch : Infinity,
    });

    $( '#single-select-certification' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
        minimumResultsForSearch : Infinity,
    });
});
