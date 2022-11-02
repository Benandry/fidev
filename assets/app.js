/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

//Impport les dossier depot
import './api/depot'

//Import les api retrait ////
import './api/retrait'

//import les api pour les compte epargne
import './api/api_compte_epargne'

import $ from 'jquery';

import jsZip from 'jszip'; 
import 'datatables.net-buttons-dt';
import 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print';


window.JSZip = jsZip;

//*******************Variable sur le chemiin *****************/
const pathname = window.location.pathname;

$(document).ready(function(){
  
    $(".table1").DataTable({
        dom: 'Bftp',
        buttons: [
            'copy', 'excel', 'csv'
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
});

