@extends('layouts.app')

<!-- The Create Thread Form page -->

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">

                    <div class="panel-heading">Create a New Thread</div>

                    <div class="panel-body">

                        <!--- Form Field --->

                        <form method="POST" action="/threads">

                            {{ csrf_field() }}

                            <div class="form-group">

                                <label for="channel_id">Channel:</label>

                                <select name="channel_id" id="channel_id" class="form-control">

                                    <option value="">Choose One...</option>

                                    @foreach($channels as $channel)

                                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>

                                            {{ $channel->name }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group">

                                <label for="title">Title:</label>

                                <input type="text" name="title" class="form-control" id="id" placeholder="title"
                                       value="{{ old('title') }}" required>

                            </div>

                            <!--- Field --->
                            <div class="form-group">

                                <label for="body">Body:</label>

                                <textarea name="body" class="form-control" rows="15" placeholder="Have something to say?" required>{{ old('body') }}
                                </textarea>

                                <br>

                                <div class="form-group">

                                    <button type="submit" class="btn btn-primary">Publish</button>

                                </div>

                                @if(count($errors))

                                    <ul class="alert alert-danger">

                                        @foreach($errors->all() as $error)

                                            <li>{{ $error }}</li>

                                        @endforeach

                                    </ul>

                            @endif

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>


@endsection
