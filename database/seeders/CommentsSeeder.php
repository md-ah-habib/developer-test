<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    /**
     * Run the Comment Table seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = Comment::factory()
            ->count(20)
            ->create();
    }
}