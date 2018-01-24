@extends('account.layouts.default')

@section('account.content')
    <div class="ACCOUNT-FILE-FORM">

        <div class="panel panel-default">
            <div class="panel-heading">
                Send users who own this file a notification
            </div>
            <div class="panel-body">
                <form action="{{ route('account.files.store.notification', $file->identifier) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <ol class="breadcrumb">
                        <li>You can send users notifications if you made some updates to this file, or have an announcement.</li>
                    </ol>

                    <div class="form-group{{ $errors->has('header') ? ' has-error' : '' }}">
                        <label>Notification Header</label>
                        <input type="text" class="form-control" name="header" placeholder="Optional..." value="{{ old('header') }}">
                        @if ($errors->has('header'))
                            <span class="help-block">
                            <strong>{{ $errors->first('header') }}</strong>
                        </span>
                        @endif
                    </div>

                    <ol class="breadcrumb">
                        <li>Will default to <b>"File updated for: {{ $file->title }}"</b> if no header present.</li>
                    </ol>

                    <br />

                    <div class="form-group{{ $errors->has('data') ? ' has-error' : '' }}">
                        <label>Notification Message</label>
                        <textarea class="form-control" name="data" rows="8" style="height: auto;">{{ old('data') }}</textarea>
                        @if ($errors->has('data'))
                            <span class="help-block">
                            <strong>{{ $errors->first('data') }}</strong>
                        </span>
                        @endif
                    </div>

                    <br />

                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-primary">Send Notification to Users</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection