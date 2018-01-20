@extends('layouts.plain')

@section('content')
    <div class="container-fluid no-padding MAIN-FILES-CONTAINER">
        @include('files.partials._top_filter_nav')
        <div class="container">
            @if($files->isEmpty())
                <p>No files found</p>
            @else
                @foreach($files as $file)
                    <div class="col-sm-12 no-padding FILES-BOX">
                        <a href="{{ $file->identifier }}">
                            <div class="col-sm-4 col-md-3 no-padding">
                                <div class="image">
                                    <img class="img-box" src="{{ isset($file->avatar) ? '/images/files/cover/'.$file->avatar : 'images/home/default.png' }}" alt="{{ $file->title }} cover image" />
                                    <span class="label label-success price-tag">{{ $file->price > 0 ? '$' . $file->price : 'Free' }}</span>
                                </div>
                            </div>
                            <div class="col-sm-8 col-md-9">
                                <h4>{{ $file->title }} <label class="label label-primary pull-right">{{ $file->sales->count() }} {{ str_plural('sale', $file->sales->count()) }}</label></h4>
                                <p>{{ str_limit($file->overview_short, 175) }}</p>
                                <small>
                                    <img src="{{ $file->user->avatar ? '/images/avatars/'.$file->user->avatar : '/images/icons/avatar.svg' }}" alt="User avatar" class="user-avatar">
                                    {{ $file->user->name }}
                                </small>
                            </div>
                        </a>
                    </div>
                @endforeach

                {{ $files->appends(request()->input())->links() }}
            @endif
        </div>
    </div>
@endsection