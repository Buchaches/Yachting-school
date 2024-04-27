// ---------------------------   Active Sidebar   ---------------------------
var currentPageUrl = window.location.href;
var currentUrl = currentPageUrl.split('?')[0];
var menuLinks = document.querySelectorAll('.menu__link');

menuLinks.forEach(function(link) {
    if (link.getAttribute('href') === currentUrl) {
        link.classList.add('menu__active');
        link.querySelector('.sidebar__icon').classList.add('icon__active');
        link.querySelector('.menu__link__text').classList.add('text__active');
    }
});

const sidebar = document.querySelector('#sidebar');
const sidebarBtn = document.querySelector('#sidebar-btn');
const sidebarBtnImg = document.querySelector('#sidebar-btn-img');
const dashBody = document.querySelector('.body');

sidebarBtn.onclick = () => {
  if(sidebar.classList.toggle('open')){
    sidebarBtnImg.src = "./../assets/img/icon/sidebar_menu/sidebar-close.svg"
    dashBody.classList.add('open-sidebar');
  } else {
    sidebarBtnImg.src = "./../assets/img/icon/sidebar_menu/sidebar-open.svg"
    dashBody.classList.remove('open-sidebar');
  }
}
