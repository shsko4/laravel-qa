<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount ." ". str_plural(' Answer', $question->answers_count) }}</h2>
                </div>
                <hr>

                @include('layouts._messeges')

                @foreach ($answers as $answer)

                <div class="card mb-2">

                    <div class="d-flex">
                        @include('shared._vote',['model' => $answer])
                        <div class="card-body mt-4">
                            {!! $answer->body_html !!}
                            <div class="row mt-3">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update',$answer)
                                        <a href="{{ route('questions.answers.edit',[$question->id,$answer->id]) }}"
                                            class="btn btn-sm btn-outline-info">Edit</a>
                                        @endcan
                                        @can('delete',$answer)
                                        <form
                                            action="{{ route('questions.answers.destroy',[$question->id,$answer->id]) }}"
                                            method="POST" class="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('are you sure?')">Delete</button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    @include('shared._author',[
                                        'model' => $answer,
                                        'label' => 'Answered'
                                    ])

                                </div>
                            </div>

                        </div>
                        <hr>

                    </div>
                </div>


                @endforeach
            </div>
        </div>
    </div>
</div>
