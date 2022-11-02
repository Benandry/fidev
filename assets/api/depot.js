$(document).ready(()=>{
        /******Transction Depot GetApi  */
        $("#transaction_codeepargneclient").on('keyup',function(){
            
            var url = "/api/transaction/"+$(this).val();
    
            console.log(url);
            $.ajax({
                url: url,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify($(this).val()),
                success: function(result){
                    for (let i = 0; i < result.length; i++) {
                       
                        var element = result[i];
                        console.log(element);
                        document.getElementById('text').innerHTML = "<span id=\'Montant\'>"+parseInt(element.somme_solde)+"</span>";
                        document.getElementById('nom').innerHTML = element.nom+" "+element.prenom;
                        document.getElementById('solde').innerHTML = element.somme_solde;
                        document.getElementById('code').innerHTML = element.code;
                    }
            
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
    
            });    
        });

        $('#transaction_Montant').on('keyup',function(){
            var Montant=$(this).val();
    
         var montantsolde = $('#Montant').text();
    
             var solde=parseInt(Montant)+parseInt(montantsolde);
                 $('#transaction_solde').val(solde);
    
        });

         /******** */
})