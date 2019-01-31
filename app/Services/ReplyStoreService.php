<?php

namespace App\Services;

use App\Notificaton;
use App\Post;
use App\Reply;

class ReplyStoreService{

    private $type;
    private $rlink;

    function __construct($type){

        $this->type = $type;
        if($type == 'POST'){
            $rlink = 'blog/post';
        }else{
            $rlink = 'question/';
        }
    }

    function store($request){

        $post = Post::find($request->post_id);
        if(!$post) return false;

        $reply = new Reply;
        $reply->body = $request->body;
        $reply->user_id = auth()->user()->id;
        $reply->post_id = $post->id;

        if(isset($request->recipient) && !is_null($request->recipient)){
            $recipientReply = Reply::find($request->recipient);
            $recipient = $recipientReply->user;

            if($recipientReply->parent_reply) $reply->parent_reply = $recipientReply->parent_reply; else $reply->parent_reply = $recipientReply->id;
            if($recipient){
                $reply->recipient = "@$recipient->username";
                $body = substr($recipientReply->body, 0, 50);
                $r_notification = ($this->type == 'POST') ? $this->newCommentReplyNotification($recipient->id, $body) : $this->newAnswerCommentNotification($recipient->id, $body);
            }else return false;
        }

        $reply->save();
        if($this->type == 'POST') $this->newCommentNotification($post, $reply->id); else $this->newAnswerNotification($post, $reply->id);
        if(isset($r_notification) && !is_null($r_notification)){
            $r_notification->link = "$this->rlink/$post->id/".formatUrlString($post->title)."#reply-$reply->id";
            $r_notification->save();
        }

        return $reply;
    }

    private function newCommentNotification($post, $reply_id){

        $notification = new Notificaton;
        $notification->user_id = $post->user_id;
        $notification->notification = auth()->user()->username.'Commented on your post '.ucfirst($post->title);
        $notification->link = "/blog/post/$post->id/".formatUrlString($post->title)."#reply-$reply_id";
        $notification->save();
    }

    private function newCommentReplyNotification($user_id, $comment){

        $notification = new Notificaton;
        $notification->user_id = $user_id;
        $notification->notification = auth()->user()->username.' replied your comment '.$comment;

        return $notification;
    }

    private function newAnswerNotification($post, $reply_id){

        $notification = new Notificaton;
        $notification->user_id = $post->user_id;
        $notification->notification = auth()->user()->username.' answered your question'.ucfirst($post->title);
        $notification->link = "/question/$post->id/".formatUrlString($post->title)."#reply-$reply_id";
        $notification->save();
    }

    private function newAnswerCommentNotification($user_id, $body){

        $notification = new Notificaton;
        $notification->user_id = $user_id;
        $notification->notification = auth()->user()->username.'Commented on your answer '.$body;

        return $notification;
    }
}