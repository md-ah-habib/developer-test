<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\LessonWatched;
use App\Helpers\Achievement;
use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
class LessonWatchedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(LessonWatched $event)
    {
        $achievement = new Achievement($event->user);
        $lesson = $achievement->lessonachievementUnlocked();
        $badge = $achievement->badgeUnlocked();
        if(count($lesson)>0){
            event(new AchievementUnlocked($lesson['achievement_name'], $lesson['user']));
        }
        if(count($badge)>0){
            event(new BadgeUnlocked($badge['badge_name'], $badge['user']));
        }
    }
}