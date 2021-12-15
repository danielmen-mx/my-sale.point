<?php

namespace Tests\Feature\App\Http\Controllers\Api;

use App\Models\Costumer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CostumerControllerApiTest extends TestCase
{
    public function test_store_create_new_costumer()
    {
        $user = User::factory()->create();
        $costumer = Costumer::factory()->create();
        $email = time() . '@outlook.com';

        $payload = [
            'first_name' => $costumer->first_name,
            'last_name' => $costumer->last_name,
            'birthday' => $costumer->birthday,
            'email' => $email,
            'phone' => $costumer->phone
        ];

        $response = $this->actingAs($user)->json('post', 'costumers', $payload);

        $response->assertSuccessful();
    }
}
