@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mb-0">All Questions</div>

                <div class="card-body">
                   @foreach ($questions as $question)

                   <div class="media">

                        <h3 class="mb-2 mt-1 font-bold">{{ $question->title }}</h3>
                        <div class="media-body">
                        {{ str_limit($question->body, 250) }}
                        <hr>
                    </div>
                   </div>

                   @endforeach

                   <div class="flex justify-center">{{ $questions->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection