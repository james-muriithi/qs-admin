<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/linearicons@1.0.2/dist/web-font/style.min.css">

    <link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">

    @yield('styles')
</head>

<body>
<div class="limiter">
    @yield("content")
</div>

@yield('scripts')
</body>

</html>
