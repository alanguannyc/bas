<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Big Apple Star Awards') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background: url("images/heroimage.jpg");
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                background-color: #fff;
                color: white;
                font-family: 'Raleway', sans-serif;
                font-weight: 800;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
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
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .btn{
                font-weight: 900;
            }

            
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/dashboard') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                        {{ config('app.name', 'Big Apple Star Awards') }}
                </div>
                @if (Auth::user() && Auth::user()->isAdmin())
                    <a href="/admin"><button type="button" id="start" class="btn btn-primary btn-lg btn-block">START</button></a>
                @elseif (Auth::user() && Auth::user()->isJudge())
                    <a href="/judge/0"><button type="button" id="start" class="btn btn-primary btn-lg btn-block">START</button></a>
                @elseif (Auth::user() && Auth::user()->isFinalJudge())
                    <a href="/final"><button type="button" id="start" class="btn btn-primary btn-lg btn-block">START</button></a>
                @else
                    <a href="/dashboard"><button type="button" id="start" class="btn btn-primary btn-lg btn-block">START</button></a>
                @endif
            </div>
        </div>
    </body>
</html>
