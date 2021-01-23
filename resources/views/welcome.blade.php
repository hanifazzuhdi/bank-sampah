<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>SAMMPAH</title>
    <link rel="stylesheet" href="{{ asset('stylesheets.css') }}">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="header-left">
            </div>
            <div class="header-right">
                <a href="{{ route('login') }}" class="login">SAMMPAH</a>
            </div>
        </div>
    </header>
    <div class="top-wrapper">
        <div class="container">
            <h1>SAMM<span class="fa fa-twitter"></span>AH</h1>
            <h1>BUANG SAMPAH JADI UANG</h1>
            <p>Sammpah adalah platform online untuk mengelola limbah anda.</p>
            <p>Kami menawarkan sistem pengelolaan sampah yang mudah untuk kehidupan anda.</p>
            <div class="btn-wrapper">
                <a href="https://play.google.com/"><img src="{{asset('google.svg')}}" alt="a" style="height: 75px"></a>
                <p>lalu</p>
                <a href="#" class="btn facebook"><span></span>Daftar dengan gmail</a>
                <a href="#" class="btn twitter"><span></span>Daftar dengan email</a>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <p>
                <a target="_blank" href="https://laracasts.com">Rais Azaria</a>
                <a target="_blank" href="https://github.com/icatpojan">Irsyad Fauzan</a>
                <a target="_blank" href="https://github.com/hanifazzuhdi">Hanif Az Zuhdi</a></p>
        </div>
    </footer>
</body>

</html>
