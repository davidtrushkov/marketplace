@extends('layouts.plain')

@section('content')
    <div class="container">
        <h3>
            <strong>{{ $file->user->name }}</strong> is selling
        </h3>
        <h1>{{ $file->title }}</h1>
        <h2>
            {{ $file->overview_short }}
        </h2>
        <p>
            {{ $file->overview }}
        </p>

        @foreach($uploads as $upload)
            <p>{{ $upload->filename }}</p>
            <small>{{ $file->size }}</small>
        @endforeach
    </div>
@endsection