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

// ------------------------------   Capacity   ------------------------------
let input = document.querySelector(".number-input");
const min = input.getAttribute("min");
const max = input.getAttribute("max");
const step = Number(input.getAttribute("step") || 1);
var value = Number(input.getAttribute("value") || 0);
let number = document.querySelector(".number");
var text = document.querySelector(".text");
number.innerHTML = value;

function rename() {
  number.innerHTML = value;
  if(value == 2 || value == 3 || value == 4){
  text.innerHTML = 'человека';
  }else{
    text.innerHTML = 'человек';
  }
}

function increase() {
  if (max) {
    if (value < max && value + step <= max) {
      value += step;
    }
  } else {
    value += step;
  }
  rename();
}

function decrease() {
  if (min) {
    if (value > min && value + step >= min) {
      value -= step;
    }
  } else {
    value -= step;
  }
  rename();
}