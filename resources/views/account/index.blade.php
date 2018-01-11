@extends('account.layouts.default')

@section('account.content')

    <div class="panel panel-default">
        <div class="panel-heading">Your Avatar</div>
        <div class="panel-body">
            @if(auth()->user()->avatar)
                <img src="/images/avatars/{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}'s Avatar Image" class="user-avatar-xl">
                <br /><br />
            @endif

            <form action="{{ route('account.user.avatar') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                    <input type="file" name="avatar">
                    @if($errors->has('avatar'))
                        <span class="help-block">{{ $errors->first('avatar') }}</span>
                    @endif
                </div>

                <div class="col-sm-12 no-padding">
                    <button type="submit" class="btn btn-success pull-right">Save</button>
                </div>

            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Your Name</div>
        <div class="panel-body">
            <form action="{{ route('account.update.settings') }}" method="post">
                {{ csrf_field() }}

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