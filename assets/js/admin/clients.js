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
// ---------------------------   Сортировка по Дате   ---------------------------
document.addEventListener('DOMContentLoaded', function() {
    const table = document.querySelector('table');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
  
    let isAscending = true; 
  
    const compareDates = (date1, date2) => {
        return Math.abs(new Date(date1) - new Date()) - Math.abs(new Date(date2) - new Date());
    };
  
    const sortTableByNearestDate = () => {
        rows.sort((rowA, rowB) => {
            const dateCellA = new Date(rowA.cells[4].textContent);
            const dateCellB = new Date(rowB.cells[4].textContent);
            if (isAscending) {
                return compareDates(dateCellA, dateCellB);
            } else {
                return compareDates(dateCellB, dateCellA); 
            }
        });
  
        isAscending = !isAscending; 
        tbody.innerHTML = '';
        rows.forEach(row => {
            tbody.appendChild(row);
        });
    };
  
    table.querySelector('thead th:nth-child(5)').addEventListener('click', sortTableByNearestDate);
});
