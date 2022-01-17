<?php

namespace Tests\Feature;

use App\Service\TestInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Mockery\MockInterface;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->getJson('/api/post/service-container');
        $response->assertStatus(200)
            ->assertJsonPath('count', 1);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example1()
    {
        $this->mock(TestInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('sendReq')->andReturn();
            $mock->shouldReceive('getCount')->andReturn(30);
        });

        $response = $this->getJson('/api/post/service-container');
        $response->assertStatus(200)
            ->assertJsonPath('count', 30);
    }
}
