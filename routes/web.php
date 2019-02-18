<?php

Route::get('/', 'IndexController@index')->name('index');

// Auth::routes(["verify" => true]);
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//Blog post Routes
Route::get('/blog', 'PostController@index')->name('blog');
Route::get('/blog/tag/{tag}', 'PostController@viewByTag')->name('blog.tag');
Route::get('/blog/unread', 'PostController@viewUnreadOnly')->name('blog.unread');
Route::get('/blog/popular', 'PostController@viewMostPopular')->name('blog.popular');
Route::get('/blog/{category}', 'PostController@viewByCategory')->name('blog.category');
Route::get('blog/post/new', 'PostController@create')->name('blog.post.create');
Route::get('blog/post/edit/{id}', 'PostController@edit')->name('blog.post.edit');
Route::get('/blog/post/{id}/{title}', 'PostController@show')->name('blog.post');
Route::post('blog/post', 'PostController@store')->name('blog.post.store');
Route::put('/blog/post/{post}', 'PostController@update')->name('blog.post.update');
Route::post('/blog/post/comment', 'ReplyController@addComment')->name('blog.post.comment');

//Q&A routes
Route::get('/questions', 'QuestionController@index')->name('questions');
Route::get('/questions/category/{category}', 'QuestionController@viewByCategory')->name('question.showbycategory');
Route::get('/questions/tag/{tag}', 'QuestionController@viewByTag')->name('question.showbytag');
Route::get('/questions/popular', 'QuestionController@viewMostPopular')->name('question.popular');
Route::get('/question/ask', 'QuestionController@create')->name('question.create');
Route::post('/question/answer/up-vote', 'ReplyVoteController@upVote')->name('question.answer.up-vote');
Route::post('/question/answer/down-vote', 'ReplyVoteController@downVote')->name('question.answer.down-vote');
Route::post('/question/answer', 'ReplyController@answerQuestion')->name('question.answer');
Route::get('/question/{id}/{title}', 'QuestionController@show')->name('question.show');
Route::post('/question', 'QuestionController@store')->name('question.store');

Route::post('/post/like', 'PostLikeController@like')->name('post.like');
Route::post('/post/unlike', 'PostLikeController@unlike')->name('post.unlike');

Route::post('/reply/like', 'ReplyLikeController@like')->name('reply.like');
Route::post('/reply/unlike', 'ReplyLikeController@unlike')->name('reply.unlike');

Route::get('/admin', 'Admin\AdminController@index')->name('admin.home');
Route::get('/admin/experts', 'Admin\ExpertController@viewExperts')->name('admin.expert');
Route::get('/admin/expert/new', 'Admin\ExpertController@showAddExpertForm')->name('admin.expert.new');
Route::post('/admin/expert/new', 'Admin\ExpertController@addExpert')->name('admin.expert.store');
Route::delete('/admin/expert/delete', 'Admin\ExpertController@removeExpert')->name('admin.expert.delete');
Route::get('/admin/expert/{id}', 'Admin\ExpertController@viewExpert')->name('admin.expert.show');

Route::get('/admin/questions', 'Admin\QuestionController@index')->name('admin.questions');
Route::delete('/admin/question/delete', 'Admin\QuestionController@deleteQuestion')->name('admin.question.delete');
Route::get('/admin/question/{id}', 'Admin\QuestionController@viewQuestion')->name('admin.question.show');
Route::delete('/admin/question/answer/delete', 'Admin\QuestionController@deleteAnswer')->name('admin.question.answer.delete');