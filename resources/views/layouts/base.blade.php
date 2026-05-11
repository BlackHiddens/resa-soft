<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @yield('html-attributes')>

<head>
    @include('layouts.partials/title-meta')

    @include('layouts.partials/head-css')
    @yield('head-extra')

    {{-- ── Google Ads — Global Site Tag (gtag.js) ────────────────────────── --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-18156017818"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-18156017818');
    </script>

</head>

<body @yield('body-attributes')>

    @yield('header')

    @yield('content')

    @include('layouts.partials/footer-scripts')

</body>

</html>