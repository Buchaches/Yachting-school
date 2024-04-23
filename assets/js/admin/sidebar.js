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
