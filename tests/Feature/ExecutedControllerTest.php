<?php

namespace Tests\Feature;

use App\Models\Executed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExecutedControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_store_method_creates_executed_data_with_double_values()
    {
        // Simulate a request with example data, including double values
        $response = $this->post('http://beeping-nginx/api/executed/create', [
            'total_cost' => 10.5,
            'total_orders' => 20.75,
        ]);

        // Check that the record was created successfully in the database
        $response->assertStatus(200);
        $this->assertDatabaseHas('executed', [
            'total_cost' => 10.5,
            'total_orders' => 20.75,
        ]);
    }


    // This method runs after each test and cleans up created data
    protected function tearDown(): void
    {
        Executed::truncate(); // Delete all records from the "executed" table
        parent::tearDown();
    }
}
