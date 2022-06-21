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
                                class="favorite mt-2 {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '') }}" onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit()">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorites-count">{{ $question->favorites_count }}</span>
                            </a>
                            <form action="/questions/{{ $question->id }}/favorites"
                                id="favorite-question-{{ $question->id }}" style="display: none" method="post">
                                @csrf
                                @if ($question->is_favorited)
                                    @method('DELETE')
                                @endif
                            </form>
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

        @if ($question->answers_count > 0)
            @include('answers._index',[
            'answers' => $question->answers,
            'answersCount' => $question->answers_count
            ])
        @endif

    @include('answers._create')
</div>
@endsection
