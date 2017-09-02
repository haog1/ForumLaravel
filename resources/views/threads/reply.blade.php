
<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div id="reply-{{ $reply->id }}" class="panel panel-default">
        <div class="panel-primary">
            <div class="level">
                <h5 class="flex">
                    <a href="/profile/{{ $reply->owner->name }}" style="margin-left:10px; display: inline-block;">{{ $reply->owner->name }}</a> &nbsp said {{ $reply->created_at->diffForHumans() }}...
                </h5>

                @if (Auth::check())
                    <div>
                        <favorite :reply="{{ $reply }}"></favorite>
                    </div>
                @endif
            </div>
        </div>

        <div class="panel-body">

            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body" rows="15"></textarea>
                </div>
                <button class="btn btn-xs btn-primary" @click="update">Update</button>
                <button class="btn btn-xs btn-link" @click="editing = false">Cancel</button>
            </div>

            <div v-else v-html="body"></div>

        </div>

        @can('update', $reply)
            <div class="panel-footer level">

                <button class="btn btn-primary btn-xs mr-1" @click="editing = true">Edit</button>

                <form method="POST" action="/replies/{{ $reply->id }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                </form>

            </div>
        @endcan
    </div>
</reply>