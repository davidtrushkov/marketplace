@extends('layouts.app')

@section('content')
    <div class="ACCOUNT-CONTENT">
        <div class="col-sm-12 no-padding ACCOUNT-HEADER hidden-xs">
           @include('admin.partials._stats')
        </div>
        <div class="container no-padding-xs">
            <div class="col-sm-4">
                @include('admin.partials._navigation')
            </div>
            <div class="col-sm-8">
                @include('layouts.partials._flash')
                @yield('admin.content')
            </div>
        </div>
        <div class="col-sm-12 no-padding ACCOUNT-HEADER visible-xs">
            @include('admin.partials._stats')
        </div>
    </div>
@endsection