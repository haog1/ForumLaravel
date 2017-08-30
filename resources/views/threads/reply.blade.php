<div class="panel panel-default">
    <div class="panel-primary">
        <div class="level">
            <h5 class="flex">
            <a href="/profile/{{ $reply->owner->name }}" style="margin-left:10px; display: inline-block;">{{ $reply->owner->name }}</a> &nbsp said {{ $reply->created_at->diffForHumans() }}...
            </h5>

            <div>
                {{--{{ $reply->favorites()->count() }}--}}
                <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-default" {{ $reply->isFavorited() ? 'disabled' : '' }} style="margin-right: 5px;">

                        {{ $reply->favorites_count }} {{ str_plural('Like', $reply->favorites_count) }}

                    </button>

                </form>

            </div>
            
        </div>
    </div>

    <div class="panel-body">

        {!! $reply->body !!}

    </div>
</div>