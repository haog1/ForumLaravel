@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#">{{ $thread->creator->name }}</a> posted: {{ $thread->title }}</div>

                    <div class="panel-body">

                    {{ $thread->body }}

                    </div>
                </div>
            </div>
        </div>

        <!-- Replies Section -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                @foreach($thread->replies as $reply)

                    @include('threads.reply')

                @endforeach

            </div>
        </div>

        <!-- Reply Form Section -->
        @if(auth::check())

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form method="POST" action="{{ $thread->path().'/replies' }}">

                    {{ csrf_field() }}

                    <!---  Field --->
                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                    </div>

                    <button type="submit" class="btn btn-default">Post</button>

                </form>
            </div>
        </div>
        @else
            <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to comment.</p>


        @endif

    </div>
@endsection
