<?php

namespace tests\Feature\Car;

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public $mockConsoleOutput = false;

    public function setUp(): void
    {
        parent::setUp();

        $this->car = Car::factory()->create();
    }

    /**
     * @test
     */
    public function testCarDelete(): void
    {
        $response = $this->json(
            Request::METHOD_DELETE,
            route('cars.delete', ['car' => $this->car->id])
        );

        $response->assertValid();

        $response->assertStatus(Response::HTTP_FOUND);

//        $this->assertDatabaseMissing((new Car)->getTable(), ['id' => $this->car->id]);

        $response->assertRedirect(route('cars.index'));
    }
}
