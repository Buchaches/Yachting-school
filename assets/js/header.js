// ---------------------------   Hamburger Menu   ---------------------------
const nav = document.querySelector('#nav');
const navBtn = document.querySelector('#nav-btn');
const navBtnImg = document.querySelector('#nav-btn-img');

navBtn.onclick = () => {
  if(nav.classList.toggle('open')){
    navBtnImg.src = "./assets/img/icon/header_menu/nav-close.svg"
  } else {
    navBtnImg.src = "./assets/img/icon/header_menu/nav-open.svg"
  }
}

// ----------------------------   DropDownMenu   ----------------------------
function toggleMenu() {
  var menu = document.getElementById("dropdownMenu");
  var menuButton = document.getElementById("menuButton");

  if (menu.style.display === "none" || menu.style.display === "") {
    menu.style.display = "block";
    document.addEventListener("click", closeMenuOnOutsideClick);
  } else {
    menu.style.display = "none";
    document.removeEventListener("click", closeMenuOnOutsideClick);
  }

  function closeMenuOnOutsideClick(event) {
    if (!menu.contains(event.target) && event.target !== menuButton) {
      menu.style.display = "none";
      document.removeEventListener("click", closeMenuOnOutsideClick);
    }
  }
}
