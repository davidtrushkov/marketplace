<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.partials._head')

    @if(Route::current()->getName() == 'home')
    <style>
        .navbar-brand {
            color: #FFFFFF !important;
        }
        .navbar-nav > li > a {
            color: #FFFFFF !important;
        }
        .navbar-brand:hover {
            color: #ff9538 !important;
        }
        .navbar-nav > li > a:hover {
            color: #ff9538 !important;
        }
    </style>
    @endif

</head>
<body>

<div id="app">
    @include('layouts.partials._navigation')
    @yield('content')
</div>

@include('layouts.partials._scripts')
</body>
</html>
