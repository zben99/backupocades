@extends('layouts.app',['title'=>'Statistique Projet'])

@section('styles')
<style>
    .project {
        margin: 15px 0;
    }

    .no-gutter .project {
        margin: 0 !important;
        padding: 0 !important;
    }

    .has-spacer {
        margin-left: 30px;
        margin-right: 30px;
        margin-bottom: 30px;
    }

    .has-spacer-extra-space {
        margin-left: 30px;
        margin-right: 30px;
        margin-bottom: 30px;
    }

    .has-side-spacer {
        margin-left: 30px;
        margin-right: 30px;
    }

    .project-title {
        font-size: 1.25rem;
    }

    .project-skill {
        font-size: 0.9rem;
        font-weight: 400;
        letter-spacing: 0.06rem;
    }

    .project-info-box {
        margin: 15px 0;
        background-color: #fff;
        padding: 30px 40px;
        border-radius: 5px;
    }

    .project-info-box p {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #d5dadb;
    }

    .project-info-box p:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .myimg {
        width: 100%;
        max-width: 100%;
        height: auto;
        -webkit-backface-visibility: hidden;
    }

    .mr-5 {
        margin-right: 5px !important;
    }

    .mb-0 {
        margin-bottom: 0 !important;
    }

    .project-info-box p {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #d5dadb;
    }
    b,
    strong {
        font-weight: 700 !important;
    }
</style>
@endsection

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row my-2">
        </div>
    </div><!-- /.container-fluid -->
</section>


<div class="container">
    <div class="row mx-3 mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#projet" data-toggle="tab"> <i class="fas fa-1x fa-home"></i> Projet par secteur</a></li>
                        <li class="nav-item"><a class="nav-link" href="#projetP" data-toggle="tab"> <i class="fas fa-1x fa-hands-helping"> </i> Activités par Projet previsionnel</a></li>
                        <li class="nav-item"><a class="nav-link" href="#activite" data-toggle="tab"> <i class="fas fa-1x fa-church"></i> Activités par paroisse</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#activiteP" data-toggle="tab"> <i
                                        class="fas fa-1x fa-city"></i> Activités prévisionnelle par commune</a></li> -->

                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="projet">
                            <div class=" mx-auto col-md-12 card">
                                <div class="card-header">

                                    <h3 class="card-title">{{ __('Nombre de projets par secteur') }} </h3>

                                </div>

                                <div class="card-body">

                                    <div class="row">
                                        @foreach ($statPro as $key => $value)


                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-home"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">{{ $key }}</span>
                                                    <span class="info-box-number">
                                                        {{ $value }}
                                                        <small>projets</small>
                                                    </span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane" id="projetP">
                            <div class=" mx-auto col-md-12 card ">
                                <div class="card-header">

                                    <h3 class="card-title">
                                        {{ __('Nombre d\'activités previsionnelles par projet previsionnelle') }}
                                    </h3>

                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($statProP as $key => $value)
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-tasks  "></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">{{ $key }}</span>
                                                    <span class="info-box-number">
                                                        {{ $value }}
                                                        <small>activités</small>
                                                    </span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="tab-pane" id="activite">
                            <div class=" mx-auto col-md-12 card ">
                                <div class="card-header">

                                    <h3 class="card-title">{{ __('Nombre d\'activités par paroisse') }} </h3>

                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($statAct as $key => $value)
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-church "></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">{{ $key }}</span>
                                                    <span class="info-box-number">
                                                        {{ $value }}
                                                        <small>activités</small>
                                                    </span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- <div class="tab-pane" id="activiteP">
                            <div class=" mx-auto col-md-12 card ">
                                <div class="card-header">

                                    <h3 class="card-title">
                                        {{ __('Nombre d\'activités prévisionnelles par commune') }}
                                    </h3>

                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($statActP as $key => $value)
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-city "></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">{{ $key }}</span>
                                                    <span class="info-box-number">
                                                        {{ $value }}
                                                        <small>activités</small>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div> -->

                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<section class="content-header">
    <div class="container-fluid">
        <div class="row my-2">
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Fin Modal-->
@endsection
@section('scripts')
<script>
    function refresh() {
        location.reload(true);
    }
    //Initialize Select2 Elements
    $('.select2').select2();
</script>
@endsection
