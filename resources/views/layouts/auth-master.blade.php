<?php
    $config = \App\Models\Config::first();
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--  -->
    <!--    Document Title-->
    <!-- =============================================-->
    <title>{{page_title($config->nom)}}  - @yield('title')</title><!--  -->
    <!--    Favicons-->
    <!--    =============================================-->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/dms/icone.svg') }}">

    <meta name="theme-color" content="#ffffff"><!--  -->
    <!--    Stylesheets-->
    <!--    =============================================-->
    <!-- Default stylesheets-->
    <link href="{{ asset('assets/lib/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"><!-- Template specific stylesheets-->
    <link href="{{ asset('assets/lib/loaders.css/loaders.min.css') }}" rel="stylesheet">
    <link href="../../fonts.googleapis.com/cssc68f.css?family=Montserrat:300,400,500,600,700|Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="{{ asset('assets/lib/iconsmind/iconsmind.css') }}" rel="stylesheet">
    <link href="../../code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <link href="{{ asset('assets/lib/hamburgers/dist/hamburgers.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Main stylesheet and color file-->
    @yield('styles')
    @livewireStyles
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

        @yield('content')

    </main><!--  -->
    <!--    JavaScripts-->
    <!--    =============================================-->
    <script src="../../cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="{{ asset('assets/lib/jquery/dist/jquery.min.js') }}"></script>
    <script src="../../cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
</script>
<script src="{{ asset('assets/lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/lib/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/lib/gsap/src/minified/TweenMax.min.js') }}"></script>
<script src="{{ asset('assets/lib/gsap/src/minified/plugins/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('assets/lib/CustomEase.min.js') }}"></script>
<script src="{{ asset('assets/js/config.js') }}"></script>
<script src="{{ asset('assets/js/zanimation.js') }}"></script>
<script src="{{ asset('assets/js/inertia.js') }}"></script>
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:710415,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'../../static.hotjar.com/c/hotjar-','.js?sv=');

</script><!-- Global site tag (gtag.js) - Google Analytics-->
<script async="" src="../../www.googletagmanager.com/gtag/js2828?id=UA-76729372-5"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-76729372-5');

</script>
<script src="{{ asset('assets/js/core.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@livewireScripts

@yield('scripts')

</body>


</html>
