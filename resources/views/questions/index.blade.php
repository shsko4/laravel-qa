@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    @include('layouts._messeges')

                    <div class="d-flex align-items-center">

                        <h2>All Questions</h2>

                        <div class="ml-auto">
                            <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask Question</a>
                        </div>

                    </div>


                </div>


                <div class="card-body">
                    @forelse ($questions as $question)

                    <div class="d-flex mb-3">
                        <div class="flex-col counters">
                            <div class="vote">
                                <strong>{{ $question->votes_count }}</strong> {{ str_plural('vote',$question->votes_count) }}
                            </div>
                            <div class="status {{ $question->status }}">
                                <strong>{{ $question->answers_count }}</strong> {{ str_plural('answer',$question->answers_count) }}
                            </div>
                            <div class="view">
                                {{ $question->views . " " . str_plural('view',$question->views) }}
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="d-flex align-items-center">
                                <h3 class="mb-2 font-bold text-lg text-blue-600"><a href="{{ $question->url }}">{{
                                        $question->title }}</a></h3>
                                <div class="ml-auto">
                                    @can('update',$question)
                                    <a href="{{ route('questions.edit',$question->id) }}"
                                        class="btn btn-sm btn-outline-info">Edit</a>
                                    @endcan
                                    @can('delete',$question)
                                    <form action="{{ route('questions.destroy',$question->id) }}" method="POST"
                                        class="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('are you sure?')">Delete</button>
                                    </form>
                                    @endcan

                                </div>

                            </div>

                            <p class="lead">
                                Asked by
                                <a href="{{ $question->user->url }}" class="text-blue-500">{{ $question->user->name
                                    }}</a>
                                <small class="text-muted">{{ $question->created_date }}</small>
                            </p>
                            <div class="excerpt">{{ $question->excerpt(400) }}</div>
                            <hr>
                        </div>
                    </div>
                    @empty
                        <div class="alert alert-warning">
                            <strong>Sorry there is no Questions to show yet!</strong>
                        </div>
                    @endforelse

                    <div class="flex justify-center">{{ $questions->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
