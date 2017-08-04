@extends('layouts.app')

<!-- Show all threads -->
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">All Threads</div>

                    <div class="panel-body">

                        @foreach($threads as $thread)

                            <article>

                                <h4>
                                    <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                                </h4>
                                <p>
                                    <a href="#">{{ $thread->creator->name }}</a> posted at: {{ $thread->created_at }}
                                </p>
                                <div class="body">
                                    {{ $thread->body }}
                                </div>
                                <hr>

                            </article>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
