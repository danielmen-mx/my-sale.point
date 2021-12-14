<?php

namespace Tests\Feature\App\Http\Controller\Backend;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    public function test_connection_view()
    {
        $response = $this->get('products');

        $response->assertRedirect()->with('products');
    }

    public function test_store()
    {
        $sale_price = rand(100,500);
        $acquisition_price = rand(50,450);
        $user_id = rand(1,100);
        $quantity = rand(1,25);
        $payload = [
            'name' => 'products',
            'brand' => 'any brand',
            'description' => 'any description about a product',
            'image' => UploadedFile::fake()->image('avatar.jpg', 300, 300),
            'sale_price' => $sale_price,
            'acquisition_price' => $acquisition_price,
            'user_id' => $user_id,
            'quantity' => $quantity
        ];
        
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('products', $payload);
        $response->assertRedirect("products");
        $response->assertSessionHas('status');
    }

    public function test_create()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('products/create');
        $response->assertSuccessful();
        // $response->assertViewHas("Create");
    }

    public function test_update()
    {
        $sale_price = rand(100,500);
        $acquisition_price = rand(50,450);
        $quantity = rand(1,25);
        $product = Product::factory()->create();
        $user = User::factory()->create();
        $payload = 
        [    # Ingresamos una payload con las propiedades que se van a actualizar del arreglo creado.
            'name' => 'products',
            'brand' => 'any brand',
            'description' => 'any description about a product',
            'image' => UploadedFile::fake()->image('avatar.jpg', 300, 300),
            'sale_price' => $sale_price,
            'acquisition_price' => $acquisition_price,
            'quantity' => $quantity
        ];

        $response = $this->actingAs($user)->put("products/$product->id", $payload); # La respuesta es igual a: nos loggeamos como un usuario del sistema y por medio del metodo put entramos a la ruta de products, y le ingresamos un parametro que viene de nuestra payload.
        $response->assertRedirect("products");  # Asertamos que este proceso nos redireccionará
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('products',
        [  # $response es usado para obtener la respuesta del servidor (redireccion, variable de sesion), mientras que $this nos permite insertar elementos de la base de datos.
            'id' => $product->id,
            'name' => $payload['name'],
            'brand' => $payload['brand'],
            'sale_price' => $payload['sale_price']
        ]);
    }

    public function test_destroy()
    {
        $product = Product::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete("products/$product->id");
        $response->assertRedirect("products");
        $response->assertSessionHas('status');

        $this->assertDatabaseMissing('products', [
            'id' => $product->id
        ]);
    }
}
