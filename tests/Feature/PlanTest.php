<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Farm;
use App\Models\Plan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlanTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_plan()
    {
        $user = User::factory()->create();
        $farm = Farm::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post(route('farms.plans.store', $farm), [
            'farm_item' => 'Test Plan',
            'quantity' => 100,
            'unit' => 'ha',
            'start_date' => now(),
            'end_date' => now()->addMonths(2),
            'operation_price' => 2500
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('plans', [
            'farm_id' => $farm->id,
            'farm_item' => 'Test Plan'
        ]);
    }

    public function test_user_cannot_access_other_users_plans()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $farm = Farm::factory()->create(['user_id' => $user1->id]);
        
        $response = $this->actingAs($user2)->get(route('farms.plans.index', $farm));
        
        $response->assertForbidden();
    }

    public function test_plan_requires_validation()
    {
        $user = User::factory()->create();
        $farm = Farm::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post(route('farms.plans.store', $farm), []);

        $response->assertSessionHasErrors(['farm_item', 'quantity', 'unit', 'start_date', 'end_date', 'operation_price']);
    }
} 