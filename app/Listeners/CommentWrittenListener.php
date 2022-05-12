<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CommentWritten;
use App\Helpers\Achievement;
use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;

class CommentWrittenListener
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
    public function handle(CommentWritten $event)
    {
        $achievement = new Achievement($event->comment->user);
        $comment = $achievement->commentachievementUnlocked();
        $badge = $achievement->badgeUnlocked();
        if(count($comment)>0){
            event(new AchievementUnlocked($comment['achievement_name'], $comment['user']));
        }
        if(count($badge)>0){
            event(new BadgeUnlocked($badge['badge_name'], $badge['user']));
        }
    }
}