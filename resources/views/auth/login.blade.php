@extends('layouts.app')

@section('content')
<div class="AUTH-CONTAINER-SECTION">
    <div class="container">
        <div class="col-sm-2 col-md-3"></div>
            <div class="col-sm-8 col-md-6">
                <div class="auth-box">
                    <h1>
                        <a href="/">
                            Marketplace
                        </a>
                    </h1>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <center>
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </center>
                        </div>
                        <div class="login-link">
                            <a href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        <div class="col-sm-2 col-md-3"></div>
    </div>
</div>
@endsection
