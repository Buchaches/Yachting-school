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
var decreaseButton = document.getElementById("decreaseButton");
var increaseButton = document.getElementById("increaseButton");

function rename() {
  if(value == 2 || value == 3 || value == 4 || value == 22 || value == 23 || value == 24){
    text.innerHTML = 'человека';
  }else{
    text.innerHTML = 'человек';
  }
}

function activeBtn(){
  if(value == min){
    decreaseButton.style.opacity = "0.2"
  }else if(value == max){
    increaseButton.style.opacity = "0.2"
  }else{
    decreaseButton.style.opacity = "0.9"
    increaseButton.style.opacity = "0.9"
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
  number.innerHTML = value;

  rename();
  activeBtn();
}

function decrease() {
  if (min) {
    if (value > min && value + step >= min) {
      value -= step;
    }
  } else {
    value -= step;
  }
  number.innerHTML = value;

  rename();
  activeBtn();
}

// -----------------------------   Select   -----------------------------
$( document ).ready(function() {
  $( '#exampleSelectDate' ).select2( {
      theme: "bootstrap-5",
      width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
      placeholder: $( this ).data( 'placeholder' ),
      closeOnSelect: false,
      minimumResultsForSearch : Infinity,
      "language": {
        "noResults": function(){
            return "";
        }
      }
  });    
});

// ------------------------------   AJAX   ------------------------------

//------------------   People   ------------------
$(document).ready(function(){
  var people = $('#number').text();
  if(people){
    $.ajax({
      type:'POST',
      url:'/app/controllers/bookings',
      data:'people='+people,
      success:function(html){
        $('#exampleSelectDate').html(html);
      }
    });
  }
  $('.number__btn').click(function(){
    var people = $('#number').text();
    if(people){
      $.ajax({
        type:'POST',
        url:'/app/controllers/bookings',
        data:'people='+people,
        success:function(html){
          $('#exampleSelectDate').html(html);
        }
      });
    }
  });
});