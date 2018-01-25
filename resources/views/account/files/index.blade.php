@extends('account.layouts.default')

@section('account.content')
    <div id="ACCOUNT-YOUR-FILES">
        @if($files->count())
           @each('account.partials._file', $files, 'file')
        @else
           <p>You have no files.</p>
        @endif
    </div>
@endsection