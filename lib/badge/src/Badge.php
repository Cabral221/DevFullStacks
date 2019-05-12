<?php

namespace Badge;

use App\User;
use Badge\BadgeUnlock;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model {

    public $guarded = [];

    public function unlocks () {
        return $this->hasMany(BadgeUnlock::class);
    }

    /**
     * test si l'user a deja debloquer le badge
     *
     * @param User $user
     * @return boolean
     */
    public function isUnlockedFor (User $user) : bool {
        return $this->unlocks()
        ->where('user_id', $user->id)
        ->exists();
    }


    /**
     * debloque un badge pour un utilisateur
     *
     * @param User $user
     * @param string $action
     * @param integer $count
     * @return void
     */
    public function unlockActionFor (User $user,string $action,int $count = 0) {
        $badge= $this->newQuery()
                    ->where('action',$action)
                    ->where('action_count',$count)
                    ->first();
        if($badge && !$badge->isUnlockedFor($user)){
            $user->badges()->attach($badge);
            return $badge;
        }
        return null;
    }
}
