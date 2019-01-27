<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class indexController extends Controller{

    public function index(){

        $popular_questions = Post::where([
            ['likes', '>', 0],
            ['type', 'QUESTION']
        ])->orderBy('likes', 'desc')->take(5)->get();

        $data = [
            'popular_questions' => $popular_questions,
            'title' => 'Home',
        ];

        return view("index")->with($data);
    }
}
