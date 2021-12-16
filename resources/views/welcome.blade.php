<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ config('app.theme') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div class="hero min-h-screen bg-base-200">
        <div class="flex-col hero-content max-w-5xl lg:flex-row-reverse">
            <img src="https://picsum.photos/id/1/600/600" class="max-w-sm rounded-lg shadow-2xl">
            <div>
                <h1 class="mb-5 text-5xl font-bold">
                    Welcome to Rebonise SSO!
                </h1>
                <p class="mb-5">
                    Rebonise SSO is a service to manage your user management.
                    Consists of Users, Group, Roles, and Permissions.
                    Implemented OAuth2 as it's authentication.
                </p>
                <a href="{{ route('login') }}" class="btn btn-primary">
                    Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline">
                    Register
                </a>
            </div>
        </div>
    </div>
</body>

</html>
