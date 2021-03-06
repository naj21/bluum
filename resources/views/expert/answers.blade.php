@extends('expert.layout.profile')

@section('header_scripts')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hover.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <style>
        @media (max-width:1040px){
            .back-btn{
                position:absolute;
                top: 4%;
            }
        }
        @media (max-width:568px){
            .back-btn{
                position:absolute;
                top: 4%;
            }
        }
        @media (max-width:532px){
            .back-btn{
                position:absolute;
                top: 5%;
                left:5%;
            }
            .questions{
                padding:0px !important;
                box-shadow:2px 2px 5px rgb(165, 165, 165) !important;
            }
            td{
                padding:15px 5px !important;
            }
        }
    </style>
@endsection

@section('profile-main')
    <section class="questions">
        <div style="padding-left: 2rem" >
            @php
                if(auth()->user() && auth()->user()->role == 'EXPERT' && auth()->user()->id == $expert->id){
                    $backRoute = route('expert.profile');
                }else $backRoute = route('expert.show', $expert->id);
            @endphp
            <a href="{{ $backRoute }}" class="back-btn" ><i class="fa fa-arrow-left" ></i></a>
        </div>
        <div class="table-row">
            <div class="table-responsive bg-white">
                <h3 class="">Expert Answers</h3><hr>
                <table class="table table-borderless table-hover">
                    <thead>
                    <tr>
                        <th scope="" style="width:80%;font-size:20px">Post Title</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($answers as $answer)
                        <tr>
                            <td>{{ $answer->body }}{!! ($answer->correct) ? ' <div class="badge" style="background: #5F9377" >correct</div>' : '' !!}</td>
                            <td class="text-right" ><a href="{{ route('question.show', ['id'=>$answer->post->id, 'title'=>formatUrlString($answer->post->title)]) }}" class="" ><i class="fa fa-eye text-light"></i></a></td>
                            <td class="text-right" >
                                @if(auth()->user() && auth()->user()->role == 'EXPERT' && auth()->user()->id == $expert->id)
                                    <form action="{{ route('expert.post.reply.delete') }}" method="post" class="action-form" id="delete-answer-{{ $answer->id }}"  >
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="id" value="{{ $answer->id }}" >
                                        <button type="submit" style="background: transparent;border: none" ><i class="fa fa-trash text-danger"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    {{ $answers->links() }}
                </table>
            </div>
        </div>
    </section>
@endsection