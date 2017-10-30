@extends('account.layouts.default')

@section('account.content')
    <div class="ACCOUNT-FILE-FORM">
        <div class="HEADER-BOX">
            sell a file
        </div>
        <div class="col-sm-12 no-padding YOUR-FILE-BOX">
            <form action="{{ route('account.files.store', $file) }}" method="post">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('uploads') ? ' has-error' : '' }}">
                    <div id="file" class="dropzone"></div>
                    @if ($errors->has('uploads'))
                        <span class="help-block">
                            <strong>{{ $errors->first('uploads') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" autofocus placeholder="Title">
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('overview_short') ? ' has-error' : '' }}">
                    <textarea class="form-control" id="overview_short" name="overview_short" rows="3" style="height: auto;" placeholder="Short Overview">{{ old('overview_short') }}</textarea>
                    @if ($errors->has('overview_short'))
                        <span class="help-block">
                            <strong>{{ $errors->first('overview_short') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="Price">
                    @if ($errors->has('price'))
                        <span class="help-block">
                   <strong>{{ $errors->first('price') }}</strong>
               </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('overview') ? ' has-error' : '' }}">
                    <textarea class="form-control" name="overview" id="overview" rows="6" style="height: auto;" placeholder="Overview">{{ old('overview') }}</textarea>
                    @if ($errors->has('overview'))
                        <span class="help-block">
                            <strong>{{ $errors->first('overview') }}</strong>
                        </span>
                    @endif
                </div>

                <br />

                <div class="form-group pull-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                <div class="col-sm-12 no-padding">
                    <small class="pull-right">We will review your file before it goes live.</small>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @include('account.partials._file_upload')
@endsection