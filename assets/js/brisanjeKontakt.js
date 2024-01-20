$(document).ready(function(){
    $(document).on("click", "#obrisiKontakt", function(e){
        e.preventDefault();
        let id = $(this).data("idKon");
        console.log(id);
        
        $.ajax({
            url: "models/admin/obrisiKontakt.php",
            method: "GET",
            data: {
                idKon:id
            },
            success: function(kategorije){
                printKontact(kategorije);
            },
            error: function(xhr, greska, status){
                console.log(greska);
                console.log(xhr);
                console.log(status);
                console.log("ne radi");
                
                
            }
        })
    });
});

function printKontact(kategorije){
let ispis = "";
    for(let kategorija of kategorije){
        ispis += printKon(kategorija);
    }   
    $("#teloTablele").html(ispis);
}

function printKon(kategorija){
    return `<tr><td>${ kategorija.imePrezime }</td>
    <td>${ kategorija.email }</td>
    <td>${ kategorija.text }</td>
    <td><a href="#" data-idKon="${kategorija.idKontakt}" class="f" id="obrisiKontakt">X</a></td></tr>`;
}
