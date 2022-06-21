@can('accept',$model)
<a href="" title="Mark this answer as best answer" class="{{ $model->status }} mt-2"
    onclick="event.preventDefault(); document.getElementById('answers.accept-{{ $model->id }}').submit()">
    <i class="fas fa-check fa-2x"></i>
    <span class="favorites-count">123</span>
</a>
<form action="{{ route('answers.accept',$model->id) }}" id="answers.accept-{{ $model->id }}" method="POST"
    style="display: none">
    @csrf
</form>
@else
@if ($model->is_best)
<a href="" title="Question owner marked this answer as best answer" class="{{ $model->status }} mt-2"
    onclick="event.preventDefault();">
    <i class="fas fa-check fa-2x"></i>
    <span class="favorites-count">123</span>
</a>
@endif
@endcan
