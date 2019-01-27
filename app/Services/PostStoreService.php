<?php

namespace App\Services;

use App\Post;

class PostStoreService{

    public function store($request){

        $post = new Post;
        $post->title = $request->title;
        $post->category = $request->category;
        $post->body = $request->post;
        $post->tags = implode(",", array_map('trim', explode(',', trim(strtolower($request->tags)))));
        $post->type = $request->type;
        $post->user_id = auth()->user()->id;

        $postTagService = new PostTagService;
        $postTagService->updateTag($post->tags);

        return $post->save();
    }
}