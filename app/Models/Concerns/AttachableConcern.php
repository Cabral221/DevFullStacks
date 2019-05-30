<?php

namespace App\Models\Concerns;

/**
 * 
 */
trait AttachableConcern
{
    public static function bootAttachableConcern () {
        self::deleted(function ($subject) {
            foreach ($subject->attachments()->get() as $attachment) {
                $attachment->deleteFile();
            }
            $subject->attachments()->delete();
        });
    }
}
