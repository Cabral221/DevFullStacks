<?php

namespace Badge;

use Badge\Badge;
use App\Events\Premium;
use Badge\BadgeUnlocked;
use App\Models\CommentsPost;

class BadgeSubscriber {

    private $badge;

    public function __construct(Badge $badge) {
        $this->badge = $badge;
    } 

    public function subscribe ($events) 
    {
        // $events->listen('eloquent.created: App\Models\CommentsPost',[$this,'onNewComment']);
        $events->listen('eloquent.saved: App\Models\CommentsPost',[$this,'onNewComment']);
        $events->listen(Premium::class,[$this,'onPremium']);
    }


    public function notifyBadgeUnlock ($user,$badge) {
        if($badge){
            $user->notify(new BadgeUnlocked($badge));
        }  
    }


    public function onNewComment(CommentsPost $comment) {
        $user = $comment->user;
        $comments_count = $user->comments()->count();
        $badge = $this->badge->unlockActionFor($user,'comments',$comments_count);
        $this->notifyBadgeUnlock($user,$badge);
    }

    public function onPremium (Premium $event) {
        $badge = $this->badge->unlockActionFor($event->user,'premium');
        $this->notifyBadgeUnlock($event->user,$badge);
    }
}