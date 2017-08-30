
@component('profiles.activities.activity')

    @slot('heading')

        @if ($profileUser->id == auth()->id())
            You replied to
        @else
            {{ $profileUser->name }} replied to
        @endif

        {{--Reply need a thread attribute so add a function in Reply.php--}}
        <a href="{{ $activity->subject->thread->path() }}" style="display: inline-block !important;">
            {!! $activity->subject->thread->title !!}
        </a> at {{ $activity->subject->created_at->diffForHumans() }}

    @endslot

    @slot('body')
        {!! $activity->subject->body !!}
    @endslot

@endcomponent



