@extends('account.layouts.default')

@section('account.content')
    <div class="ACCOUNT-FILE-FORM">
        <div class="HEADER-BOX">
            make changes to: {{ $file->title }}
        </div>

        @if($approvals)
            @include('account.files.partials._changes', compact('approval'))
        @endif

        <form action="{{ route('account.files.update', $file) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="col-sm-12 no-padding YOUR-FILE-BOX YOUR-FILEBOX-CRUD">

                <input type="hidden" name="live" value="0">
                <input id="trix" type="hidden" name="overview" value="{{ old('overview') ? old('overview') : $file->overview }}">

                @if($file->avatar)
                    <div class="col-sm-6 no-padding">
                        <img src="/images/files/cover/{{ $file->avatar }}" alt="{{ $file->title }} cover image" class="img-rounded img-responsive">
                        <br />
                    </div>
                @endif

                <div class="col-sm-12 no-padding">
                    <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                        <label>Your files cover photo</label>
                        <input type="file" name="avatar">
                        <br />
                        @if($errors->has('avatar'))
                            <span class="help-block">{{ $errors->first('avatar') }}</span>
                        @endif
                    </div>

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
            </div>

            <div class="col-sm-12 no-padding YOUR-FILE-BOX YOUR-FILEBOX-CRUD">
                <div id="priceDescription" class="hidden">
                    <p>You get $<span id="total_price"></span></p>
                    <p>We get $<span id="total_price_for_us"></span></p>
                </div>

                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label><span class="text-danger">*</span>Price</label>
                    <input type="text" class="form-control" id="file-price" name="price" value="{{ old('price') ? old('price') : $file->price }}" placeholder="Price">
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
                    <input type="text" class="form-control" name="youtube_url" value="{{ old('youtube_url') ? old('youtube_url') : $file->youtube_url }}">
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
                    <input type="text" class="form-control" name="vimeo_url" value="{{ old('vimeo_url') ? old('vimeo_url') : $file->vimeo_url }}">
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
                        <label>What categories does this file belong to?</label>
                        <select name="categories_id[]" multiple="multiple">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @foreach($cats as $c) @if( collect($c->category_id)->contains($category->id) == $category->id) selected="selected" @endif @endforeach
                                >{{ $category->name }}</option>
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

            <div class="col-sm-12 no-padding YOUR-FILE-BOX YOUR-FILEBOX-CRUD">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="live" id="live" {{ $file->live ? ' checked' : '' }} value="1">
                       Live
                    </label>
                </div>
                <br />

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label><span class="text-danger">*</span>Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ? old('title') : $file->title }}" max="100">
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group{{ $errors->has('overview_short') ? ' has-error' : '' }}">
                    <label><span class="text-danger">*</span>Short Overview</label>
                    <textarea class="form-control" id="overview_short" name="overview_short" rows="3" style="height: auto;">{{ old('overview_short') ? old('overview_short') : $file->overview_short }}</textarea>
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

                <div class="form-group pull-right">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

                <div class="col-sm-12 no-padding">
                    <small class="pull-right">Your file changes may be subject to review.</small>
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