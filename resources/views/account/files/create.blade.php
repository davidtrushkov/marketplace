@extends('account.layouts.default')

@section('account.content')
    <div class="ACCOUNT-FILE-FORM">
        <div class="HEADER-BOX">
            sell a file
        </div>
        <div class="col-sm-12 no-padding YOUR-FILE-BOX">
            <form action="{{ route('account.files.store', $file) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input id="trix" type="hidden" name="overview" value="{{ old('overview') }}">

                <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                    <label>Your files cover photo</label>
                    <input type="file" name="avatar">
                    @if($errors->has('avatar'))
                        <span class="help-block">{{ $errors->first('avatar') }}</span>
                    @endif
                </div>

                <br /><br />

                <div class="form-group{{ $errors->has('uploads') ? ' has-error' : '' }}">
                    <label>Uploads</label>
                    <div id="file" class="dropzone"></div>
                    @if ($errors->has('uploads'))
                        <span class="help-block">
                            <strong>{{ $errors->first('uploads') }}</strong>
                        </span>
                    @endif
                </div>
                <p>Upload the files you are selling in here.</p>
                <br /><br />

                <div class="form-group{{ $errors->has('preview_images') ? ' has-error' : '' }}">
                    <label>Preview Gallery Images</label>
                    <div id="file-preview_images" class="dropzone"></div>
                    @if ($errors->has('preview_images'))
                        <span class="help-block">
                            <strong>{{ $errors->first('preview_images') }}</strong>
                        </span>
                    @endif
                </div>
                <p>You can upload preview images to let users see what they are getting. All images will be watermarked. Max 12 images.</p>
                <br /><br />

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" autofocus placeholder="Title" max="100">
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

                <div id="priceDescription" class="hidden">
                    <p>You get $<span id="total_price"></span></p>
                    <p>We get $<span id="total_price_for_us"></span></p>
                </div>

                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" id="file-price" name="price" value="{{ old('price') }}" placeholder="Price">
                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>

                <script>
                    function precisionRound(number, precision) {
                        let factor = Math.pow(10, precision);
                        return Math.round(number * factor) / factor;
                    }

                    $('#file-price').keyup(function() {
                        $("#priceDescription").removeClass("hidden");
                        let price = $("#file-price").val();

                        let configPrice = .{{ config('marketplace.sales.remaining') }};
                        let your_price = price * configPrice;
                        let your_total = precisionRound(your_price, 2);

                        let remainingPrice = .{{ config('marketplace.sales.commission') }};
                        let our_price = price * remainingPrice;
                        let our_total = precisionRound(our_price, 2);

                        $("#total_price").html(your_total);
                        $("#total_price_for_us").html(our_total);
                    });
                </script>

                <div class="form-group{{ $errors->has('overview') ? ' has-error' : '' }} trix-editor">
                    {{--<textarea class="form-control" name="overview" id="overview" rows="6" style="height: auto;" placeholder="Overview">{{ old('overview') }}</textarea>--}}
                    <trix-editor input="trix" placeholder="Overview"></trix-editor>
                    <br />
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