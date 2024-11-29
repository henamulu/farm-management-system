<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Farm;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FarmTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_create_farm()
    {
        $farmData = [
            'name' => 'Test Farm',
            'location' => 'Test Location',
            'size' => 100.5,
            'owner_id' => $this->user->id
        ];

        $farm = Farm::create($farmData);

        $this->assertInstanceOf(Farm::class, $farm);
        $this->assertEquals($farmData['name'], $farm->name);
        $this->assertEquals($farmData['location'], $farm->location);
    }

    public function test_farm_requires_name()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Farm::create([
            'location' => 'Test Location',
            'size' => 100.5,
            'owner_id' => $this->user->id
        ]);
    }
} 