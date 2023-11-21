@extends('layouts.app-master',['title' => 'Détails Document'])

@section('styles')
<style>
    .panel-title {
        position: relative;
    }

    .panel-title::after {
        content: "\f107";
        color: #333;
        top: -2px;
        right: 0px;
        position: absolute;
        font-family: "FontAwesome"
    }

    .panel-title[aria-expanded="true"]::after {
        content: "\f106";
    }

</style>
@endsection

@section('content')
<section>
    <div>
        <div class="background-holder overlay" style=" background-image: url({{asset('img/proj6.jpg')}}); background-position: cover;"></div>
            <!--/.background-holder-->
            <div class="container">
                <div class="row pt-6" data-inertia='{"weight":1.5}'>
                    <div class="col-md-8 px-md-0 color-white" data-zanim-timeline="{}" data-zanim-trigger="scroll">
                        <div class="overflow-hidden">
                            <div class="">
                                <img src="{{ asset('logo/'.$document->logo)}}" alt="Pas de logo" id="imageEdit" style="width:150px;height: 150px;">
                            </div>
                            <h1 class="color-white fs-4 fs-md-5 mb-0 zopacity" data-zanim='{"delay":0}'>
                                {{$document->nom}}
                            </h1>
                            <div class="nav zopacity" aria-label="breadcrumb" role="navigation"
                            data-zanim='{"delay":0.1}'>
                            <ol class="breadcrumb fs-1 pl-0 fw-700">
                                <li class="breadcrumb-item">
                                    <a class="color-white" href="{{route('index') }}">Documents</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Détails
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</section>
<section class="background-white">
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="list-group ">
                    <div class="">
                        <img src="{{ asset('logo/'.$document->logo)}}" alt="Pas de logo" id="imageEdit" style="width:150px;height: 150px;">
                    </div>
                    <a href="#details" class="list-group-item list-group-item-action" id="btn_details">Détails</a>
                    <a href="#modules" class="list-group-item list-group-item-action" id="btn_modules">Fichiers attachés</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">

                    <div class="card-body" id="details">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Détails</h4>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="accordion" class="col-12">
                                <div class="card">
                                        <div class="card-header" id="headineThree">
                                            <h5 class="panel-title" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">Type de document</h5>
                                        </div>
                                        <div id="collapseThree" class="collapse show" aria-labelledby="headineThree" data-parent="#accordion">
                                            <div class="card-body">
                                                {{$document->type->libelle}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="panel-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Résumé</h5>
                                        </div>
                                        <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                {{$document->resume}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headineTwo">
                                            <h5 class="panel-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Auteur</h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headineTwo" data-parent="#accordion">
                                            <div class="card-body">
                                                {{$document->auteur}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header" id="headineFour">
                                            <h5 class="panel-title" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">Date de publication</h5>
                                        </div>
                                        <div id="collapseFour" class="collapse" aria-labelledby="headineFour" data-parent="#accordion">
                                            <div class="card-body">
                                            {{\Carbon\Carbon::parse($document->date_publication)->translatedFormat('d M Y')}} | {{$document->nb_pages}} pages.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" id="modules">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Fichiers attachés</h4>
                                <hr>
                            </div>
                        </div>
                        <div id="accordion" class="col-12">
                            @foreach ($document->fichiers as $key => $file)
                            @php
                                $extension = strtolower(pathinfo($file->url, PATHINFO_EXTENSION));
                                $valideVideo = array('mp4');
                                $valideImage = array('png','jpeg','jpg','webp');
                                $test = (in_array($extension, $valideVideo))?1:((in_array($extension, $valideImage))?2:0);
                            @endphp
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="panel-title" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">{{ str_replace($document->id . '_', '', $file->url) }}</h5>
                                </div>
                                <div id="collapse{{$key}}" class="collapse @if($key===0) show @endif" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        @if($test==1)
                                        <video style="margin-bottom: 25px" width="100%" controls >
                                            <source src="{{asset('telechargements/documents/'.$file->url)}}" type="video/mp4">
                                            Votre navigateur ne supporte pas le format de cette vidéo.
                                        </video>
                                        @elseif($test==2)
                                            <img src="{{ asset('telechargements/documents/'.$file->url )}}" alt="">
                                        @else
                                        {{ str_replace($document->id . '_', '', $file->url) }}

                                        <a href="{{ route('fichier-documents.open', $file->url) }}">
                                            <button class="btn btn-success btn-info btn-sm ml-1 my-1" title="Ouvrir">
                                                <b class="">Lire ou télecharger le fichier</b>
                                            </button>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


</section>

<hr class="background-primary py-0" height="3">

@endsection
@section('scripts')
<script>
    $("#btn_details").addClass('active');
    $("#modules").hide();

    $("#btn_details").click(function(event) {
        $(this).addClass('active');
        $("#btn_sessions").removeClass('active');
        $("#btn_modules").removeClass('active');
        $("#details").show();
        $("#modules").hide();
        $("#sessions").hide();
    });

    $("#btn_modules").click(function(event) {
        $(this).addClass('active');
        $("#btn_details").removeClass('active');
        $("#btn_sessions").removeClass('active');
        $("#details").hide();
        $("#modules").show();
        $("#sessions").hide();
    });
</script>
@endsection
