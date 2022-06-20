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
                            <div class="row mt-3">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update',$answer)
                                        <a href="{{ route('questions.answers.edit',[$question->id,$answer->id]) }}"
                                            class="btn btn-sm btn-outline-info">Edit</a>
                                        @endcan
                                        @can('delete',$answer)
                                        <form action="{{ route('questions.answers.destroy',[$question->id,$answer->id]) }}" method="POST"
                                            class="form-delete">
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
