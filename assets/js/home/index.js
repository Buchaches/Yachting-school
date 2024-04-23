// ---------------------------   Header   ---------------------------
const header = document.querySelector('.header');
const header_Height = document.querySelector('header').offsetHeight;

window.addEventListener('scroll', function() {
  if (window.scrollY > header_Height) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
});

const sections = document.querySelectorAll('section');
const navLinks = document.querySelectorAll('.nav__link');
const headerHeight = document.querySelector('header').offsetHeight;

function onScroll() {
    let scrollPosition = document.documentElement.scrollTop + headerHeight;
  
    sections.forEach((section, index) => {
        if (
            scrollPosition >= section.offsetTop - section.offsetHeight * 0.25 &&
            scrollPosition < section.offsetTop + section.offsetHeight - section.offsetHeight * 0.25
        ) {
            navLinks.forEach((link) => {
              link.classList.remove('active');
            });
            navLinks[index].classList.add('active');

            const sectionId = section.getAttribute('id');
            const url = window.location.href.split('#')[0] + '#' + sectionId;
            window.history.pushState({ path: url }, '', url);
        }
    });
}
navLinks[0].classList.add('active');
window.addEventListener('scroll', onScroll);
// ---------------------------   Swiper   ---------------------------

const swiper = new Swiper('.instructors-slider', {
  spaceBetween:20,
  slidesPerView:1,
  
  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints: {
    1080: {
      slidesPerView: 3,
    },
    831: {
      slidesPerView: 2,
    }

  }
});
// ---------------------------   Popup  --------------------------

function openPopup(image, title, description) {
  document.getElementById("popup-image").src = image;
  document.getElementById("popup-title").innerHTML = title;
  document.getElementById("popup-description").innerHTML = description;

  document.body.style.overflow = "hidden"; 
  document.getElementById("overlay").style.display = "block";

  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      closePopup();
    }
  });

  document.getElementById('overlay').addEventListener('click', function(event) {
    if (event.target === document.getElementById('overlay')) {
      closePopup();
    }
  });
}

function closePopup() {
  document.body.style.overflow = "visible"; 
  document.getElementById("overlay").style.display = "none";
  document.removeEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      closePopup();
    }
  });

  document.getElementById('overlay').removeEventListener('click', function(event) {
    if (event.target === document.getElementById('overlay')) {
      closePopup();
    }
  });
}