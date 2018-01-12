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
                            @include('files.partials._checkout_form_free')
                        @else
                            @include('files.partials._checkout_form')
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
        <div class="container SINGLE-FILE-CONTENT">
            <div class="col-sm-8">
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
        <div class="container SINGLE-FILE-CONTENT-OTHER-FILES-BY-USER">
            <h4>Other files by {{ $file->user->name }}</h4>
            @foreach($otherUsersCourses as $userCourses)
                <div class="col-sm-4 OTHER-FILES-BY-USER-BOX">
                    <a href="{{ $userCourses->identifier }}">
                        <img src="/images/files/cover/{{ isset($userCourses->avatar) ? $userCourses->avatar : '' }}" alt="{{ $userCourses->title }} cover image" class="SINGLE-FILE-COVER-IMAGE" />
                        <p>{{ $userCourses->title }}</p>
                    </a>
                </div>
            @endforeach
        </div>
        @endif
    </div>
@endsection