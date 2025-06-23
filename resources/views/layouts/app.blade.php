<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Wallet Manager') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="{{ asset('login-template/css/style.css') }}" rel="stylesheet" />

    <style>
        .custom-input {
            background-color: transparent !important;
            border: 2px solid #09FF00 !important;

        }

        .custom-input::placeholder {
            background-color: transparent !important;

        }
    </style>
</head>

<body class="img js-fullheight" style="background-image: url({{ asset('login-template/images/background.png') }});">
    <div id="app">


        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('login-template/js/jquery.min.js') }}"></script>
    <script src="{{ asset('login-template/js/popper.js') }}"></script>
    <script src="{{ asset('login-template/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login-template/js/main.js') }}"></script>
</body>

</html>
