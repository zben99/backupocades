@extends('layouts.app-master',['title' => 'Vie Organisation'])
@section('content')
<div class="flexslider flexslider-simple h-full loading">
    <ul class="slides">
        <li data-zanim-timeline="{}">
            <section class="py-0">
                <div>
                    <div class="background-holder elixir-zanimm-scale" style="background: linear-gradient(
                    rgba(34, 0, 158, 0.4),
                    rgba(28, 252, 8, 0.1)
                    ),url(img/img4.jpg);background-size: cover;" data-zanimm='{"from":{"opacity":0.5,"filter":"blur(10px)","scale":1.05},"to":{"opacity":1,"filter":"blur(0px)","scale":1}}'>
                </div>
                <!--/.background-holder-->
                <div class="container">
                    <div class="row h-full py-8 align-items-center" data-inertia='{"weight":1.5}'>
                        <div class="col-sm-8 col-lg-7 px-5 px-sm-3">
                            <div class="overflow-hidden">
                                <h1 class="fs-4 fs-md-5 zopacity color-white" data-zanim='{"delay":0}'>
                                    VIE DE L'ORGANISATION
                                </h1>
                            </div>
                            <div class="overflow-hidden">
                                <p class="color-white mt-4 mb-5 lh-2 fs-2 fs-md-3 zopacity"
                                data-zanim='{"delay":0.1}'>
                                Ayez un apperçu de ce qui est fait chez <b>{{$config->nom}}</b>
                                </p>
                            </div>
                            @if(!Auth::user())
                            <div class="overflow-hidden">
                                <div class="zopacity" data-zanim='{"delay":0.2}'>
                                    <a class="btn btn-primary mr-3 mt-3" href="{{route('login')}}"><span class="fa fa-login-box "></span>&nbsp;Connectez-vous à l'application</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            <!--/.row-->
            </div>
            <!--/.container-->
        </section>
    </li>

</ul>
</div>

<section class="background-11">
    <h3 class="text-center fs-2 fs-lg-3 mt-2">Documents</h3>
    <hr class="short" data-zanim='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />

    <div class="container mt-4">
        <div class="row">
            @foreach($documents as $key => $document)
             @include("layouts.partials._singleDocument")
            @endforeach
        </div>
    </div>
</section>
@include('layouts.partials.statistiques')

@endsection

