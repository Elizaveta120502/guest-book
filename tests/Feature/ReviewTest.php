<?php

namespace Tests\Feature;

use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_create_review()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->post('/api/reviews', [
            'content' => 'This is a review.',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('reviews', [
            'content' => 'This is a review.',
        ]);
    }

    /** @test */
    public function authenticated_user_can_view_reviews()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $review = Review::factory()->create();

        $response = $this->get('/api/reviews');

        $response->assertStatus(200);
        $response->assertJson([
            ['id' => $review->id, 'content' => $review->content],
        ]);
    }
}

