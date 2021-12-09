<?php

namespace Tests\Unit\Helpers;

use App\Helpers\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testEmail()   // Vamos a verificar con esta prueba si lo que ingresamos es realmente un correo.
    {
        // $email = 'daniel@admin.com';    // Primero ingresamos un correo dentro de la variable que usaremos.
        // $result = (bool) filter_var($email, FILTER_VALIDATE_EMAIL);   // Despues vamos a guardar en otra variable el resultado (True or False/bool), realizamos un filer_var que se lea de la siguiente forma: "si el email que estamos pasando realmente cumple con las caracteriticas de un email, nos regresará un boolean True or False. Dentro de la práctica esto es incorrecto ya que está validación debe ser realizada desde un Modelo que contenga los Email.

        // El metodo usado con aterioridad es un error ya que necesitamos realizar la validacion de la información de una programación externa, para ello crearemos un Modelo en la carpeta App\Helpers llamado Email.php donde escribiremos la logica de la función de validación.
        
        $result = Email::validate('daniel@@admin.com');  // Esta linea contiene la lógica para validar por medio de la clase Email el usuario ingresado...

        $this->assertFalse($result);     // Nos responderá si la validación resultó True, si indicaramos un false y el string ingresado fuera un correo nos arrojaría un error, pero si no fuera un correo nos arrojaría Tests: passed.

            // Entonces si en nuestro assertTrue ingresamos un string con la estructura correcta de un email, nos indicará passed.
                    // pero si usamos assertFalse ->string(email), nos indicara error,
                    // otro modo es si assertTrue ->string(not email), nos indicará error,
                                //  si assertFalse ->string(not email), nos indicará passed.
    }
}
