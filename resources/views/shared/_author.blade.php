<span class="text-muted text-sm">{{$label ." ". $model->created_date }}</span>
                                    <div class="flex">
                                        <a href="{{ $model->user->url }}" class="pr-2">
                                            <img src="{{ $model->user->avatar }}" alt="">
                                        </a>
                                        <div class="mb-4">
                                            <a href="{{ $model->user->url }}">{{ $model->user->name }}</a>
                                        </div>
                                    </div>
