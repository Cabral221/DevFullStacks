<?php

namespace Badge;


trait Badgeable {

    public function badges () {
        return $this->belongsToMany(Badge::class);
    }

}