<?php

namespace Tests\Feature\App\Http\Controllers\Backend;

use App\Models\Costumer;
use App\Models\User;
use Carbon\Factory;
use Faker\Factory as FakerFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CostumerControllerTest extends TestCase
{
    // use RefreshDatabase; // Esta clase nos 'refresca' nuestra base de datos, lo que sucede usando el comando 'php artisan migrate:refresh' por lo que los datos ingresados se perderán.

    public function testRouteActive()
    {
        $this
            ->get('costumers')
            ->assertStatus(302);
    }

    // public function testCreate()
    // {

    // }

    public function testStore()
    {
        $email = time().'@gamil.com'; // time() se usa para generar una serie de números que se actualize con cada ejecución, concatenado a un string, de este modo no infringimos la regla de que los correos deben ser unicos.
        $phone = rand(1000000,1000000000);
        $payload = [    // Se ingreso un payload para definir cada propiedad del elemento que se creará
            'first_name' => 'Chato',
            'last_name' => 'Rodriguez',
            'birthday' => '2019-06-23',
            'email' => $email,
            'phone' => $phone
        ];
        
        $user = User::factory()->create();  // Creamos el usuario por medio de factory

        $response = $this->actingAs($user)->post('costumers', $payload);    // Como nuestro sistema nos pide una autenticación usamos el metodo 'actingAs' para ejecutar bajo un usuario. Posterior cargador por metodo 'post' en la tabla 'costumers' nuestro 'payload'.
        $response->assertRedirect("costumers"); // Verificamos que nuestro controlador nos esté redirigiendo a la vista de donde venimos.
        $response->assertSessionHas("status");  // Esta verificación la colocamos ya que nuestro controllador junto con la vista nos regresa una notificación del estado de nuestro proceso.
        
        $this->assertDatabaseHas('costumers', $payload);
        // $response
    }

    // public function testEdit()
    // {
        
    // }

    // public function testUpdate()
    // {
        
    // }

    public function testDestroy()
    {
        $costumer = Costumer::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete("costumers/$costumer->id");
        $response->assertRedirect("costumers");
        $response->assertSessionHas('status');

        $this->assertDatabaseMissing('costumers', ['id' => $costumer->id]);
    }
}