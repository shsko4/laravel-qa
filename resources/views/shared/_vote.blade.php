@if ($model instanceof App\Models\Question)

    @php
        $name = 'question';
        $firstURISegment = 'questions';
    @endphp
@elseif ($model instanceof App\Models\Answer)

    @php
        $name = 'answer';
        $firstURISegment = 'answers';
    @endphp

@endif

<div class="flex-col  vote-controls">
    <a href="" title="this {{ $name }} is useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}" onclick="event.preventDefault(); document.getElementById('up-vote-{{ $name }}-{{ $model->id }}').submit()">
        <i class="fas fa-caret-up fa-3x"></i>
    </a>
    <form action="/{{ $firstURISegment }}/{{ $model->id }}/vote"
        id="up-vote-{{ $name }}-{{ $model->id }}" style="display: none" method="post">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    <span class="votes-count">{{ $model->votes_count }}</span>
    <a href="" title="this model is not useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}" onclick="event.preventDefault(); document.getElementById('down-vote-{{ $name }}-{{ $model->id }}').submit()">
        <i class="fas fa-caret-down fa-3x"></i>
    </a>
    <form action="/{{ $firstURISegment }}/{{ $model->id }}/vote"
        id="down-vote-{{ $name }}-{{ $model->id }}" style="display: none" method="post">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>
    @if ($model instanceof App\Models\Question)

        @include('shared._favorite',['model' => $model])

    @elseif ($model instanceof App\Models\Answer)

        @include('shared._accept',['model' => $model])

    @endif

</div>
