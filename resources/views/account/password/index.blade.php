@extends('account.layouts.default')

@section('account.content')
    <div class="panel panel-default">
        <div class="panel-heading">Change Password</div>
        <div class="panel-body">
            <form action="{{ route('change.password.store') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('password_current') ? ' has-error' : '' }}">
                    <label>Current Password</label>
                    <input id="password_current" type="password" class="form-control" name="password_current" placeholder="Current Password" autofocus required>
                    @if ($errors->has('password_current'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_current') }}</strong>
                        </span>
                    @endif
                </div>

                <br />

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label>New Password</label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="New Password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <br />

                <label>Retype New Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Retype New Password" required>

                <br />

                <div class="form-group">
                    <button type="submit" class="btn btn-success pull-right">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection