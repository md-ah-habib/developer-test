<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonsSeeder extends Seeder
{
    /**
     * Run the Lesson Table seeds.
     *
     * @return void
     */
    public function run()
    {
        $lessons = Lesson::factory()
            ->count(20)
            ->create();
    }
}