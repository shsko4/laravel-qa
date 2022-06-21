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
                            <a href="" title="this answer is useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}" onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit()">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <form action="/answers/{{ $answer->id }}/vote"
                                id="up-vote-answer-{{ $answer->id }}" style="display: none" method="post">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            <span class="votes-count">{{ $answer->votes_count }}</span>
                            <a href="" title="this answer is not useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}" onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit()">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <form action="/answers/{{ $answer->id }}/vote"
                                id="down-vote-answer-{{ $answer->id }}" style="display: none" method="post">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
                            @can('accept',$answer)
                                <a href="" title="Mark this answer as best answer" class="{{ $answer->status }} mt-2"
                                    onclick="event.preventDefault(); document.getElementById('answers.accept-{{ $answer->id }}').submit()">
                                    <i class="fas fa-check fa-2x"></i>
                                    <span class="favorites-count">123</span>
                                </a>
                                <form action="{{ route('answers.accept',$answer->id) }}"
                                    id="answers.accept-{{ $answer->id }}" method="POST" style="display: none">
                                    @csrf
                                </form>
                            @else
                                @if ($answer->is_best)
                                    <a href="" title="Question owner marked this answer as best answer" class="{{ $answer->status }} mt-2"
                                        onclick="event.preventDefault();">
                                        <i class="fas fa-check fa-2x"></i>
                                        <span class="favorites-count">123</span>
                                    </a>
                                @endif
                            @endcan


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

                    </div>
                </div>


                @endforeach
            </div>
        </div>
    </div>
</div>
