<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset("css/fonts.css") }}">

    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
</head>

<body>
<div class="flex-center position-ref full-height">

    <div class="content">

        @yield('content')

    </div>
</div>
</body>
</html>
