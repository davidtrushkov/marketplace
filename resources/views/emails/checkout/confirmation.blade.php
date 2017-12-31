@extends('emails.layouts.default')

@section('content')
    <br />
    <center>
        <img src="{{ asset('/images/icons/download.svg') }}" alt="Download Icon" width="120px" height="120px">
    </center>
    <br /><br />

    <p>Thanks for downloading: <strong>{{ $sale->file->title }} from Marketplace</strong></p>

    <p>
        <a href="{{ route('files.download', [$sale->file, $sale]) }}">
            Download your file
        </a>
    </p>

    <p>Or, copy and paste this into your browser. <br />
        <a href="{{ route('files.download', [$sale->file, $sale]) }}">{{ route('files.download', [$sale->file, $sale]) }}</a>
    </p>
@endsection