@extends('layouts.app')

@section('content')
    <div class="ACCOUNT-CONTENT">
        <div class="col-sm-12 no-padding ACCOUNT-HEADER">
            @include('account.layouts._stats')
        </div>
        <div class="container">
            <div class="col-sm-4">
                @include('account.partials._navigation')
            </div>
            <div class="col-sm-8">
                @include('layouts.partials._flash')
                @yield('account.content')
            </div>
        </div>
    </div>
@endsection