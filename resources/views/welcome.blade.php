<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
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

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .login {
            text-decoration: none;
            color: inherit;
            cursor: inherit;
        }

        button {
            border: none;
            outline: none;
            font-size: 18px;
            background: transparent;
            margin-right: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <form action="{{route('logout')}}" method="post">
                <button type="submit">Logout</button>
                @csrf
            </form>
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                API Bank-Sampa<a class="login" href="{{route('login')}}">h</a>
            </div>

            <div class="links">
                <a href="https://laracasts.com">Rais</a>
                <a href="https://github.com/icatpojan">Irsyad Fauzan</a>
                <a href="https://github.com/hanifazzuhdi">Hanif Az Zuhdi</a>
            </div>
        </div>
    </div>
</body>

</html>
