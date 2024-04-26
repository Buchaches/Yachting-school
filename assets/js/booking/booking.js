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

// -----------------------------   Select2   -----------------------------

// --------------   Дата   ---------------
$( document ).ready(function() {
  $( '#exampleSelectDate' ).select2( {
      theme: "bootstrap-5",
      width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
      placeholder: $( this ).data( 'placeholder' ),
      minimumResultsForSearch : Infinity,
      templateResult: formatStateDate,
      templateSelection: formatStateDate, 
      escapeMarkup: function(m) { return m; },
      "language": {
        "noResults": function(){
            return "";
        }
      }
  });

  function formatStateDate(state) {
    if (!state.id) {
      return state.text;
    }
    var dateWeekArray = state.text.split('|');
    var newHtml = '<span class="option-strong">' + dateWeekArray[0] + '</span> <span class="option-trait">|</span> <span>' + dateWeekArray[1] + '</span>';
    return $(newHtml);
  }

// --------------   Время   --------------
  $( '#exampleSelectTime' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
    minimumResultsForSearch : Infinity,
    templateResult: formatStateTime,
    templateSelection: formatStateTime, 
    escapeMarkup: function(m) { return m; },
    "language": {
      "noResults": function(){
          return "";
      }
    }
  }); 

  function formatStateTime(state) {
    if (!state.id) {
      return state.text;
    }
    var wordsArray = state.text.split('|');
  
    var newHtml = '<span class="option-time">' + wordsArray[0] + '</span> <span class="option-trait">|</span> <span>' + wordsArray[1] + '</span> <span class="option-trait">|</span> <span class="option-capacity">' + wordsArray[2] + '</span>';
  
    return $(newHtml);
  }

// -----------   Инструкторы   -----------
  $( '#exampleSelectInstructor' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
    minimumResultsForSearch : Infinity,
    templateResult: formatStateInstructor,
    templateSelection: formatStateInstructor, 
    escapeMarkup: function(m) { return m; },
    "language": {
      "noResults": function(){
          return "";
      }
    }
  }); 
});

function formatStateInstructor(state) {
  if (!state.id) {
    return state.text;
  }
  if (state.text.includes('|')) {
    var dateWeekArray = state.text.split('|');
    var newHtml = '<span style="font-weight:500">' + dateWeekArray[0] + '</span> <span class="option-trait">|</span> <span class="option-capacity">' + dateWeekArray[1] + '</span>';
  } else {
    var newHtml = '<span style="font-weight:500">' + state.text + '</span>';
  }
  return $(newHtml);
}

// ------------------------------   AJAX   ------------------------------

//------------------   People   ------------------
$(document).ready(function(){
  // Количество людей
  var people = $('#number').text();
  if(people){
    $.ajax({
      type:'POST',
      url:'/app/controllers/bookings.php',
      data:'people='+people,
      success:function(html){
        $('#exampleSelectDate').html(html);
        $('#exampleSelectTime').html('<option value=""></option>');
        $('#exampleSelectInstructor').html('<option value=""></option>');
        $('#submit').hide();
      }
    });
  }

  $('.number__btn').click(function(){
    var people = $('#number').text();
    if(people){
      $.ajax({
        type:'POST',
        url:'/app/controllers/bookings.php',
        data:'people='+people,
        success:function(html){
          $('#exampleSelectDate').html(html);
          $('#exampleSelectTime').html('<option value=""></option>');
          $('#exampleSelectInstructor').html('<option value=""></option>');
          $('#submit').hide();
        }
      });
    }
  });

//-----------------   Date   -----------------
  $('#exampleSelectDate').on('change', function() {
    var date = $(this).val();
    if(date !=''){
      $('#time').show();
    }
    if(date){
      $.ajax({
        type:'POST',
        url:'/app/controllers/bookings.php',
        data:'date='+date,
        success:function(html){
          $('#exampleSelectTime').html(html);
          $('#exampleSelectInstructor').html('<option value=""></option>');
        }
      });
    }
  });

//-----------------   Time   -----------------
  $('#exampleSelectTime').on('change', function() {
    var slot = $(this).val();
    var number = $('#number').text();
    if(slot !=''){
      $('#instructor').show();
      $('#submit').show();
    }
    if(slot,number){
      $.ajax({
        type:'POST',
        url:'/app/controllers/bookings.php',
        data: {
          slot: slot,
          number: number
        },
        success:function(html){
          $('#exampleSelectInstructor').html(html);
        }
      });
      
      $.ajax({
        type:'POST',
        url:'/app/controllers/bookings.php',
        data: {
          slotPrice: slot,
          numberPrice: number
        },
        success:function(html){
          $('#price').html(html);
        }
      });
    }

  });
});

