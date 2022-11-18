import $ from 'jquery';
const pathname = window.location.pathname;

$(document).ready(() =>{

   if (pathname === '/compte/epargne/new') {

        
       // alert('Bonjour nareo ee mety ilay test')
        var code_client = $('.code_client').text()
        var nom_client = $('.nom_client').text()
        var prenom_client = $('.prenom_client').text()
        $('#compte_epargne_codeep').val(code_client)
        $('#compte_epargne_prenom').val(nom_client)
        $('#compte_epargne_nom').val(prenom_client)


        /**********maka id an ilay produits sy type io aa ****** */
        $("#compte_epargne_produit").on('change',function(){
        
            var url = "/api/individuel/"+$(this).val();
    
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

        $('#compte_epargne_datedebut').on('change',()=>{

            alert("alert zalah aa")
            var type_produit = $('#type_prod').text();
            var id_produits = $('#id_prod').text();
    
            var compte_epargne = code_client+type_produit+id_produits.padStart(5,0);
            $('#compte_epargne_codeepargne').val(compte_epargne);    

        })
       
    
        /***Cacher les  contient le code epargne */
        $('.prod_type').css('display','none')
        $('#compte_epargne_codeepargne').hide();
        /*******Vita ny tranfert aa********************* */
   }
})