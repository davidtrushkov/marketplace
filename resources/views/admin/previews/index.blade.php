@extends('layouts.plain')

@section('content')
    <div id="SINGLE-FILE-SHOW">

        @if($updatedChanges)
            <div class="container UPDATED-CHANGES-CONTAINER">
                @if($updatedChanges->title !== $file->title)
                    <div class="col-sm-12 no-padding UPDATED-BOX">
                        <table class="table table-bordered table-responsive table-hover">
                            <thead>
                                <tr class="active">
                                    <th>Previous Title</th>
                                    <th>Updated Title  <span class="label label-success pull-right">Updated</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $file->title }}</td>
                                    <td>{{ $updatedChanges->title }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

                @if($updatedChanges->overview_short !== $file->overview_short)
                    <div class="col-sm-12 no-padding UPDATED-BOX">
                        <table class="table table-bordered table-responsive table-hover">
                            <thead>
                            <tr class="active">
                                <th>Previous Short Overview</th>
                                <th>Updated Short Overview  <span class="label label-success pull-right">Updated</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $file->overview_short }}</td>
                                <td>{{ $updatedChanges->overview_short }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

                @if($updatedChanges->overview !== $file->overview)
                    <div class="col-sm-12 no-padding UPDATED-BOX">
                        <table class="table table-bordered table-responsive table-hover">
                            <thead>
                            <tr class="active">
                                <th>Previous Description</th>
                                <th>Updated Description  <span class="label label-success pull-right">Updated</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{!! $file->overview !!}</td>
                                <td>{!! $updatedChanges->overview !!}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

                @if($updatedChanges->youtube_url !== $file->youtube_url)
                    <div class="col-sm-12 no-padding UPDATED-BOX">
                        <table class="table table-bordered table-responsive table-hover">
                            <thead>
                            <tr class="active">
                                <th>Previous Youtube URL</th>
                                <th>Updated Youtube URL  <span class="label label-success pull-right">Updated</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $file->youtube_url }}</td>
                                <td>{{ $updatedChanges->youtube_url }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

                @if($updatedChanges->vimeo_url !== $file->vimeo_url)
                    <div class="col-sm-12 no-padding UPDATED-BOX">
                        <table class="table table-bordered table-responsive table-hover">
                            <thead>
                            <tr class="active">
                                <th>Previous Vimeo URL</th>
                                <th>Updated Vimeo URL  <span class="label label-success pull-right">Updated</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $file->vimeo_url }}</td>
                                <td>{{ $updatedChanges->vimeo_url }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

                @if(($uploads = $file->uploads()->withoutPreviewFiles()->unapproved()->get())->count())
                    <div class="col-sm-12 no-padding UPDATED-BOX">
                        <table class="table table-bordered table-responsive table-hover">
                            <thead>
                            <tr class="active">
                                <th>Uploaded Files  <span class="label label-success pull-right">Updated</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($uploads as $upload)
                                <tr>
                                    <td>{{ $upload->filename }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>
                                    <a href="{{ route('files.admin.download', $file) }}">
                                        Download files <span class="label label-info pull-right">{{ $uploads->count() }}</span>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

                @if(($uploadPreviews = $file->uploads()->withPreviewFiles()->unapproved()->get())->count())
                    <div class="col-sm-12 no-padding UPDATED-BOX-THREE">
                        <table class="table table-bordered table-responsive table-hover">
                            <thead>
                                <tr class="active">
                                    <th>Preview Images</th>
                                    <th>Filename</th>
                                    <th>File Size <span class="label label-success pull-right">Updated</span></th>
                                </tr>
                                </thead>
                            <tbody>
                            @foreach($uploadPreviews as $pre)
                                <tr>
                                    <td>
                                        <img src="/images/previews/{{ $pre->filename }}" width="100%" />
                                    </td>
                                    <td>{{ $pre->filename }}</td>
                                    <td>{{ $pre->formatBytes($pre->size, 2) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        @endif


        <div class="container-fluid no-padding SINGLE-FILE-HEADER">
            <div class="container">
                @include('layouts.partials._flash')
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
                            <form action="{{ route('checkout.free', $file) }}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input type="email" class="form-control" name="email" id="email" required placeholder="Enter your email" value="{{ old('email') }}" />
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Download for free</button>
                                </div>

                            </form>
                        @else
                            <form action="{{ route('checkout.payment', $file) }}" method="POST">
                                {{ csrf_field() }}
                                <h3>${{ $file->price }}</h3>
                                <script
                                        src="https://checkout.stripe.com/checkout.js"
                                        class="stripe-button"
                                        data-key="{{ $file->user->stripe_key }}"
                                        data-amount="{{ $file->price * 100 }}"
                                        data-name="{{ $file->title }}"
                                        data-description="{{ $file->overview_short }}"
                                        data-image="/images/icons/marketplace-logo.png"
                                        data-locale="auto"
                                        data-currency="usd"
                                >
                                </script>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="col-sm-8">
                    <h4>
                        @if($file->user->avatar)
                            <img src="/images/avatars/{{ $file->user->avatar }}" alt="User avatar" class="user-avatar">
                        @endif
                        {{ $file->user->name }} is selling
                    </h4>
                    <h1>{{ $file->title }}</h1>
                    <div class="SINGLE-FILE-OVERVIEW-SHORT">
                        {{ $file->overview_short }}
                    </div>
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
                                    <h5>File Uploads &nbsp; <span class="label label-default">{{ $fileUploads->count() }}</span></h5>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                @foreach($fileUploads as $upload)
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

    </div>
@endsection