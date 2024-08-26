<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        .qr{
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0px;
            left: 0px;
            background-image: url("{{(new \chillerlan\QRCode\QRCode())->render(route('attend'))}}");
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
            display: flex;
            align-items: start;
            justify-content: center;
            padding-top: 10px;
        }
    </style>
</head>
<body class="font-sans antialiased">

<a href="{{route('attend')}}" class="qr">
    <img style="width: 80px;" src="/img/logo.webp">
</a>
</body>
</html>
