@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $thread->title }}</div>

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

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="#">
                                {{ $reply->owner->name }}
                            </a>
                            <p style="color:gray; display: inline !important;"> said </p>{{ $reply->created_at->diffForHumans() }}...
                        </div>

                        <div class="panel-body">

                            {{ $reply->body }}

                        </div>
                    </div>

                @endforeach

            </div>
        </div>

    </div>
@endsection
