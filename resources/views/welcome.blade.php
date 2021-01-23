{{--
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
                <form action="{{ route('logout') }}" method="post">
                    <button type="submit">Logout</button>
                    @csrf
                </form>
                @endauth
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                API Bank-Sampa<a class="login" href="{{ route('login') }}">h</a>
            </div>

            <form action="">
                <input type="hidden" name="" id="">
            </form>

            <div class="links">
                <a href="https://laracasts.com">Rais</a>
                <a href="https://github.com/icatpojan">Irsyad Fauzan</a>
                <a href="https://github.com/hanifazzuhdi">Hanif Az Zuhdi</a>
            </div>
        </div>
    </div>
</body>

</html> --}}
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAMMPAH</title>
    <link rel="stylesheet" href="{{ asset('stylesheets.css') }}">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="header-right">
                <a href="{{ route('login') }}" class="login">SAMMPAH</a>
            </div>
        </div>
    </header>
    <div class="top-wrapper">
        <div class="container">
            <h1>SAMM<span class="fa  fa-twitter"></span>AH</h1>
            <h1>BUANG SAMPAH JADI UANG</h1>
            <p>Sammpah adalah platform online untuk mengelola limbah anda.</p>
            <p>Kami menawarkan sistem pengelolaan sampah yang mudah untuk kehidupan anda.</p>
            <div class="btn-wrapper">
                <a href="https://play.google.com/"><img src="{{ asset('google.svg') }}" alt="a"
                        style="height: 75px"></a>
                <p>lalu</p>
                <a href="#" class="btn facebook"><span></span>Daftar dengan gmail</a>
                <a href="#" class="btn twitter"><span></span>Daftar dengan email</a>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <p> <a href="https://laracasts.com">Rais Azaria</a>
                <a href="https://github.com/icatpojan">Irsyad Fauzan</a>
                <a href="https://github.com/hanifazzuhdi">Hanif Az Zuhdi</a>
            </p>
        </div>
    </footer>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
</body>

</html>
