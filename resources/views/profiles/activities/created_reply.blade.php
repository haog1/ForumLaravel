
@component('profiles.activities.activity')

    @slot('heading')
        {{ $profileUser->name }} replied to

        {{--Reply need a thread attribute so add a function in Reply.php--}}
        <a href="{{ $activity->subject->thread->path() }}" style="display: inline-block !important;">
            {!! $activity->subject->thread->title !!}
        </a> at {{ $activity->subject->created_at->diffForHumans() }}

    @endslot

    @slot('body')
        {!! $activity->subject->body !!}
    @endslot

@endcomponent



