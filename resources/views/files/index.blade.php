@extends('layouts.plain')

@section('content')
    <div class="container-fluid no-padding MAIN-FILES-CONTAINER">
        <div class="container">
            @if($files->isEmpty())
                <p>No files found</p>
            @else
                @foreach($files as $file)
                    <div class="col-sm-12 no-padding FILES-BOX">
                        <a href="{{ $file->identifier }}">
                            <div class="col-sm-4 col-md-3 no-padding">
                                <div class="image">
                                    <img src="/images/files/cover/{{ isset($file->avatar) ? $file->avatar : '' }}" alt="{{ $file->title }} cover image" />
                                    <span class="label label-success price-tag">${{ $file->price }}</span>
                                </div>
                            </div>
                            <div class="col-sm-8 col-md-9">
                                <h4>{{ $file->title }}</h4>
                                <p>{{ str_limit($file->overview_short, 175) }}</p>
                                <small>By {{ $file->user->name }}</small>
                            </div>
                        </a>
                    </div>
                @endforeach

                {{ $files->render() }}
            @endif
        </div>
    </div>
@endsection