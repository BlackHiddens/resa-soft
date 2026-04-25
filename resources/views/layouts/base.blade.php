<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @yield('html-attributes')>

<head>
    @include('layouts.partials/title-meta')

    @include('layouts.partials/head-css')
    @yield('head-extra')

</head>

<body @yield('body-attributes')>

    @yield('header')

    @yield('content')

    @include('layouts.partials/footer-scripts')

</body>

</html>