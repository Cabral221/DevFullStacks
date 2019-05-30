<?php

namespace Tests\Unit;

use App\User;
use Badge\Badge;
use Tests\TestCase;
use App\Events\Premium;
use Badge\BadgeUnlocked;
use App\Models\CommentsPost;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BadgeTest extends TestCase {

    use DatabaseTransactions;
    // use DatabaseMigrations;

    public function testBadgeUnlockAutomatically () {
        // Badge::create(['name'=>'pipelette', 'action'=> 'comments','action_count'=>2]);
        $user = factory(User::class)->create();
        factory(CommentsPost::class, 2)->create(['user_id'=>$user->id]);
        $this->asserTEquals(1, $user->badges()->count());
    }


    public function testDontUnlockBadgeForNotEnoughAction() {
        // Badge::create(['name'=>'pipelette', 'action'=> 'comments','action_count'=>3]);
        $user = factory(User::class)->create();
        factory(CommentsPost::class)->create(['user_id'=>$user->id]);
        $this->asserTEquals(0, $user->badges()->count());
    }

    public function testUnlockDoubleBadge () {
        // Badge::create(['name'=>'pipelette', 'action'=> 'comments','action_count'=>2]);
        $user = factory(User::class)->create();
        factory(CommentsPost::class, 2)->create(['user_id'=>$user->id]);
        $this->asserTEquals(1, $user->badges()->count());
        CommentsPost::where('user_id',$user->id)->first()->delete();
        factory(CommentsPost::class, 2)->create(['user_id'=>$user->id]);
        $this->asserTEquals(1, $user->badges()->count());
    }

    public function testNotificationSent () {
        Notification::fake();
        $user = factory(User::class)->create();
        factory(CommentsPost::class, 2)->create(['user_id'=>$user->id]);
        Notification::assertSentTo([$user],BadgeUnlocked::class);
    }

    public function testUnlockBadgePremium() {
        Badge::create(['name'=>'Premium','action'=>'premium']);
         $user = factory(User::class)->create();
        event(new Premium($user));
        $this->assertEquals(1,$user->badges()->count());
    }
}
