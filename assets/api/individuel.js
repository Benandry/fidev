
    
// $(document).ready(() =>{
//    
// })    
    
    

// $(document).ready(function(){

//     $(document).ready(function(){
//             $(window).on('load',()=>{
//             $('#myModal').modal('show')
//             })
//     });


//     function pad(str, max) {
//         str = str.toString();
//         return str.length < max ? pad("0" + str, max) : str;
//     }

//    // {#  Manova an ilay input code Client  #}
//      var last_client =parseInt($('#last_client').text());
//      last_client++;
//      pad_last_client = pad(last_client.toString(),7);


//    // {# MAnova an ilay agence   #}
//     var get_agence_id = parseInt($('#agence_id').text());
//     pad_agence_id = pad(get_agence_id.toString(),2);
//     $('#individuelclient_codeclient').val('I'+pad_agence_id+pad_last_client);
    
//     //{# Cacher le champ code  individuel#}
//     $('#individuel').attr("style", "display: none");

//     $('#individuelclient_date_naissance').on('change',(e)=>{
//             var birth_ = e.target.value
//             var year_birth =parseInt(birth_.slice(0,4))
//             var year_now = parseInt(new Date().getFullYear())
    
//             var age = year_now - year_birth
//             $('#age').html(age+' ans  ')
    
//     })


//     });