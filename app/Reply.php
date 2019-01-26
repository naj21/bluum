<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function replyLikes(){
        return $this->hasMany('App\ReplyLike');
    }

    public function replyVotes(){
        return $this->hasMany('App\ReplyVote');
    }
}
