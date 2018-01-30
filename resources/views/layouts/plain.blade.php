<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.partials._head')
</head>
<body>

<div id="">
    @include('layouts.partials._navigation')
    @yield('content')
</div>

@include('layouts.partials._footer')
@include('layouts.partials._scripts')
</body>
</html>
