<?php

namespace Tests\Feature;

use App\Models\Farm;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockManagementTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $farm;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->farm = Farm::factory()->create();
        $this->user->farms()->attach($this->farm->id);
    }

    public function test_can_create_stock_item()
    {
        $response = $this->actingAs($this->user)->postJson('/api/stocks', [
            'item_name' => 'Test Item',
            'category' => 'Seeds',
            'quantity' => 100,
            'unit' => 'kg',
            'minimum_threshold' => 20,
            'farm_id' => $this->farm->id
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Stock item created successfully'
                 ]);

        $this->assertDatabaseHas('stocks', [
            'item_name' => 'Test Item',
            'farm_id' => $this->farm->id
        ]);
    }

    public function test_alerts_triggered_for_low_stock()
    {
        $stock = Stock::factory()->create([
            'farm_id' => $this->farm->id,
            'quantity' => 10,
            'minimum_threshold' => 20
        ]);

        $this->assertTrue($stock->isLowStock());
        
        $this->assertDatabaseHas('alerts', [
            'type' => 'stock',
            'farm_id' => $this->farm->id
        ]);
    }
} 