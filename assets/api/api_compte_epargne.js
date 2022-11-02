$(document).ready(()=>{

    $('#compte_epargne_codeep').on('keyup',function(){
        var code_client = $(this).val();
        document.getElementById('code').innerHTML = code_client;

     var type_produit = $('#type_prod').text();
     var id_produits = $('#id_prod').text();
     
     $('#compte_epargne_codeepargne').val(code_client+type_produit+id_produits.padStart(5,0));
    });
    

    $("#compte_epargne_produit").on('change',function(){

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
                    document.getElementById('text').innerHTML = "<span id=\'type_prod\'>"+element.TypeProd.toString().padStart(1,0)+"</span><span id=\'id_prod\'>"+element.Produit_id.toString().padStart(4,0)+" </span>";
                }
        
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }

        });    
    });
})