@extends('layouts.app')

<!-- The Reply & Reply form pages -->
@section('content')

    <thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
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

                    <!---  replies section --->
                    <replies @added="repliesCount++" @removed="repliesCount--"></replies>

                </div>

                <!-- Middle space -->
                <div class="col-md-1"></div>

                <!-- Right Section -->
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>
                                This was published at <p style="color: lightgray; display: inline !important;">
                                    {{ $thread->created_at }}</p>
                                <br> by <a href="/profile/{{ $thread->creator->name }}" style="display: inline;">{{ $thread->creator->name }}</a> and currently
                                has <span v-text="repliesCount"></span> {{ str_plural('comment',$thread->replies_count) }}.

                            </h5>

                            @can ('update', $thread)
                                <form action="{{ $thread->path() }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">Delete </button>
                                </form>
                            @endcan
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </thread-view>

@endsection
