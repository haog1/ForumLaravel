@extends('layouts.app')

<!-- The Reply & Reply form page -->
@section('content')
    <div class="container">
        <div class="row">

            <!-- Left Section -->
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="level">
                            <span class="flex">
                                {{ $thread->title }}
                            </span>
                            <p style=" color: lightgray; display: inline !important;">
                                at: {{ $thread->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div class="panel-body">
                        {!! $thread->body !!}
                    </div>
                </div>


                @forelse($replies as $reply)

                    @include('threads.reply')

                @empty
                    <h5 style="margin:60px 0 60px 0; color: lightgrey">Currently no comments yet. Be the first one to comment.</h5>

                @endforelse

                {{ $replies->links() }}

            <!-- Reply Form Section -->
                @if(auth::check())

                    <form method="POST" action="{{ $thread->path().'/replies' }}">

                    {{ csrf_field() }}

                    <!---  Field --->
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Post</button>

                    </form>
                @else
                    <div style="text-align: center !important;">
                        <p class="text-center" style="display: inline;">Please <a href="{{ route('login') }}" style="display: inline;">sign in</a> to comment.</p>
                    </div>
                @endif
            </div>


        {{--<div class="col-md-1"></div>--}}

        <!-- Right Section -->
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>
                            This was published at <p style="color: lightgray; display: inline !important;">
                                {{ $thread->created_at }}</p>
                            <br> by <a href="/profile/{{ $thread->creator->name }}" style="display: inline;">{{ $thread->creator->name }}</a> and currently
                            has {{ $thread->replies_count }} {{ str_plural('comment',$thread->replies_count) }}.

                        </h5>

                        @can ('update', $thread)
                            <form action="{{ $thread->path() }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-link">Delete </button>
                            </form>
                        @endcan
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
