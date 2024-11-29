<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Farm;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FarmManagementTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_user_can_create_farm()
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/farms', [
                'name' => 'New Farm',
                'location' => 'Test Location',
                'size' => 100.5
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Granja creada exitosamente',
                'data' => [
                    'name' => 'New Farm',
                    'location' => 'Test Location'
                ]
            ]);

        $this->assertDatabaseHas('farms', [
            'name' => 'New Farm',
            'location' => 'Test Location'
        ]);
    }

    public function test_user_can_update_farm()
    {
        $farm = Farm::factory()->create(['owner_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->putJson("/api/farms/{$farm->id}", [
                'name' => 'Updated Farm',
                'location' => 'New Location'
            ]);

        $response->assertStatus(200);
        
        $this->assertDatabaseHas('farms', [
            'id' => $farm->id,
            'name' => 'Updated Farm',
            'location' => 'New Location'
        ]);
    }
} 