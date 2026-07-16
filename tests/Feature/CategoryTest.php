<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_application_can_get_all(): void{
        $user = User::factory()->create();
        Sanctum::actingAs($user,['*']);
        $this->getJson('/api/category')->assertStatus(200);   
    }

    public function test_application_string_name_and_int_seerity_returns_error(): void{
        $user = User::factory()->create();
        Sanctum::actingAs($user,['*']);
        $data = ['name' => 'Test Category', 'severity' => 5];
        $this->postJson('/api/v1/category',$data)->assertStatus(500)->assertJsonValidationErrorFor('severity');
    }
}
