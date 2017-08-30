
@component('profiles.activities.activity')

    @slot('heading')

        @if ($profileUser->id == auth()->id())
            You <p style="display:inline;color: #5cb85c">liked</p>
        @else
            {{ $profileUser->name }} <p style="display:inline;color: #5cb85c">liked</p> a reply.
        @endif

        {{--Reply need a thread attribute so add a function in Reply.php--}}
        <a href="{{ $activity->subject->favorited->path() }}" style="display: inline-block !important;">
            {!! $activity->subject->favorited->thread->title !!}
        </a> at {{ $activity->subject->favorited->created_at->diffForHumans() }}

    @endslot

    @slot('body')
        {!! $activity->subject->favorited->body !!}
    @endslot

@endcomponent



