<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\Achievement;

class AchievementsController extends Controller
{
    public function index(User $user)
    {
        $achievement = new Achievement($user);
        return response()->json([
            'unlocked_achievements' => $achievement->allunlockedAchievements(),
            'next_available_achievements' => $achievement->nextAchievements(),
            'current_badge' => $achievement->currentBadge(),
            'next_badge' => $achievement->nextBadge(),
            'remaining_to_unlock_next_badge' => $achievement->remainingBadges()
        ]);
    }
}