@extends('layouts.app')

<!-- Show all threads -->
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @forelse($threads as $thread)

                    @include('threads.article')

                @empty
                    <h1>Nothing here... Take a rest</h1>
                @endforelse

            </div>
            {{--<a href="#" id="loadMore">Load More</a>--}}
            <div class="col-md-1"></div>

            <div class="col-md-3">
                {{--<br><br>--}}
                <div class="panel panel-default" style="border: 0">
                    <div class="panel-body">

                        <div>
                            <h4>
                                <a href="/threads/create" style="text-align: center">Write Now</a>
                            </h4>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
