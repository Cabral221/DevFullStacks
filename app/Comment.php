<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected static $commentableFor = ['Post','Forum'];
    protected $guarded = [];
    protected $hidden = ['email','ip'];
    protected $appends = ['email_md5','ip_md5'];

    public function getEmailMd5Attribute()
    {
        return md5($this->attributes['email']);
    }
    
    public function getIpMd5Attribute()
    {
        return md5($this->attributes['ip']);
    }

    public static function allFor($model,$id){
        $records = self::where(['commentable_type'=>$model,'commentable_id'=>$id])->orderBy('created_at','ASC')->get();
        $comments = [];
        $by_id = [];
        foreach ($records as $record) {
            if($record->reply){
                $by_id[$record->reply]->attributes['replies'][] = $record; 
            }else{
                $record->attributes['replies'] = [];
                $by_id[$record->id] = $record;
                $comments[] = $record;
            }
        }
        // dd($comments,$by_id);
        return array_reverse($comments);

    }

    public static function isCommentable($model,$id)
    {
        // dd($model);
        if(! in_array($model,self::$commentableFor)){
            return False;
        }else{
            $model = "\\App\\Models\\$model";
            // dd($model);
            return $model::where(['id'=>$id])->exists();
        }
    }
}
