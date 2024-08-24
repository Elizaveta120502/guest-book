<?php

namespace Tests\Feature;

use App\Models\Review;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_create_reply_to_review()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $review = Review::factory()->create();

        $response = $this->post('/api/reviews/' . $review->id . '/replies', [
            'content' => 'This is a reply.',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('replies', [
            'content' => 'This is a reply.',
            'review_id' => $review->id,
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function authenticated_user_can_view_replies_for_review()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $review = Review::factory()->create();
        $reply = Reply::factory()->create(['review_id' => $review->id, 'user_id' => $user->id]);

        $response = $this->get('/api/reviews/' . $review->id . '/replies');

        $response->assertStatus(200);
        $response->assertJson([
            ['id' => $reply->id, 'content' => $reply->content],
        ]);
    }

    /** @test */
    public function only_admin_can_create_reply()
    {
        $user = User::factory()->create(['is_admin' => false]);
        $this->actingAs($user, 'sanctum');

        $review = Review::factory()->create();

        $response = $this->post('/api/reviews/' . $review->id . '/replies', [
            'content' => 'This is a reply.',
        ]);

        $response->assertStatus(403);
    }
}
