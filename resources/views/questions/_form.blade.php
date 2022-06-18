@csrf

<div class="form-group">
    <label for="question-title" class="m-2">Quetion Title</label>
    <input type="text" name="title" id="question-title" value="{{ old('title',$question->title) }}"
        class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}">

    @if ($errors->has('title'))

    <div class="invalid-feedback">
        <strong>{{ $errors->first('title') }}</strong>
    </div>

    @endif
</div>
<div class="form-group">
    <label for="question-body" class="m-2">Explain your Question</label>
    <textarea name="body" id="question-body" rows="10"
        class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}">{{ old('body',$question->body) }}</textarea>
    @if ($errors->has('body'))

    <div class="invalid-feedback">
        <strong>{{ $errors->first('body') }}</strong>
    </div>

    @endif
</div>
<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-lg m-2">{{ $buttonText }}</button>
</div>
