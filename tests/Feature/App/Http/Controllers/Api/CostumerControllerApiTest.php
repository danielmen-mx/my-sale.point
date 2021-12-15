<?php

namespace Tests\Feature\App\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CostumerControllerApiTest extends TestCase
{
    public function test_index_with_searchbar()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
