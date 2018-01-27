<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
   @include('layouts.partials._head')
</head>
<body>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '596563367353526',
            xfbml      : true,
            version    : 'v2.11'
        });

        FB.AppEvents.logPageView();

    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

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
