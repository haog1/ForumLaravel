@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="page-header" style="margin-top: 150px !important;">

                @if($profileUser->id == auth()->id())

                    <h1>Hello {{ $profileUser->name }},
                        <small>Since: {{ $profileUser->created_at->diffForHumans() }}</small></h1>
                @else
                    <h1>{{ $profileUser->name }},
                        <small>Since: {{ $profileUser->created_at->diffForHumans() }}</small></h1>
                @endif

        </div>

        <div class="row">

            <div class="col-md-8">

                @forelse ($activities as $date => $activity)

                    <h3 class="page-header">{{ $date }}</h3>

                    @foreach ($activity as $record)

                        @include ("profiles.activities.{$record->type}", ['activity' => $record])

                    @endforeach

                @empty
                    <h1 class="col-md-12 col-md-offset-6" style="text-align: center; margin:60px 0 60px 0; color: lightgrey">Currently no activities yet.</h1>


                @endforelse
            </div>

        </div>
    </div>

@endsection