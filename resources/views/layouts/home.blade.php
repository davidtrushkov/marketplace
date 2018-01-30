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
    </style>
    @endif

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
    @include('layouts.partials._navigation')

    @yield('content')
</div>

@include('layouts.partials._footer')
@include('layouts.partials._scripts')
</body>
</html>
