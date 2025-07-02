<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $NamaPage }}</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo_pelita.png') }}">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<style>
    body {
        background: #F0F4FF;
    }

    .BgPelita {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('/image/PatternLogo2.png');
        background-repeat: repeat;
        background-position: center;
        background-size: 180px 180px;
        opacity: 0.05;
        z-index: -1;
    }
</style>

<body>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="BgPelita"></div>
    @include('partials.navbar')
</body>
</html>