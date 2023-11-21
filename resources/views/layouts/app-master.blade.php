
<?php
    $config = \App\Models\Config::first();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#ffffff">

    <title>{{page_title($config->nom)}}</title>

    <link rel="icon" type="image/png" href="{{ asset('img/yam.png') }}">

    <link href="{{ asset('assets/lib/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/loaders.css/loaders.min.css') }}" rel="stylesheet">
    <link href="../../fonts.googleapis.com/cssc68f.css?family=Montserrat:300,400,500,600,700|Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="{{ asset('assets/lib/iconsmind/iconsmind.css') }}" rel="stylesheet">
    <link href="../../code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <link href="{{ asset('assets/lib/hamburgers/dist/hamburgers.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/owl.carousel/dist/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/remodal/dist/remodal.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/remodal/dist/remodal-default-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/flexslider/flexslider.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/lightbox2/dist/css/lightbox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/owl.carousel/dist/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css') }}" rel="stylesheet">

    @yield('styles')
</head>

<body data-spy="scroll" data-target=".inner-link" data-offset="60">
    <main>
        <div class="loading" id="preloader">
            <div class="loader h-100 d-flex align-items-center justify-content-center">
                <div class="line-scale">
                    @for ($i=0;$i<5;$i++)
                    <div></div>
                    @endfor
                </div>
            </div>
        </div>
        <section class="background-primary py-3 d-none d-sm-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-auto d-none d-lg-block"><span
                        class="fa fa-map-marker color-success fw-800 icon-position-fix"></span>
                        <p class="ml-2 mb-0 fs--1 d-inline color-white fw-700">{{ $config->adresse ?? ''}} </p>
                    </div>
                    <div class="col-auto ml-md-auto order-md-2 d-none d-sm-block"><span
                        class="fa fa-clock-o color-success fw-800 icon-position-fix"></span>
                        <p class="ml-2 mb-0 fs--1 d-inline color-white fw-700"><a href="{{$config->site??'#'}}"></a> {{$config->site??''}}</p>
                    </div>
                    <div class="col-auto"><span class="fa fa-phone color-success fw-800 icon-position-fix"></span>
                        <a class="ml-2 mb-0 fs--1 d-inline color-white fw-700" href="tel:{{$config->telephone??''}}">{{ $config->telephone??''}}</a>

                    </div>
                </div>
                <!--/.row-->
            </div>
            <!--/.container-->
        </section>
        <div class="znav-white znav-container sticky-top navbar-elixir" id="znav-container">
            <div class="container">
                <nav class="navbar navbar-expand-lg"><a class="navbar-brand overflow-hidden pr-3" href="{{ route('index') }}"><img src="{{ asset('logo/'.$config->logo) }}" width="70" height="40" alt="Image" /></a><button class="navbar-toggler" type="button"
                    data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <div class="hamburger hamburger--emphatic">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav fs-0 fw-700">
                        <li><a class="d-block" href="{{ route('index') }}">Accueil</a></li>

                    </ul>
                    <ul class="navbar-nav ml-lg-auto">

                        @if(!Auth::user())
                        <li><a class="btn btn-outline-primary btn-capsule btn-sm border-2x fw-700" href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Connexion</a>
                        </li>
                        @else
                        <li><a class="btn btn-outline-primary btn-capsule btn-sm border-2x fw-700 mr-md-1" href="{{ route('home') }}"><i class="fa fa-tachometer" aria-hidden="true"></i></i> Tableau de bord</a>
                        </li>
                        <li>
                            <form action="{{ route('logout')}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-capsule btn-sm border-2x fw-700"><i
                                    class="fa fa-power-off" aria-hidden="true"></i> Déconnexion</button>
                                </form>
                            </li>
                        @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        @yield('content')

        <!-- <section class="background-primary text-center py-4">
            <div class="container">
                <div class="row align-items-center" style="opacity: 0.85">
                    <div class="col-sm-3 text-sm-left"><a href="{{ route('index') }}"><img src="{{ asset('assets/images/dms/logo3.png') }}" width="100" alt="Logo de DMS Consulting" /></a></div>
                    <div class="col-sm-6 mt-3 mt-sm-0">
                        <p class="color-white lh-6 mb-0 fw-600">Copyright&copy;2021 <a target="blanc" href="{{\App\Models\Config::first()->site}}">{{\App\Models\Config::first()->nom}}</a>.</p>
                    </div>

                    <div class="col text-sm-right mt-3 mt-sm-0 color-white">Développé par <a class="color-white" href="#" target="_blank">Yam-Pukri</a></div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<section class="background-light text-center py-3">
@include('layouts.partials._footer')
</section>
</main>
<!--    JavaScripts-->
<!--    =============================================-->
<script src="../../cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script src="{{ asset('assets/lib/jquery/dist/jquery.min.js') }}"></script>

<script src="../../cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
</script>
<script src="{{ asset('assets/lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/lib/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/lib/gsap/src/minified/TweenMax.min.js') }}"></script>
<script src="{{ asset('assets/lib/gsap/src/minified/plugins/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('assets/lib/CustomEase.min.js') }}"></script>
<script src="{{ asset('assets/js/config.js') }}"></script>
<script src="{{ asset('assets/js/zanimation.js') }}"></script>
<script src="{{ asset('assets/js/inertia.js') }}"></script>
<script src="assets/lib/owl.carousel/dist/owl.carousel.min.js"></script>
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)}
        h._hjSettings={hjid:710415,hjsv:6}
        a=o.getElementsByTagName('head')[0]
        r=o.createElement('script')r.async=1
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv
        a.appendChild(r)
    })(window,document,'../../static.hotjar.com/c/hotjar-','.js?sv=')

</script><!-- Global site tag (gtag.js) - Google Analytics-->
<script async="" src="../../www.googletagmanager.com/gtag/js2828?id=UA-76729372-5"></script>
<script>
    window.dataLayer = window.dataLayer || []
    function gtag(){dataLayer.push(arguments)}
    gtag('js', new Date())
    gtag('config', 'UA-76729372-5')

</script>
<script src="{{ asset('assets/lib/owl.carousel/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/lib/remodal/dist/remodal.js') }}"></script>
<script src="{{ asset('assets/lib/lightbox2/dist/js/lightbox.js') }}"></script>
<script src="{{ asset('assets/lib/flexslider/jquery.flexslider-min.js') }}"></script>
<script src="{{ asset('assets/js/core.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@include('sweetalert::alert')
<!--/.container-->
</section>
</main>
<!--    JavaScripts-->
<!--    =============================================-->
@yield('scripts')
</body>

</html>
