import $ from 'jquery';
const pathname = window.location.pathname;

$(document).ready(() =>{
    if (pathname === '/new/account' || pathname === '/new/retrait') {
        $('#nom_prenom').hide()

        /**********Recuperer les code client pour chercher le nom et prenom client qui correspond au client */
        $('#form_code').on('keyup',() => {    
            var code_client = $('#form_code').val() 

            var url = '/api/code-client/'+code_client
            $.ajax({
                url: url,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify(code_client),
                success: function(result){
                    for(let i = 0; i < result.length; i++){
                        var element = result[i]

                        if(element !== '' ){
                            $('#codeclient').text(element.codeclient)
                            $('#nom').text(element.nom)
                            $('#prenom').text(element.prenom)

                            //*****Formulaire nom et prenom */
                            $('#form_nom').val(element.nom)
                            $('#form_prenom').val(element.prenom)

                        }else{
                            console.log(element)
                            $('#codeclient').text("Pas de client")
                            $('#nom').text("Pas de client")
                            $('#prenom').text("Pas de client")
                        }
                           
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
        
            }); 

                    //api_suggestion
            const url_api = '/api/code-client'
            $.ajax({
                url: url_api,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify(),
                success: function(result){

                    const getValue = result.filter(i => i.code.toLocaleLowerCase().includes(code_client.toLocaleLowerCase()))

                    var suggestion = ''

                    if( code_client != '' ){
                        getValue.forEach(resultItem =>{
                            suggestion += `<div class="suggestion">${resultItem.code}</div>`
                        })
                    }else{
                        suggestion = '<div class="suggestion"> Pas de commune</div>'
                    }
                    
                    document.getElementById('code_client_suggest').innerHTML = suggestion
                
            
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }

            });   

        })
    }
})