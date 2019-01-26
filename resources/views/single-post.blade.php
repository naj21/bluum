@extends('layouts.app-temp')

@section('header_scripts')
    <style>
        .topic__footer-likes div a{
            margin-left: 7.5px;
            margin-right: 7.5px;
        }
        #post-unlike i{
            color: red;
        }
    </style>
@endsection
@section('content')
    @include('widgets.top-nav-bar')
    <main>
        <div class="container">
            <div class="nav">
                <div class="nav__categories js-dropdown">
                    <div class="nav__select">
                        <a href="/blog" class="nav__thread-btn nav__thread-btn--prev"><i class="icon-Arrow_Left"></i>Back</a>
                    </div>
                </div>
            </div>
            <div class="topics">
                <div class="topics__heading">
                    @if(auth()->user())
                        @if(auth()->user()->id == $post->user_id)
                            <div class="text-right" >
                                <a href="/blog/post/edit/{{ $post->id }}" >
                                    <button class="btn btn-success" >EDIT</button>
                                </a>
                            </div>
                        @endif
                    @endif
                    <h2 class="topics__heading-title">{{ ucwords($post->title) }}</h2>
                    <div class="topics__heading-info">
                        <a href="#" class="category"><i class="bg-3ebafa"></i>{{ ucfirst($post->category) }}</a>
                        @if ($post->tags)
                            <div class="tags">
                                @php $tags = explode(',', $post->tags); @endphp
                                @foreach ($tags as $tag)
                                    <a href="#" class="bg-4f80b0">{{ $tag }}</a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="topics__body">
                    <div class="topics__content">
                        <div class="topic">
                            <div class="topic__head">
                                <div class="topic__avatar">
                                    <a href="#" class="avatar"><img src="{{ asset('fonts/icons/avatars/'.$post->user->firstname[0].'.svg') }}" alt="avatar"></a>
                                </div>
                                <div class="topic__caption">
                                    <div class="topic__name">
                                        <a href="#">{{ ucwords($post->user->firstname." ".$post->user->lastname) }}</a>
                                    </div>
                                    <div class="topic__date"><i class="icon-Watch_Later"></i>{{ date("h:ia d M, Y", strtotime($post->created_at)) }}</div>
                                </div>
                            </div>
                            <div class="topic__content">
                                <div class="topic__text">
                                    <p>{!! $post->body !!}</p>
                                </div>
                                <div class="topic__footer">
                                    <div class="topic__footer-likes">
                                        <div>
                                            @guest
                                                <a href="#" class="post-like" id="post-like" data-target="{{ $post->id }}" ><i class="icon-Favorite_Topic" ></i></a>
                                            @else
                                                <a href="#" class="post-like" id="{{ $liked ? "post-unlike" : "post-like" }}" data-target="{{ $post->id }}" ><i class="icon-Favorite_Topic" ></i></a>
                                            @endguest
                                            <span id="post-{{$post->id}}-likes" >{{ $post->likes }}</span>
                                        </div>
                                    </div>
                                    <div class="topic__footer-share">
                                        <div data-visible="desktop">
                                            <a href="#"><i class="icon-Share_Topic"></i></a>
                                            <a href="#"><i class="icon-Flag_Topic"></i></a>
                                            <a href="#"><i class="icon-Bookmark"></i></a>
                                        </div>
                                        <div data-visible="mobile">
                                            <a href="#"><i class="icon-More_Options"></i></a>
                                        </div>
                                        <a href="#"><i class="icon-Reply_Fill"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="comment" >
                            <form action="{{ route('blog.post.comment') }}" method="post">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}" >
                                @if ($errors->has('body'))
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong><p>{{ $errors->first('body') }}</p></strong>
                                    </span>
                                @endif
                                <div class="form-group" >
                                    <textarea class="form-control" name="body" style="resize: none" rows="5" ></textarea>
                                </div>
                                <div class="form-group text-right" >
                                    <input type="submit" class="btn btn-success" value="Comment" >
                                </div>
                            </form>
                        </div>
                        @foreach ($post->replies as $reply)
                            @php $userLikedReply = userLikedReply($reply->id); @endphp
                            <div class="topic topic--comment" id="reply-{{ $reply->id }}" >
                                <div class="topic__head">
                                    <div class="topic__avatar">
                                        <a href="#" class="avatar"><img src="{{ asset('fonts/icons/avatars/'.ucfirst($reply->user->firstname[0]).'.svg') }}" alt="avatar"></a>
                                    </div>
                                    <div class="topic__caption">
                                        <div class="topic__name">
                                            <a href="#">{{ ucwords($reply->user->lastname.' '.$reply->user->firstname) }}</a>
                                        </div>
                                        <div class="topic__date">
                                            @if ($reply->recipient)
                                                <div class="topic__user topic__user--pos-r">
                                                    <i class="icon-Reply_Fill"></i>
                                                    <a href="#" class="avatar"><img src="{{ asset('fonts/icons/avatars/'.ucfirst($reply->recipient[0]).'.svg') }}" alt="avatar"></a>
                                                    <a href="#" class="topic__user-name">{{ ucwords($reply->recipient) }}</a>
                                                </div>
                                            @endif
                                            <p><i class="icon-Watch_Later"></i>{{ date("h:ia d M, Y", strtotime($reply->created_at)) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="topic__content">
                                    <div class="topic__text">
                                        <p>{{ $reply->body }}</p>
                                    </div>
                                    <div class="topic__footer">
                                        <div class="topic__footer-likes">
                                            <div>
                                                @guest
                                                    <a href="#" class="reply-like" data-id="{{ $reply->id }}" ><i class="icon-Favorite_Topic"></i></a>
                                                @else
                                                    <a href="#" class="{{ ($userLikedReply) ? 'reply-unlike' : 'reply-like' }}" data-id="{{ $reply->id }}" ><i class="icon-Favorite_Topic"></i></a>
                                                @endguest
                                                <span id="reply-{{ $reply->id }}-likes" >{{ $reply->likes }}</span>
                                            </div>
                                            <div>
                                                <a href="#" data-id="{{ $reply->user_id }}" class="reply-comment" data-name="{{ strtolower($reply->user->firstname.' '.$reply->user->lastname) }}" ><i class="icon-Reply_Empty"></i></a>
                                                <span class="" ></span>
                                            </div>
                                        </div>
                                        <div class="topic__footer-share">
                                            <div data-visible="desktop">
                                                <a href="#"><i class="icon-Share_Topic"></i></a>
                                                <a href="#"><i class="icon-Flag_Topic"></i></a>
                                                <a href="#" class="active" ><i class="icon-Already_Bookmarked"></i></a>
                                            </div>
                                            <div data-visible="mobile">
                                                <a href="#"><i class="icon-More_Options"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="topics__title"><i class="icon-Watch_Later"></i>This topic will has been closed.</div>
                <div class="topics__control">
                    <a href="#" class="btn"><i class="icon-Bookmark"></i>Bookmark</a>
                    <a href="#" class="btn"><i class="icon-Share_Topic"></i>Share</a>
                    <a href="#" class="btn btn--type-02" data-visible="desktop"><i class="icon-Reply_Fill"></i>Reply</a>
                </div>
                <div class="topics__title">Suggested Posts</div>
            </div>
            <div class="posts">
                <div class="posts__head">
                    <div class="posts__topic">Post</div>
                    <div class="posts__category">Category</div>
                    <div class="posts__users">Written By</div>
                    <div class="posts__replies">Replies</div>
                    <div class="posts__views">Views</div>
                    <div class="posts__activity">Activity</div>
                </div>
                <div class="posts__body">
                    @php $counter = 1; @endphp
                    @foreach($related as $post)
                        <div class="posts__item {{ ($counter%2 == 0) ? 'bg-f2f4f6' : '' }}">
                            @php $counter++; @endphp
                            <div class="posts__section-left">
                                <div class="posts__topic">
                                    <div class="posts__content">
                                        <a href="/blog/post/{{ $post->id }}/{{ formatUrlString($post->title) }}">
                                            <h3>{{ $post->title }}</h3>
                                        </a>
                                        <div class="posts__tags tags">
                                            @php $r_tags = explode(",", $post->tags) @endphp
                                            @foreach($r_tags as $tag)
                                                <a href="#" class="bg-4f80b0">{{ $tag }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="posts__category"><a href="/blog/{{ urlencode($post->category) }}" class="category"><i class="bg-368f8b"></i>{{ ucfirst($post->category) }}</a></div>
                            </div>
                            <div class="posts__section-right">
                                <div class="posts__users"><a class="category"><i class="bg-368f8b"></i>{{ ucfirst($post->user->lastname) }}</a></div>
                                <div class="posts__replies">{{ count($post->replies) }}</div>
                                <div class="posts__views">{{ $post->views }}</div>
                                <div class="posts__activity">{{ getLastActivityTime($post->updated_at) }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    @include('widgets.footer')
@endsection

@section('scripts')
    <script>
        let running = false;

        $(".reply-like, .reply-unlike").click(function (e) {

            e.preventDefault();
            if(running) {
                alert("Don't click multiple times");
                return false;
            }

            running = true;
            let url = '';
            let likeBtn = $(this);
            let reply_id = $(this).attr('data-id');
            if (likeBtn.attr('class') === 'reply-like') url = '{{ route('reply.like') }}'; else url = '{{ route('reply.unlike') }}';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: url,
                data: { reply_id:reply_id },
            }).done(function(data){
                if(data !== 'false' && data !== ''){
                    $(`#reply-${reply_id}-likes`).html(data);
                    if(likeBtn.attr('class') === "reply-like") likeBtn.attr("class", "reply-unlike"); else likeBtn.attr("class", "reply-like");
                    running = false;
                }
            }).fail(function(e){
                if(e.status === 401) alert('You need to be logged in');
            });
        });

        $(".post-like").click(function(e){

            e.preventDefault();

            if(running) {
                alert("Don't click multiple times");
                return false;
            }

            running = true;
            let url = "";
            let likeBtn = $(this);
            if(likeBtn.attr('id') === "post-like") url = "{{ route('post.like') }}"; else url = "{{ route('post.unlike') }}";
            let post_id = $(this).attr('data-target');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: url,
                data: { post_id:post_id },
            }).done(function(data){
                if(data !== 'false' && data !== ''){
                    $(`#post-${post_id}-likes`).html(data);
                    if(likeBtn.attr('id') === "post-like") likeBtn.attr("id", "post-unlike"); else likeBtn.attr("id", "post-like");
                    running = false;
                }
            }).fail(function(e){
                if(e.status === 401) alert('You need to be logged in');
            });
        });
    </script>
@endsection
