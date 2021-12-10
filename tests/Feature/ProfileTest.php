<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDa,tabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage; // Todo a nivel de archivos que almacenemos se redirige a está carpeta.

class ProfileTest extends TestCase
{
    public function testUpload()
    {
        Storage::fake('local');
        // Primero indicamos que vamos a trabajar en la clase Storage de forma local y lo que vamos a crear será fake.

        $response = $this->post /* Declaramos el metodo post para indicar que lo que realizaremos será guardas datos */('profile', [
        // Aquí declaramos que nos responde el navegador cuando un usuario entra a la ruta 'profile'...
            'photo' => $photo = UploadedFile::fake()->image('photo.png')
            // Enviamos una foto que guardaremos en una variable, trabajamos con la clase Uploadedfile creando una imagen que se llamará 'photo.png'
        ]);
        // 
        Storage::disk('local')->assertExists("profiles/{$photo->hashName()}");
        // Se revisa el disco para verificar si existe en nuestra carpeta profile que exista la foto que habiamos guardado en una variable.

        $response->assertRedirect('profile');
        //$this->assertTrue(Storage::disk('local')->exists($response));
        // Lo ultimo es verificar que se este redirigiendo nuestra vista a view.profile.

        // Para terminar de configurar este proceso iremos a la carpeta Routes/Web.php donde conectaremos la ruta, y posteriormente crearemos el view de lo que estamos haciendo.
    }

    public function test_photo_required()   // Estamos haciendo un test para verificar que cuando un usuario de click al boton "send", sino cargaron ningun archivo, no se recargue la pagina, sino que les indique cual es el problema.
    {
        $response = $this->post('profile', ['photo' => '']);

        $response->assertSessionHasErrors('photo');
    }
}