<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the User Table seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()
            ->count(20)
            ->create()->each(function($user) {
                $user->watched()->attach(Lesson::factory()->create()->id);
          });
    }
}