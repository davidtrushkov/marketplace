@extends('admin.layouts.default')

@section('admin.content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Give a reason for rejecting this file so the user knows what to fix?
        </div>
        <div class="panel-body">
            <form action="{{ route('admin.files.updated.destroy', $file) }}" method="post">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('data') ? ' has-error' : '' }}">
                    <label>Reason for rejecting this file</label>
                    <textarea class="form-control" name="data" rows="8" style="height: auto;" placeholder="Optional...">{{ old('data') }}</textarea>
                    @if ($errors->has('data'))
                        <span class="help-block">
                            <strong>{{ $errors->first('data') }}</strong>
                        </span>
                    @endif
                </div>

                <br />

                <div class="form-group pull-right">
                    <a href="{{ route('admin.files.updated.index') }}" class="btn btn-danger">Go Back</a>
                    <button type="submit" class="btn btn-primary">Submit Rejection</button>
                </div>

            </form>
        </div>
    </div>
@endsection