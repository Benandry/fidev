/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';
import { Tooltip, Toast, Popover } from 'bootstrap';

import './api/compte_epargne'
//Impport les dossier depot
import './api/depot'
import './api/account'

//Import les api retrait ////
//import './api/retrait'

//import les api pour les compte epargne
//import './api/api_compte_epargne'

import $ from 'jquery';

import jsZip from 'jszip'; 
import 'pdfmake';
import 'datatables.net-buttons-dt';
import 'datatables.net-dt';
import 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print';
import 'datatables.net-buttons/js/buttons.html5.js';
import 'datatables.net-bs5';
require('@fortawesome/fontawesome-free/js/all.js');




window.JSZip = jsZip;


//Import individuel 
import './api/individuel'


//*******************Variable sur le chemiin *****************/
const pathname = window.location.pathname;

$(document).ready(function(){
    /**************************************************************FUNCTION PAD *************/
    function pad(str, max) {
        str = str.toString();
        return str.length < max ? pad("0" + str, max) : str;
   }

   /**************LAnceer ltous les modal *////////*********************************************** */
   $(window).on('load',()=>{
            //alert("Alert zalah anaty modal indray ity")
            $('#myModal').modal('show')
    })

    $(".table1").DataTable({
        dom: 'Brtp',
        buttons: [
            'excel','pdf','csv','print'
        ],
        language: {
            search: "Rechercher&nbsp;",
            lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
            info: "Affichage de  _START_ a _END_ sur _TOTAL_ elements",
            paginate: {
                first:      "Premier",
                previous:   "Pr&eacute;c&eacute;dent",
                next:       "Suivant",
                last:       "Dernier"
            }
        }
      
    });

    $('#filtre_rapport_transaction_date1').on('change',()=>{
        $('#two_date').hide()
    })

    $('#filtre_rapport_transaction_Au').on('change',()=>{
        $('#one_date').hide()
    }) 
    $('#filtre_rapport_transaction_Du').on('change',()=>{
        $('#one_date').hide()
    })

    $('#individuelclient_date_naissance').on('change',(e)=>{
        var birth_ = e.target.value
        var year_birth =parseInt(birth_.slice(0,4))
        var year_now = parseInt(new Date().getFullYear())

        var age = year_now - year_birth
        $('#age').html(age+' ans  ')
       
    })

        /**********Utilisateur sur indivuduelle client******************** */
        var user_log_ = parseInt($('#user').text())
    
        $('#individuelclient_user option').each(() => {
            // alert($(this).val())
            if (user_log_ === parseInt($(this).val())) {
                $(this).attr('selected','selected')
                $(this).val(user_log_)
            }
            
        });


        /******************INDIVIDUEL CLIENT ******************************************** */
        //************************************************************************ */
        /********************************************************************** */
        /**AGE DE CLIENT */
        $('#individuelclient_date_naissance').on('change',(e) =>{
              //alert($(this).val())
              var birth_ = e.target.value
              var year_birth =parseInt(birth_.slice(0,4))
              var year_now = parseInt(new Date().getFullYear())
                  
              var age = year_now - year_birth
              $('#age').html(age+' ans  ')
                  
        })
        /*********************Code client************* */
            // {#  Manova an ilay input code Client  #}
        var last_client =parseInt($('#last_client').text());
        last_client++;

        //alert(last_client)
        var pad_last_client = pad(last_client.toString(),7);
            

        // {# MAnova an ilay agence   #}
        var get_agence_id = parseInt($('#agence_id').text());
        var pad_agence_id = pad(get_agence_id.toString(),2);
        $('#individuelclient_codeclient').val('I'+pad_agence_id+pad_last_client);

        /*************Cacher le code client */
        //{# Cacher le champ code  individuel#}
        $('#individuel').attr("style", "display: none");
        /********************************************************************************************* */
        /********************************************************************************************** */
        /******************************Fin client ***************************************************** */
        
        //***********************************Groupe ********************************************************/
        /*****Verifier l'url s'il est egale a nouveau groupe */
        if(pathname === '/groupe/new'){
            // {#  Manova an ilay input code Groupe  #}
            var id_groupe =parseInt($('#id_groupe').text());
            id_groupe++;
           // alert(id_groupe)
            // {# Agence #}
            var id_agence =parseInt($('#id_agence').text());
            //alert(id_agence)
            var code_groupe_ = 'G'+pad(id_agence.toString(),2)+""+pad(id_groupe.toString(),7)
    
           //alert(code_groupe_)
    
            $('#groupe_codegroupe').val(code_groupe_);
            // {# Cacher le champ code client#}
            $('#code').attr("style", "display: none");
        }


        

});

