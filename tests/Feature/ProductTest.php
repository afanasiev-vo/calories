<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAll()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);

        $this->assertTrue(true);
    }

    /**
     * @testdox Save product without payload
     */
  /*  public function testStore()
    {

        $response = $this->json('POST', '/products', ['name' => 'Sally']);

        $response
            ->assertStatus(405)
            ->assertExactJson([
                'created' => true,
            ]);

    }*/
}
