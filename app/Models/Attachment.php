<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class Attachment extends Model
{

    protected $guarded = [];

    public $appends = ['url'];
    
    public static function boot() {
        parent::boot();
        self::deleted(function($attachment) {
            $attachment->deleteFile();
        });
    }

    public function attachable(){
        return $this->morphTo();
    }

    public function uploadFile (UploadedFile $file) {
        $file = $file->storePublicly('uploads',['disk' => 'public']);
        $this->name = basename($file);
        // dd($this->name);
        return $this;
    }

    public function deleteFile() {
        Storage::disk('public')->delete('uploads/'.$this->name);
    }

    public function getUrlAttribute() {
        return Storage::disk('public')->url('/uploads/' . $this->name);
    }
}