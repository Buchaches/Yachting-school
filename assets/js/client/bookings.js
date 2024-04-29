// ----------------------------   Select   ----------------------------
$( document ).ready(function() {
    $( '#filterInstructors' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
    });
    $( '#filterService' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
        minimumResultsForSearch : Infinity,
    });
});
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
