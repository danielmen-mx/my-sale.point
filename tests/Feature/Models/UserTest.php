<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestUser extends TestCase
{
    // use RefreshDatabase; // De este modo estaremos trabajando con información falsa para asi mantener segura nuestra database original <Similar que trabajar con migrate>

    public function testUser()
    {

        // Supongamos que estamos elimando, guadando o actualizando un registro... proccess

        $email = time().'@gamil.com';

        // Creamos un usuario ficticio
        User::factory()->create([
            'email' => $email
        ]);

        // Asertamos que realmente se haya creado el usuario
        $this->assertDatabaseHas('users', [
            'email' => $email
        ]);

        // // Acertamos que el registro se eliminó
        // $this->assertDatabaseMissing('users', [
        //     'email' => 'huacalin@admin.com'
        // ]);

        // Entendamos que cuando trabajamos en un proyecto hacemos uso de una database, pero al testear podemos dañar el codigo que usamos, entonces tenemos que configurarlo de modo que mantengamos segura nuestra información y los test se lleven a cabo...
        // Para finalizar esta configuración iremos a phpunitg.xml para descomentar la conexión con dos database de pruebas...
    }
}
