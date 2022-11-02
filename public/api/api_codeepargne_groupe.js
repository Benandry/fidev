$(document).ready(function(){
            
    function pad(str, max) {
        str = str.toString();
       return str.length < max ? pad("0" + str, max) : str;
     }

    $("#compte_groupe_ep_produit").on('change',function(){

        var url = "/api/individuel/"+$(this).val();

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
                    document.getElementById('text').innerHTML = "<span id=\'type_prod\'>"+pad(element.TypeProd.toString(),1)+"</span><span id=\'id_prod\'>"+pad(element.Produit_id.toString(),4)+" </span>";
                }
        
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }

        });    
    });

    $('#compte_groupe_ep_codegroupe').on('keyup',function(){
        var code_client = $(this).val();
        document.getElementById('code').innerHTML = code_client;

     var type_produit = $('#type_prod').text();
     var id_produits = $('#id_prod').text();
     
     $('#compte_groupe_ep_codegroupeepargne').val(code_client+type_produit+pad(id_produits,5));
    });
    
})