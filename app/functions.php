<?php

if ( ! function_exists('validate_email'))
{
    function validate_email($email)
    {
        return App\Helpers\Email::validate($email);
    }
}

// En esta carpeta estamos declarando funciones que podemos utilizar desde cualquier archivo en laravel, pero para que laravel sepa de la existencia de estas funciones tenemos que indicarlo de forma manual en el archivo de >composer.json...

// Buscamos la llave de autoload para indicarle que existe dentro de nuestra app un archivo que ejecuta funciones.
// Ir a > composer.json > "autoload" > despúes del autoload cargamos nuestro archivo del siguiente modo:
                // "files": [
                //     "app/functions.php"
                // ]
// De este modo ya le indicamos a laravel que existe un archivo llamado functions.php en la carpeta app.
// Despues actualizamos nuestro composer para que refresque está información usando desde la terminal: % composer dump