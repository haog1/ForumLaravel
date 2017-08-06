@extends('layouts.app')

<!-- The Reply & Reply form page -->
@section('content')
    <div class="container">
        <div class="row">

            <!-- Left Section -->

            <div class="col-md-8">
                <div class="panel panel-primary">

                    <div class="panel-heading">
                        {{ $thread->title }} <p style=" color: lightgray; display: inline !important;">
                            at: {{ $thread->created_at->diffForHumans() }}</p>
                    </div>

                    <div class="panel-body">
                        {{ $thread->body }}
                    </div>

                </div>

                <!-- Show each single reply -->
                @foreach($replies as $reply)
                    @include('threads.reply')
                @endforeach
                {{ $replies->links() }}

                <!-- Reply Form Section -->
                @if(auth::check())

                    <form method="POST" action="{{ $thread->path().'/replies' }}">

                        {{ csrf_field() }}

                        <!---  Field --->
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Post</button>

                    </form>
                @else
                    <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to comment.</p>
                @endif
            </div>


            <!-- Right Section -->
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>
                            This was published at <p style="color: lightgray; display: inline !important;">
                                {{ $thread->created_at }}</p> by
                            <a href="#">{{ $thread->creator->name }}</a> and currently
                            has {{ $thread->replies_count }} {{ str_plural('comment',$thread->replies_count) }}.

                        </h5>

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
