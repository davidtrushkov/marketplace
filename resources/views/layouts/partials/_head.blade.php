<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="application-name" content="{{ config('app.name') }}">

<meta name="description" content="Browse through our selection of files, or upload your creation. Upload all kinds of files from images, photoshop files, templates, code, to icons and fonts.">
<meta name="keywords" content="marketplace, files, file marketplace, upload, upload files, photos, images, open source, david, david trushkov, github, laravel, laravel 5, laravel 5.5" />
<meta name="author" content="David Trushkov">

<meta name="robots" content="index,follow">
<meta name="googlebot" content="index,follow">

<link rel="icon" type="image/png" sizes="16x16" href="/images/icons/favicon-16x16.png">
<link rel="icon" type="image/png" sizes="32x32" href="/images/icons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="128x128" href="/images/icons/favicon-128x128.png">

<meta property="fb:app_id" content="596563367353526">
<meta property="og:url" content="http://marketplace.davidtrushkov.com/">
<meta property="og:type" content="website">
<meta property="og:title" content="Buy and Sell Files">
<meta property="og:image" content="/images/icons/favicon-32x32.png">
<meta property="og:description" content="Browse through our selection of files, or upload your creation. Upload all kinds of files from images, photoshop files, templates, code, to icons and fonts.">
<meta property="og:site_name" content="Marketplace">
<meta property="og:locale" content="en_US">
<meta property="article:author" content="David Trushkov">

<link rel="apple-touch-icon" href="/images/icons/favicon-128x128.png">
<link rel="mask-icon" href="/images/icons/favicon-128x128.png" color="red">
<meta name="mobile-web-app-capable" content="yes">


<title>{{ config('app.name', 'Marketplace') }}</title>

<script src="https://cdn.logrocket.io/LogRocket.min.js" crossorigin="anonymous"></script>
<script>
    window.LogRocket && window.LogRocket.init('yuwzcd/marketplace');

    @if(auth()->user())
        LogRocket.identify('{{ auth()->user()->id }}', {
            name: '{{ auth()->user()->name }}',
            email: '{{ auth()->user()->email }}',
        });
    @endif
</script>

<!-- Styles -->
<link href="/css/app.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/trix/0.11.1/trix.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.6/css/lightgallery.min.css" />
<link type="text/css" rel="stylesheet" href="{{ asset('css/plugins/multiple-select.css') }}">

<script src="/js/app.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>