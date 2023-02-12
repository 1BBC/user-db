<?php

namespace Tests\Feature;

use Database\Seeders\PositionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_positions(): void
    {
        Storage::fake('public');
        $this->seed(PositionSeeder::class);

        $response = $this->getJson('/api/v1/positions/');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'positions' => [
                [
                    'id', 'name'
                ]
            ],
        ]);
    }
}
