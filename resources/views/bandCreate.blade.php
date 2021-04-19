@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create band</div>
                    <br/>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('store_band') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('band_name') ? ' has-error' : '' }}">
                                <label for="band_name" class="col-md-4 control-label">Band name</label>

                                <div class="col-md-6">
                                    <input id="band_name" type="text" class="form-control" name="band_name" value="{{ old('band_name') }}">
                                    @if ($errors->has('band_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('band_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('band_photo') ? ' has-error' : '' }}">
                                <label for="band_photo" class="col-md-4 control-label">Band photo</label>

                                <div class="col-md-6">
                                    <input type="file" id="band_photo"  class="form-control" name="band_photo" value="{{ old('band_photo') }}">
                                    @if ($errors->has('band_photo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('band_photo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('User') ? ' has-error' : '' }}">
                                <label for="User" class="col-md-4 control-label">User</label>
                                <div class="col-md-6">
                                    <select name="user" id="user">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id}}">{{ $user->name}}</option>
                                        @endforeach
                                    </select>
                                    <!--<input id="inputuser" type="text" class="form-control" name="inputuser">-->
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
