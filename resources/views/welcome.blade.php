<!DOCTYPE html>
<html lang="en">

<head>
    <!--
    Boxer Template
    http://www.templatemo.com/tm-446-boxer
    -->
    <meta charset="utf-8">
    <title>OFFICE KAPAL PINTAR</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('welcome-page/css/animate.min.css') }}">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('welcome-page/css/bootstrap.min.css') }}">
    <!-- font-awesome -->
    <link rel="stylesheet" href="{{ asset('welcome-page/css/font-awesome.min.css') }}">
    <!-- google font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700,800' rel='stylesheet'
        type='text/css'>

    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('welcome-page/css/templatemo-style.css') }}">
</head>

<body>
    <!-- start preloader -->
    <div class="preloader">
        <div class="sk-spinner sk-spinner-rotating-plane"></div>
    </div>
    <!-- end preloader -->
    <!-- start navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>
                <a href="{{ route('home') }}" class="navbar-brand">KAPAL PINTAR</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right text-uppercase">
                    {{-- <li><a href="#home">Home</a></li>
                    <li><a href="#feature">Features</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#download">Download</a></li> --}}
                    <li><a href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navigation -->
    <!-- start home -->
    <section id="home">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10 wow fadeIn" data-wow-delay="0.3s">
                        <h1 class="text-upper">Sistem Inventori Kapal Pintar</h1>
                        <img src="{{ asset('welcome-page/images/software-img.png') }}" class="img-responsive"
                            alt="home img">
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- end home -->
    <!-- start divider -->
    <script src="{{ asset('welcome-page/js/jquery.js') }}"></script>
    <script src="{{ asset('welcome-page/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('welcome-page/js/wow.min.js') }}"></script>
    <script src="{{ asset('welcome-page/js/jquery.singlePageNav.min.js') }}"></script>
    <script src="{{ asset('welcome-page/js/custom.js') }}"></script>
</body>

</html>
