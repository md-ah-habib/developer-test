<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Comment;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AchievementTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create();
        $user->watched()->attach(Lesson::factory()->create()->id);
        $comment = Comment::factory()->create();
        $response = $this->get("/users/{$user->id}/achievements");
        $response->assertStatus(200)->assertJsonStructure([
                    'unlocked_achievements'=>[], 
                    'next_available_achievements'=>[], 
                    'current_badge', 
                    'next_badge', 
                    'remaining_to_unlock_next_badge'=>[]
                ])->dump();
    }
}