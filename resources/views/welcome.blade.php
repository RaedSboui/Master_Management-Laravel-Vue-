<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous"/>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Icons -->
        <link rel="icon" href="/favicon.ico">
        <!-- Theme -->
        <link id="theme-link" rel="stylesheet" href="/themes/lara-light-indigo/theme.css">
    </head>
    <body class="antialiased">
        <div id='app'></div>
    </body>
    <script src="{{ mix('js/app.js') }}"></script>
</html>
