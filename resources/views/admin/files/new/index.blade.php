@extends('admin.layouts.default')

@section('admin.content')
    @if($files->count())
        @each('admin.partials._file_to_approve', $files, 'file')
    @else
        <p>There are no new files waiting for approval.</p>
    @endif
@endsection