@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="page-header">
            <h1>
                {{ $profileUser->name }}
                <small>Since: {{ $profileUser->created_at->diffForHumans() }}</small>
            </h1>
        </div>

        @foreach ($profileUser->threads as $thread)
            <div class="panel panel-primary">

                <div class="panel-heading">
                    {{ $thread->title }} <p style=" color: lightgray; display: inline !important;">
                        at: {{ $thread->created_at->diffForHumans() }}</p>
                </div>

                <div class="panel-body">
                    {!! $thread->body !!}
                </div>

            </div>
        @endforeach
    </div>

@endsection