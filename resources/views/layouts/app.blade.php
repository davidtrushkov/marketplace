<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
   @include('layouts.partials._head')
</head>
<body>

    <div id="app">
        @if (!in_array(Route::currentRouteName(), ['login', 'register']))
            @include('layouts.partials._navigation')
        @endif

        @yield('content')
    </div>

    @include('layouts.partials._scripts')
    @yield('scripts')
</body>
</html>
