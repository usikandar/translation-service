<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use App\Models\User;
use App\Models\Translation;

class TranslationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    /** @test */
    public function an_authenticated_user_can_create_a_translation()
    {
        // Create a user and authenticate using Sanctum
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        // Send POST request to create a translation
        $response = $this->postJson('/api/translations', [
            'locale' => 'en',
            'key' => 'hello',
            'value' => 'Hello, world!',
            'tags' => ['web'],
        ]);

        // Assert response is successful
        $response->assertStatus(201)
            ->assertJsonStructure([
                'id', 'locale', 'key', 'value', 'tags'
            ]);

        // Check database for the new record
        $this->assertDatabaseHas('translations', [
            'locale' => 'en',
            'key' => 'hello',
            'value' => 'Hello, world!',
        ]);
    }
}
