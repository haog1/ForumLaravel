@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 ">
                <div class="page-header">
                    <!--write cover image here-->
                    <h1>
                        {{ $profileUser->name }}
                        <small>Since: {{ $profileUser->created_at->diffForHumans() }}</small>
                    </h1>
                </div>

                @foreach ($threads as $thread)

                    @include('threads.article')

                @endforeach

                {{ $threads->links() }}
            </div>
        </div>
    </div>

@endsection