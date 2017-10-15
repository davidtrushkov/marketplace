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
                    <h4>Rest Password</h4>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <center>
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-2 col-md-3"></div>
        </div>
    </div>
@endsection
