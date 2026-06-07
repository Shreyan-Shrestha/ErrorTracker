<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Application;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    use RefreshDatabase;

    public function test_unauthorized_cannot_access_route(): void
    {
        $response = $this->getJson('api/v1/application');

        $response->assertStatus(401);
    }

    public function tet_authorized_user_can_access_route(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);
        $this->getJson('api/v1/application')
            ->assertStatus(200);
    }

    public function test_create_application_with_valid_gitlab_id_and_name_gives_no_error(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);
        $data = ['gitlab_id' => 485, 'name' => 'Test app'];
        $this->postJson('api/v1/application', $data)
            ->assertStatus(200);
    }

    public function test_create_application_with_string_gitlab_id_returns_validation_error_for_gitlab_id(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user,['*']);
        $data = ['gitlab_id' => 'aa', 'name' => 'Test app'];
        $this->postJson('/api/v1/application', $data)->assertJsonValidationErrorFor('gitlab_id');
    }

    // public function test_can_delete_application(): void
    // {
    //     $user = User::factory()->create();
    //     Sanctum::actingAs($user, ['*']);
    //     $app = Application::factory()->create();
    //     $this->deleteJson('app/v1/application/' . $app->id)->assertStatus(200);
    // }

    public function test_get_all_application_returns_data(): void{
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);
        $response = $this->getJson('/api/v1/application')
        ->assertStatus(200)
        ->assertJsonStructure(['success', 'message', 'data']);
    }
}
