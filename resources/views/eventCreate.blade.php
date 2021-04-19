@extends('layouts.app')

@section('content')
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>jQuery UI Datepicker - Display month &amp; year menus</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $( function() {
                $( "#datepicker" ).datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true
                });
            } );
        </script>
    </head>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create band</div>
                    <br/>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ url('events') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('eventDate') ? ' has-error' : '' }}">
                                <label for="eventDate" class="col-md-4 control-label">Event Date</label>

                                <div class="col-md-6">
                                    <input id="datepicker" type="text" class="form-control" name="eventDate" value="{{ old('eventDate') }}">

                                    @if ($errors->has('eventDate'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('eventDate') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                                <label for="location" class="col-md-4 control-label">Event location</label>

                                <div class="col-md-6">
                                    <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}">

                                    @if ($errors->has('location'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('event_description') ? ' has-error' : '' }}">
                                <label for="event_description" class="col-md-4 control-label">Event description</label>

                                <div class="col-md-6">
                                    <input id="event_description" type="text" class="form-control" name="event_description" value="{{ old('event_description') }}">

                                    @if ($errors->has('event_description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('event_description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('userBand') ? ' has-error' : '' }}">
                                <label for="userBand" class="col-md-4 control-label">Bands</label>
                                <div class="col-md-6">
                                    <select name="userBand" id="userBand">
                                        @foreach($userBands as $userBand)
                                            <option value="{{ $userBand->id}}">{{ $userBand->band_name}}</option>
                                        @endforeach
                                    </select>
                                    <a class="btn btn-primary" href="{{ URL::to('add_band') }}">Add band</a>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</html>
