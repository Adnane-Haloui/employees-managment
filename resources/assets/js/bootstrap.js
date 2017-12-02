/*
** En premier on ajout jquery et après Bootstrap
*/

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {}

