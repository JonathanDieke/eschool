<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{--  <meta http-equiv="content-type" content="text/html; charset=utf-8" charset="utf-8" />  --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? ' '  }} {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.4.1.js') }}" defer></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}" defer></script>
    <script src="{{ asset('js/preload.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 4000% 4000%;
            -webkit-animation: gradient 15s ease infinite;
                    animation: gradient 15s ease infinite;
        }

        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 80vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 30px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        @-webkit-keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>

</head>
<body>
    <main class="py-4 ">

        <div class="flex-center position-ref full-height">
        <div class="content">
            <h1 class="title">
                {{config('app.name')}}
            </h1>
            <div class="links">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}">@lang('Home')</a>
                    @else
                        <a href="{{ route('login') }}">@lang('Login')</a>
                    @endauth
                @endif
            </div>
        </div>
    </div>

    <div class="alert my-5">
        <h3 class="text-light small font-weight-bold text-center"><i class="fas fa-code"></i> with <i class="fas fa-heart"></i> by Jonathan Dieke</h3>
    </div>
    </main>

</body>
</html>
