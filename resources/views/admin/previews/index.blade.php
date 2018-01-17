@extends('layouts.plain')

@section('content')
    <div id="SINGLE-FILE-SHOW">
        <div class="container-fluid no-padding SINGLE-FILE-HEADER">
            <div class="container">
                @include('layouts.partials._flash')
                <div class="col-sm-4">
                    <img src="/images/files/cover/{{ isset($file->avatar) ? $file->avatar : '' }}" alt="{{ $file->title }} cover image" class="SINGLE-FILE-COVER-IMAGE" />

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
                    <br />
                    <a href="{{ route('files.admin.download', [$file]) }}">
                        Download files
                    </a>
                </div>

            </div>
        </div>

    </div>
@endsection