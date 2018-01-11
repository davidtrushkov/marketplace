@extends('account.layouts.default')

@section('account.content')

    <div class="panel panel-default">
        <div class="panel-heading">User Info</div>
        <div class="panel-body">
            <form action="{{ route('account.update.settings') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <avatar-upload current-avatar="{{ Auth::user()->avatarPath() }}"></avatar-upload>
                </div>

                <br />

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? Auth::user()->name }}" placeholder="Your name">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-sm-12 no-padding">
                    <button type="submit" class="btn btn-success pull-right">Save</button>
                </div>

            </form>
        </div>
    </div>
@endsection