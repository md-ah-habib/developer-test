<?php

namespace Database\Seeders;
use App\Models\User;

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
            ->create();
    }
}