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
                        @include('shared._vote',['model' => $question])
                        <div class="card-body pt-4">
                            <div class="text-lg">

                                {!! $question->excerpt !!}

                            </div>
                            <div class="row mt-3">
                                <div class="col-4"></div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    @include('shared._author',['model' => $question,'label' => 'Asked' ])
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


            @include('answers._index',[
            'answers' => $question->answers,
            'answersCount' => $question->answers_count
            ])

    @include('answers._create')
</div>
@endsection
