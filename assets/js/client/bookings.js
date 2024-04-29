// ----------------------------   Status   ----------------------------
document.addEventListener("DOMContentLoaded", function() {
    let statusCells = document.getElementsByClassName("colors");
    
    for (let cell of statusCells) {
        let status = cell.textContent;
        
        if (status === "Оплачено") {
            cell.style.color = "#44944A";
        } else if (status === "Не оплачено") {
            cell.style.color = "#E32636";
        }
    }
});