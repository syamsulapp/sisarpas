<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link href="{{ asset('sisarpas/assets/img/logo.png') }}" rel="icon" />
    <link href="{{ asset('sisarpas/assets/img/logo.png') }}" rel="apple-touch-icon" />
    <link rel="stylesheet" href="{{ asset('sisarpas/assets/boostraps.css') }}" />
    <link rel="stylesheet" href="{{ asset('sisarpas/assets/style.css') }}" />
</head>

<body>

    <!-- content view login and register -->
    @yield('content')

</body>

</html>
