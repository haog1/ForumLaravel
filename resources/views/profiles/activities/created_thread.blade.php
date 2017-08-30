
@component('profiles.activities.activity')

    @slot('heading')


            @if ($profileUser->id == auth()->id())
                You <p style="display:inline;color: #ff6666">published </p> to
            @else
                {{ $profileUser->name }} <p style="display:inline;color: #ff6666">published </p> to
            @endif

        <a href="{{ $activity->subject->path() }}" style="display: inline-block !important;">
            {!! $activity->subject->title !!}
        </a> at {{ $activity->subject->created_at->diffForHumans() }}
    @endslot

    @slot('body')
        {!! $activity->subject->body !!}
    @endslot

@endcomponent



