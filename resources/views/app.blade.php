<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'User DB') }}</title>

{{--    @vite('resources/css/app.css')--}}
</head>
<body>
    <div id="app">
        <nav-bar></nav-bar>
        <main role="main" class="container">
            <router-view></router-view>
        </main>
        <bottom-bar></bottom-bar>
    </div>

    @vite('resources/js/app.js')
</body>
</html>
