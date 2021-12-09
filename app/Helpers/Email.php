<?php

namespace App\Helpers;

class Email
{
    public static function validate($email)
    {
        return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);    // Atraves del codigo declarado con aterioridad podemos ejecutar la validación de la forma correcta, puesto que esta clase es la encargada de realizar la validación.

        // En el archivo Tests\Unit\Helpers>EmailTest tenemos la lógica que se va a ejecutar para llegar a esta validación.

    }
}