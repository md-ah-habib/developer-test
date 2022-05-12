<?php
namespace App\Helpers;

class Achievement{
    private $totalComment = 0;
    private $totalWatched = 0;
    private $totalAchievement = 0;

    private $user = null;
    private $badges = [
        0=> "Beginner",
        4=> "Intermediate",
        8=> "Advanced",
        10=> "Master"
    ];
    private $lessonAchievements = [1,5,10,25,50];
    private $commentAchievements = [1,3,5,10,20];


    public function __construct($user){
        $this->user = $user;
        $this->totalComment = $this->user->comments->count();
        $this->totalWatched = $this->user->watched->count();
        $this->totalAchievement = $this->totalComment+$this->totalWatched;

    }
    
    public function commentachievementUnlocked(){
        $achievement = [];
        $commentachievement = $this->getCommentAchievement($this->totalComment);
        if($commentachievement != ""){
            $achievement['achievement_name'] =$commentachievement;
            $achievement['user'] = $this->user;
        }
        return $achievement;
    }
    
    public function lessonachievementUnlocked(){
        $achievement = [];
        $watchedachievement = $this->getLessonAchievement($this->totalWatched);
        if($watchedachievement != ""){
            $achievement['badge_name'] = $watchedachievement;
            $achievement['user'] = $this->user;
        }
        return $achievement;
    }

    public function badgeUnlocked(){
        $badge = $this->calcBadge($this->totalAchievement);
        $badgeDetails = [];
        if($badge != ''){
            $badgeDetails ["badge_name"] = $badge;
            $badgeDetails ["user"] = $this->user;
        }
        return $badgeDetails;
    }

    public function allunlockedAchievements(){
        $totalAchievements = [];
        for($i= 0; $i<=$this->totalWatched; $i++){
            $lessonachievement =  $this->getLessonAchievement($i);
            if($lessonachievement != ""){
                array_push($totalAchievements,$lessonachievement);
            }
        }
        for($j= 0; $j<=$this->totalComment; $j++){
            $commentachievement =  $this->getCommentAchievement($j);
            if($commentachievement != ""){
                array_push($totalAchievements,$commentachievement);
            }
        }
        return $totalAchievements;
    }

    public function nextAchievements(){
        $nextAchievements =[];
        foreach($this->lessonAchievements as $lesson){
            if($this->totalWatched< $lesson){
                $lesson = $this->getLessonAchievement($lesson);
                array_push($nextAchievements,$lesson);
                break;
            }
        }
        foreach($this->commentAchievements as $comment){
            if($this->totalComment< $comment){
                $comment = $this->getCommentAchievement($comment);
                array_push($nextAchievements,$comment);
                break;
            }
        }
        return $nextAchievements;
    }

    public function currentBadge(){
        $badge = $this->calcBadge($this->totalAchievement);
        if($badge == ''){
            for($l = $this->totalAchievement; $l>=0; $l--){
                $badge = $this->calcBadge($l);
                if($badge != ''){
                    $text = ($this->totalAchievement>1)?'Achievements':'Achievement';
                    $badge = $this->badges[$l] .": ".$this->totalAchievement." ".$text;
                    break;
                }
            }
        }
        return $badge;
        
    }
    public function nextBadge(){
        $currentBadge = $this->currentBadge();
        $key = $this->findNextKey($currentBadge,$this->badges);
        return $this->calcBadge($key);
    }
    
    public function remainingBadges(){
        $currentBadge = $this->currentBadge();
        $key = $this->findNextKey($currentBadge,$this->badges);
        $keys = array_keys($this->badges);
        $keyIndex = array_search($key,$keys);
        $remainingBadges = array_slice($this->badges, $keyIndex,count($keys)-1, true);
        $remainingBadgeNames = [];
        foreach($remainingBadges as $k => $remainingBadge){
            array_push($remainingBadgeNames,$this->calcBadge($k));
        }
        return $remainingBadgeNames;
    }

    private function getCommentAchievement($totalComment){
        $unlockedAchievement = "";
        if(in_array((int)$totalComment, $this->commentAchievements)){
            $unlockedAchievement = ((int)$totalComment === 1)?"First Comment Written":$totalComment." Comments Written";
        }
        return $unlockedAchievement;
    }

    private function getLessonAchievement($totalWatched){
        $unlockedAchievement = "";
        if(in_array((int)$totalWatched, $this->lessonAchievements)){
            $unlockedAchievement = ((int)$totalWatched === 1)?"First Lesson Watched":$totalWatched." Lessons Watched";
        }
        return $unlockedAchievement;
    }

    private function calcBadge($totalAchievement){
        $badge = '';
        if(array_key_exists($totalAchievement,$this->badges)){
            $text = ($totalAchievement>1)?'Achievements':'Achievement';
            $badge = $this->badges[$totalAchievement] . ": ".$totalAchievement." ".$text;
        }
        return $badge;
    }
    private function findNextKey($value,$array){
        $keys = array_keys($array);
        $key = array_search ($value, $array);
        $keyIndex = array_search($key,$keys);
        return $keys[$keyIndex+1];
    }

}