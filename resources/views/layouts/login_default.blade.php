<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
    <title>{{ page_title($title) ?? '' }}</title>
    @livewireStyles
</head>
<body class="bg-gradient-light">

    @yield('content')

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @livewireScripts

</body>
</html>
