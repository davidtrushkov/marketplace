@extends('account.layouts.default')

@section('account.content')
    <div class="ACCOUNT-FILE-FORM">
        <form action="{{ route('account.files.store', $file) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="col-sm-12 no-padding YOUR-FILE-BOX YOUR-FILEBOX-CRUD">

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
                    <label><span class="text-danger">*</span>Uploads</label>
                    <div id="file" class="dropzone"></div>
                    @if ($errors->has('uploads'))
                        <span class="help-block">
                            <strong>{{ $errors->first('uploads') }}</strong>
                        </span>
                    @endif
                </div>
                <ol class="breadcrumb">
                    <li>Upload the files you are selling in here.</li>
                </ol>
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
                <ol class="breadcrumb">
                    <li>You can upload preview images to let users see what they are getting. All images will be watermarked. Max 12 images.</li>
                </ol>
            </div>

            <div class="col-sm-12 no-padding YOUR-FILE-BOX YOUR-FILEBOX-CRUD">
                <div id="priceDescription" class="hidden">
                    <p>You get $<span id="total_price"></span></p>
                    <p>We get $<span id="total_price_for_us"></span></p>
                </div>

                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label><span class="text-danger">*</span>Price</label>
                    <input type="text" class="form-control" id="file-price" name="price" value="{{ old('price') }}">
                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>

                <ol class="breadcrumb">
                    <li>If the file is free, then set the price to 0.</li>
                </ol>

                <ol class="breadcrumb">
                    <li>Our current rate is %{{ config('marketplace.sales.commission') }}</li>
                </ol>

                <ol class="breadcrumb">
                    <li><i>*So if you set your price to $100, then we get %{{ config('marketplace.sales.commission') }} of that.</i></li>
                </ol>

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
            </div>

            <div class="col-sm-12 no-padding YOUR-FILE-BOX YOUR-FILEBOX-CRUD">
                <div class="form-group{{ $errors->has('youtube_url') ? ' has-error' : '' }}">
                    <label>Youtube Video URL</label>
                    <input type="text" class="form-control" name="youtube_url" value="{{ old('youtube_url') }}">
                    @if ($errors->has('youtube_url'))
                        <span class="help-block">
                            <strong>{{ $errors->first('youtube_url') }}</strong>
                        </span>
                    @endif
                </div>
                <ol class="breadcrumb">
                    <li>Only insert a Youtube URL link, NOT the embed code.</li>
                </ol>
                <ol class="breadcrumb">
                    <li><i>Example: https://www.youtube.com/watch?v=Ff6bi8rkLpg</i></li>
                </ol>

                <div class="form-group{{ $errors->has('vimeo_url') ? ' has-error' : '' }}">
                    <label>Vimeo Video URL</label>
                    <input type="text" class="form-control" name="vimeo_url" value="{{ old('vimeo_url') }}">
                    @if ($errors->has('vimeo_url'))
                        <span class="help-block">
                            <strong>{{ $errors->first('vimeo_url') }}</strong>
                        </span>
                    @endif
                </div>
                <ol class="breadcrumb">
                    <li>Only insert a Vimeo URL link, NOT the embed code or staff picks.</li>
                </ol>
                <ol class="breadcrumb">
                    <li><i>Example: https://vimeo.com/99232333</i></li>
                </ol>
            </div>

            <div class="col-sm-12 no-padding YOUR-FILE-BOX YOUR-FILEBOX-CRUD">
                <div class="col-sm-12 no-padding" id="muiltipleCategoriesSelect">
                    <div class="form-group{{ $errors->has('overview_short') ? ' has-error' : '' }}">
                        <label>Categories</label>
                        <select name="categories_id[]" multiple="multiple">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if(old("categories_id")){{ (in_array($category->id, old("categories_id")) ? "selected":"") }}@endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 no-padding">
                    <ol class="breadcrumb">
                        <li>You can choose multiple categories, which users can filter by.</li>
                    </ol>
                </div>
            </div>


            <div class="col-sm-12 no-padding YOUR-FILE-BOX">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label><span class="text-danger">*</span>Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" max="100">
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('overview_short') ? ' has-error' : '' }}">
                    <label><span class="text-danger">*</span>Short Overview</label>
                    <textarea class="form-control" id="overview_short" name="overview_short" rows="3" style="height: auto;">{{ old('overview_short') }}</textarea>
                    @if ($errors->has('overview_short'))
                        <span class="help-block">
                            <strong>{{ $errors->first('overview_short') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('overview') ? ' has-error' : '' }} trix-editor">
                    <label><span class="text-danger">*</span>Description</label>
                    <trix-editor input="trix"></trix-editor>
                    <br />
                    @if ($errors->has('overview'))
                        <span class="help-block">
                            <strong>{{ $errors->first('overview') }}</strong>
                        </span>
                    @endif
                </div>

                <br />

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>

                <div class="col-sm-12 no-padding clearfix">
                    <small>We will review your file before it goes live.</small>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    @include('account.partials._file_upload')

    <script src="{{ asset('js/plugins/multiple-select.js') }}"></script>
    <script>
        $('select').multipleSelect({
            placeholder: "Select categories",
            selectAll: false,
        });
    </script>
@endsection