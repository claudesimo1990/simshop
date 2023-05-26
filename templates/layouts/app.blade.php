<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <meta name="keywords" content="@yield('meta_keywords','some default keywords')">
    <meta name="description" content="@yield('meta_description')">
    <link rel="canonical" href="{{ url()->current() }}"/>
    <meta name="theme-color" content="#ffffff">

    <title>@yield('title','SimShop')</title>
    @livewireStyles
    @vite(['assets/css/app.css', 'assets/js/alpine.js', 'assets/js/app.js'])
    @livewireStyles
    @livewireScripts
    @stack('scripts')
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full">
    @include('includes/header')
    <main>
        @yield('content')
    </main>
    @livewire('notifications')
    @include('includes.footer')
</body>
</html>
