window.onload=function(){
   $(document).on("click", ".obrisiKontakt", function(e){
    e.preventDefault();
    let id = $(this).data("id");
    
    $.ajax({
        url: "models/admin/obrisiKontakt.php",
        method: "GET",
        data: {
            id: id
        },
        success: function(kategorije){
            printKontact(kategorije);
        },
        error: function(xhr, greska, status){
            alert(greska);
        }
    })
});


function printKontact(kategorije){
    let ispis = "";
    for(let kategorija of kategorije){
        ispis += printKon(kategorija);
    }   
    $(".tt").html(ispis);
}

function printKon(kategorija){
    return `<tr><td>${ kategorija.imePrezime }</td>
    <td>${ kategorija.email }</td>
    <td>${ kategorija.text }</td>
    <td><a class="f obrisiKontakt" data-idKon="${kategorija.idKontakt}" href="#">X</a></td></tr>`;
    }    
}
