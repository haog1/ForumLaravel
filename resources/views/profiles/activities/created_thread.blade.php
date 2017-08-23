
@component('profiles.activities.activity')

    @slot('heading')
        {{ $profileUser->name }} published

        <a href="{{ $activity->subject->path() }}" style="display: inline-block !important;">
            {!! $activity->subject->title !!}
        </a> at {{ $activity->subject->created_at->diffForHumans() }}
    @endslot

    @slot('body')
        {!! $activity->subject->body !!}
    @endslot

@endcomponent



