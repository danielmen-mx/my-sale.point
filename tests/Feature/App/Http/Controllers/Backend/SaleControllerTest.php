<?php

namespace Tests\Feature\App\Http\Controllers\Backend;

use App\Models\Costumer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SaleControllerTest extends TestCase
{
    public function test_view_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('sales');

        $response->assertViewIs('sales.index');
    }

    public function test_show_sale()
    {
        $user = User::factory()->create();
        $sale = Sale::factory()->create();

        $response = $this->actingAs($user)->get("sales/$sale->id");
        $response->assertViewIs('sales.show');
    }

    public function test_make_sale_store_succesfully()
    {    # Para este test tenemos un poco más de código ya que estamos pasando atraves de AJAX un array hacia el controlador, por ello necesitamos formar primero el array con los elementos que son admitidos por el lado del backend.
        $user = User::factory()->create();  # Creamos un user ficticio para loggearnos.
        $product = Product::factory()->create();    # Asimismo un producto para que podamos extraer de este los elementos necesarios para el array que enviaremos.

        $payload = [    # Formamos el payload de acuerdo a los elementos que nuestro backend nos solicita.
            'total' => rand(500,50000),
            'description' => [
                [   # Se dejó un array sin nombre ya que en el payload enviado existe un array sin nombre con un único índice.
                    'product' => [
                        'user_id' => User::factory()->create(),
                        'id' => $product->id,
                        'name' => $product->name,
                        'brand' => $product->brand,
                        'image' => $product->image,
                        'description' => $product->description,
                        'sale_price' => $product->sale_price,
                        'acquisition_price' => $product->acquisition_price,
                        'quantity' => $product->quantity
                    ],
                    'quantity' => rand(1,10)
                ]
            ]
        ];

        $response = $this->actingAs($user)->post('sales', $payload);    # Actuamos como un user, por medio del metodo post nos dirigimos a la ruta 'sales' y enviamos la $payload
        $response->assertSuccessful();  # Acertamos que este proceso se reicibio de forma satisfactoria.

        $this->assertDatabaseHas('sales', [ # No te olvides de la diferencia entre $response y $this, $response es usado para obtener la respuesta del servidor (redirección, variable de sesión) y $this para insertar elementosde la base de datos.
            'id' => $response['id']
        ]);
        $this->assertDatabaseHas('sale_descriptions',   # Acertamos que la database tiene los elementos que acabamos de ingresar usando asserDatabaseHas,
        [
            'sale_id' => $response['id']
        ]);
    }

    public function test_store_sale_with_empty_description_throw_error()
    {   
        $user = User::factory()->create();

        $payload = [    #
            'total' => rand(500,50000),
            'description' => []
        ];

        $response = $this->actingAs($user)->json('post','sales', $payload);
        // dd($response);
        $response->assertStatus(422); # Este error significa que hay errores en la validación de los datos.
    }

    public function test_assert_total_calculate_in_backend()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $payload = [
            'total' => 100,
            'description' => [
                [
                    'product' => [
                        'user_id' => User::factory()->create(),
                        'id' => $product->id,
                        'name' => $product->name,
                        'brand' => $product->brand,
                        'image' => $product->image,
                        'description' => $product->description,
                        'sale_price' => 200,
                        'acquisition_price' => $product->acquisition_price,
                        'quantity' => 2
                    ],
                    'quantity' => rand(1,10)
                ]
            ]
        ];
        
        $response = $this->actingAs($user)->post('sales', $payload);
        $response->assertSuccessful();

        $id = $response['id'];
        $sale = Sale::find($id);
        $this->assertNotEquals($sale->total, $payload['total']);
        // dd($sale->total . '_' . $payload['total']); # Si te quedan dudas, puedes verificar haciendo un dd a los dos totales obtenidos.
    }

    public function test_link_sale_to_costumer()
    {
        $user = User::factory()->create();
        $sale = Sale::factory()->create();
        $costumer = Costumer::factory()->create();

        $payload = [
            'costumer_id' => $costumer->id
        ];

        $this->assertTrue($sale->costumer_id == null);
        $response = $this->actingAs($user)->json('post', "sales/$sale->id/linkCostumer", $payload);
        $response->assertSuccessful();
        // dd($sale['costumer_id'] . ' espacio ' . $payload['id']);
        $id = $response['id'];
        $sale = Sale::find($id);
        $this->assertEquals($sale->costumer_id, $payload['costumer_id']);
    }
}
