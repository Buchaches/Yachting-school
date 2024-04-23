// DropDownMenu
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
  