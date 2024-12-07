<?php

namespace Tests\Unit;

use App\Models\Budget;
use App\Models\Crop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BudgetTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_calculate_variance()
    {
        $budget = Budget::factory()->create([
            'planned_amount' => 1000,
            'actual_amount' => 800
        ]);

        $this->assertEquals(200, $budget->variance);
        $this->assertEquals(20, $budget->variance_percentage);
    }

    public function test_can_detect_over_budget()
    {
        $budget = Budget::factory()->create([
            'planned_amount' => 1000,
            'actual_amount' => 1200
        ]);

        $this->assertTrue($budget->isOverBudget());
    }
} 