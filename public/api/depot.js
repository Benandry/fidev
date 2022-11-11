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

         /******** */

         ///****************Montant bruite et net*************** */
         var montant_bruit_ = 0
         var commission = 0
         var papeterie = 0
         $('#transaction_montant_bruite').on('keyup',(e) =>{
             montant_bruit_ = e.target.value;
         })

        $('#transaction_commission').on('change',(e)=>{
            commission = e.target.value
        })

        $('#transaction_papeterie').on('change',(e) =>{
            papeterie = e.target.value
            montant_total = parseInt(montant_bruit_) -(parseInt(commission) + parseInt(papeterie)) 

            $('#transaction_Montant').val(montant_total)  

            //Ajouter valeur sur la formulaire solde

            var montantsolde = $('#Montant').text();
        
            var solde=parseInt(montant_total)+parseInt(montantsolde);
            $('#transaction_solde').val(solde);
        })

        $(window).on('load',() =>{
            $('#myModal').modal('show')
        })

    //Suggestion sur less compte epargne depot
    const code_rechercher = document.getElementById('transaction_codeepargneclient');

    const url_api = '/api/code-epargne'
    code_rechercher.addEventListener('keyup',()=>{
        const value_input = code_rechercher.value
        console.log();
        
        $.ajax({
            url: url_api,
            method: "GET",
            dataType : "json",
            contentType: "application/json; charset=utf-8",
            data : JSON.stringify(),
            success: function(result){

                const getValue = result.filter(i => i.code.toLocaleLowerCase().includes(value_input.toLocaleLowerCase()))

                var suggestion = ''

                if( value_input != '' ){
                    getValue.forEach(resultItem =>{
                    
                    suggestion += `<div class="suggestion">${resultItem.code}</div>`
                    })
                }else{
                    suggestion = '<div class="suggestion"> Pas de commune</div>'
                }
                
                document.getElementById('commune_suggest').innerHTML = suggestion
            
        
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }

        });    
    })
})