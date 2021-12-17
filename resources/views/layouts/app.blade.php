<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ config('app.theme') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div class="drawer drawer-mobile min-h-screen bg-base-200">
        <input id="drawer" type="checkbox" class="drawer-toggle">

        <div class="drawer-side shadow-lg">
            <label for="drawer" class="drawer-overlay z-10"></label>
            @include('layouts.sidebar')
        </div>

        <div class="drawer-content">
            <label for="drawer" class="lg:hidden btn btn-circle fixed bottom-6 right-6 z-50">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </label>
            <div class="p-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
