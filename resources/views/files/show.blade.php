@extends('layouts.plain')

@section('content')
    <div id="SINGLE-FILE-SHOW">
        <div class="container-fluid no-padding SINGLE-FILE-HEADER">
            <div class="container">
                @include('layouts.partials._flash')
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li><a href="/files">Files</a></li>
                        <li class="active">{{ str_limit($file->title, 50) }}</li>
                    </ol>
                </div>
                <div class="col-sm-4">
                    @if($file->youtube_url && $file->vimeo_url)
                        <div id="video-gallery">
                            <a href="{{ $file->youtube_url }}" data-poster="" >
                                <center>
                                    <i class="fa fa-3x fa-play" aria-hidden="true"></i>
                                </center>
                                <img src="{{ isset($file->avatar) ? '/images/files/cover/'.$file->avatar : 'images/home/default.png' }}" class="SINGLE-FILE-COVER-IMAGE" style="margin-top: -25px;" />
                            </a>
                            <a href="{{ $file->vimeo_url }}" data-poster=""></a>
                        </div>
                    @elseif($file->youtube_url)
                        <div id="video-gallery">
                            <a href="{{ $file->youtube_url }}" data-poster="" >
                                <center>
                                    <i class="fa fa-3x fa-play" aria-hidden="true"></i>
                                </center>
                                <img src="{{ isset($file->avatar) ? '/images/files/cover/'.$file->avatar : 'images/home/default.png' }}" class="SINGLE-FILE-COVER-IMAGE" style="margin-top: -25px;" />
                            </a>
                        </div>
                    @elseif($file->vimeo_url)
                        <div id="video-gallery">
                            <a href="{{ $file->vimeo_url }}" data-poster="" >
                                <center>
                                    <i class="fa fa-3x fa-play" aria-hidden="true"></i>
                                </center>
                                <img src="{{ isset($file->avatar) ? '/images/files/cover/'.$file->avatar : 'images/home/default.png' }}" class="SINGLE-FILE-COVER-IMAGE" style="margin-top: -25px;" />
                            </a>
                        </div>
                    @else
                        <img src="{{ isset($file->avatar) ? '/images/files/cover/'.$file->avatar : 'images/home/default.png' }}" alt="{{ $file->title }} cover image" class="SINGLE-FILE-COVER-IMAGE" />
                    @endif

                    <div class="SINGLE-FILE-CART-BOX">
                        @if($file->isFree())
                            <h3>FREE</h3>
                            @include('files.partials._checkout_form_free')
                        @else
                            @include('files.partials._checkout_form')
                        @endif
                    </div>
                </div>
                <div class="col-sm-8">
                    <h4>
                        <img src="{{ $file->user->avatar ? '/images/avatars/'.$file->user->avatar : '/images/icons/avatar.svg' }}" alt="User avatar" class="user-avatar">
                       {{ $file->user->name }} is selling
                    </h4>
                    <h1>{{ $file->title }}</h1>
                    <div class="SINGLE-FILE-OVERVIEW-SHORT">
                        {{ $file->overview_short }}
                    </div>
                    @if($file->sales->count() > 0)
                        <h4><span class="label label-success">{{ $file->sales->count() }} {{ str_plural('sale', $file->sales->count()) }}</span></h4>
                    @endif
                </div>
            </div>
        </div>
        @if ($uploadPreviews->count() > 0)
            <div class="SINGLE-FILE-PREVIEW-GALLERY">
                <div class="container">
                    <div class="col-sm-12" id="lightgallery">
                        <h4 class="description-header">Preview Uploads</h4>
                        @foreach($uploadPreviews->take(12) as $preview)
                            <div class="item col-sm-2 col-md-1 no-padding" data-src="/images/previews/{{ $preview->filename }}">
                                <img src="/images/previews/{{ $preview->filename }}" width="100%" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <div class="container SINGLE-FILE-CONTENT">
            <div class="col-sm-8">
                <h4 class="description-header">Description</h4>
                <p>{!! $file->overview !!}</p>
            </div>
            <div class="col-sm-4">

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <h5>File Uploads &nbsp; <span class="label label-default">{{ $uploads->count() }}</span></h5>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                @foreach($uploads as $upload)
                                    <div class="UPLOAD-FILENAME">{{ $upload->filename }}</div>
                                    <small>{{ $upload->formatBytes($upload->size, 2) }}</small>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @if(!$otherUsersCourses->isEmpty())
            <div class="container">
                <div class="container SINGLE-FILE-CONTENT-OTHER-FILES-BY-USER">
                    <h4>Other files by {{ $file->user->name }}</h4>
                    @foreach($otherUsersCourses as $userCourses)
                        <div class="col-sm-4 OTHER-FILES-BY-USER-BOX">
                            <a href="{{ $userCourses->identifier }}">
                                <img src="{{ isset($userCourses->avatar) ? '/images/files/cover/'.$userCourses->avatar : 'images/home/default.png' }}" alt="{{ $userCourses->title }} cover image" class="SINGLE-FILE-COVER-IMAGE" />
                                <p>{{ $userCourses->title }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="container">
            <div class="col-sm-8 col-md-6 no-padding SINGLE-FILE-CONTENT-COMMENT-BOX">
                @if(auth()->user())
                    <form action="{{ route('store.comment', $file->id) }}#replyContainer" method="post">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <textarea class="form-control" name="body" rows="6" placeholder="Comment...">{{ old('overview') }}</textarea>
                            @if ($errors->has('body'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <div class="g-recaptcha" data-sitekey="6Lf5m0AUAAAAAN5qHz_zQ0PDCUJB_vviLBpHFr11"></div>
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </form>
                @else
                    <a href="/login">Login to post comments</a>
                @endif
            </div>
           @include('files.partials._comment')
        </div>

    </div>
@endsection