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

//Impport les dossier depot
//import './api/depot'

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
require('@fortawesome/fontawesome-free/js/all.js');


window.JSZip = jsZip;

//*******************Variable sur le chemiin *****************/
const pathname = window.location.pathname;

$(document).ready(function(){
  
    $(".table1").DataTable({
        dom: 'Bftp',
        buttons: [
            'excel','pdf','csv','print'
        ],
      
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
});

