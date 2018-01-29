@extends('layouts.app')

@section('content')
    <div class="ACCOUNT-CONTENT">
        <div class="col-sm-12 no-padding ACCOUNT-HEADER hidden-xs">
            @include('account.layouts._stats')
        </div>
        <div class="container no-padding-xs">
            @include('account.partials._email_verification')
            <div class="col-sm-4">
                @include('account.partials._navigation')
            </div>
            <div class="col-sm-8">
                @include('layouts.partials._flash')
                @yield('account.content')
            </div>
        </div>
        <div class="col-sm-12 no-padding ACCOUNT-HEADER visible-xs">
            @include('account.layouts._stats')
        </div>
    </div>
@endsection