@extends('account.layouts.default')

@section('account.content')
    <div id="ACCOUNT-YOUR-FILES">
        <div class="HEADER-BOX">
            Your Files
        </div>
        @if($files->count())
           @each('account.partials._file', $files, 'file')
        @else
           <p>You have no files.</p>
        @endif
    </div>
@endsection