import 'bootstrap/dist/js/bootstrap.bundle.min.js';
// require jQuery normally
const $ = require('jquery');

// create global $ and jQuery variables
global.$ = global.jQuery = $;

$( document ).ready(function() {
    $( ".btn-primary" ).click(function() {
        $('h1').css('color','blue');
    });

    console.log("hola");
});