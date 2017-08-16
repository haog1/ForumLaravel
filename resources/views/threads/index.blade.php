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

                                <div class="level">

                                    <h4 class="flex">
                                        <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                                    </h4>

                                    <a href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</a>


                                </div>

                                <p>
                                    <a href="#">{{ $thread->creator->name }}</a>
                                    posted at: {{ $thread->created_at->diffForHumans() }}
                                </p>
                                <div class="fr-view">
                                    {!! $thread->body !!}
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
