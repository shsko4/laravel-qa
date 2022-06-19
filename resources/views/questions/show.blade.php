@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">

                        <div class="d-flex align-items-center">

                            <h1 class="font-bold text-lg">{{ $question->title }}</h1>

                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to
                                    Questions</a>
                            </div>

                        </div>


                    </div>

                    <hr>

                    <div class="d-flex mb-3">
                        <div class="flex-col  vote-controls">
                            <a href="" title="this question is useful" class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">1230</span>
                            <a href="" title="this question is not useful" class="vote-down off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a href="" title="click to mark as favorite Question (click again to undo)"
                                class="favorite mt-2 favorited">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorites-count">123</span>
                            </a>
                        </div>
                        <div class="media-body pt-4">
                            <div class="text-lg">

                                {!! $question->body_html !!}

                            </div>

                            <div class="float-right">
                                <span class="text-muted text-sm">Asked {{ $question->created_date }}</span>
                                <div class="flex">
                                    <a href="{{ $question->user->url }}" class="pr-2">
                                        <img src="{{ $question->user->avatar }}">
                                    </a>
                                    <div class="mb-1">
                                        <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{ $question->answers_count ." ". str_plural(' Answer', $question->answers_count) }}</h2>
                    </div>
                    <hr>
                    @foreach ($question->answers as $answer)

                    <div class="card mb-2">

                        <div class="d-flex">
                            <div class="flex-col  vote-controls">
                                <a href="" title="this answer is useful" class="vote-up">
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <span class="votes-count">1230</span>
                                <a href="" title="this answer is not useful" class="vote-down off">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <a href="" title="Mark this answer as best answer" class="vote-accepted mt-2">
                                    <i class="fas fa-check fa-2x"></i>
                                    <span class="favorites-count">123</span>
                                </a>
                            </div>
                            <div class="card-body mt-4">
                                {!! $answer->body_html !!}
                                <div class="float-right">
                                    <span class="text-muted text-sm">Answered {{ $answer->created_date }}</span>
                                    <div class="flex">
                                        <a href="{{ $answer->user->url }}" class="pr-2">
                                            <img src="{{ $answer->user->avatar }}" alt="">
                                        </a>
                                        <div class="mb-4">
                                            <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <hr>

                        </div>
                    </div>


                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
