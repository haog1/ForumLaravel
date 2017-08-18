@extends('layouts.app')


@section('content')

    {{--{{ dd($channels) }}--}}

    <div class="row">
        <div class="container">
            @foreach( $channels as $channel )

                <div class="col-md-2">
                    {{--<br><br>--}}
                    <div class="panel panel-default">
                        <div class="panel-heading">

                            <div>
                                <h4>
                                    <a href="/threads/{{$channel->slug}}" style="text-align: center">{{ $channel->name }}</a>
                                </h4>

                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection