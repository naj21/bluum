<?php

namespace App\Services;


use App\Notificaton;

class NotificationService{

    static function newCommentNotification($post, $reply_id){

        $notification = new Notificaton;
        $notification->user_id = $post->user_id;
        $notification->notification = '<strong>'.getInitials(auth()->user()).'</strong> commented on your post <strong>'.ucfirst($post->title).'</strong>';
        $notification->link = route('blog.post', [$post->id, formatUrlString($post->title)])."#reply-$reply_id";

        return $notification;
    }

    static function newCommentReplyNotification($user_id, $comment){

        $notification = new Notificaton;
        $notification->user_id = $user_id;
        $notification->notification = '<strong>'.getInitials(auth()->user()).'</strong> replied your comment <strong>'.$comment.'</strong>';

        return $notification;
    }

    static function newAnswerNotification($post, $reply_id){

        $notification = new Notificaton;
        $notification->user_id = $post->user_id;
        $notification->notification = '<strong>'.getInitials(auth()->user()).'</strong> answered your question <strong>'.ucfirst($post->title).'</strong>';
        $notification->link = route('question.show', [$post->id, formatUrlString($post->title)])."#reply-$reply_id";

        return $notification;
    }

    static function newAnswerCommentNotification($user_id, $body){

        $notification = new Notificaton;
        $notification->user_id = $user_id;
        $notification->notification = '<strong>'.getInitials(auth()->user()).'</strong> commented on your answer <strong>'.$body.'</strong>';

        return $notification;
    }
}