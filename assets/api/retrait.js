///Transaction retrait api////
$(document).ready(() =>{

    $("#transactionretrait_codeepargneclient").on('keyup',(e) => {
        var numero = e.target.value;
        var url = "/api/transaction/"+numero;
        
        $.ajax({
            url: url,
            method: "GET",
            dataType : "json",
            contentType: "application/json; charset=utf-8",
            data : JSON.stringify(numero),
            success: function(result){
                for (let i = 0; i < result.length; i++) {
                
                    var element = result[i];
                    console.log(element);
                    document.getElementById('text').innerHTML = "<span id=\'Montant\'>"+parseInt(element.somme_solde)+"</span>";
                    document.getElementById('code').innerHTML = element.code;
                    document.getElementById('nom').innerHTML = element.nom+" "+element.prenom;
                    document.getElementById('solde').innerHTML = element.somme_solde;
                }
        
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }

        });    
    });

    $('#transactionretrait_Montant').on('keyup',function(){
        var Montant=$(this).val();

    var montantsolde = $('#Montant').text();

        var solde=parseInt(montantsolde)-parseInt(Montant);
            $('#transactionretrait_solde').val(solde);

    });
})