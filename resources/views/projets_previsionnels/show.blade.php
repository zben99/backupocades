@extends('layouts.app',['title'=>'Détails ProjetPrévisionnel'])

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
<div class="d-sm-flex align-items-center mb-5 ml-5 col-md-10 justify-content-between">

    <a href="{{ route('projets-previsionnels.index') }}" class="d-sm-inline-block btn btn-secondary btn-icon-split">
        <span class="icon text-white">
            <i class="fas fa-layer-group"></i>
        </span>
        <span class="text">Tous les Projets Prévisionnels</span>
    </a>


</div>


<div class="container">
    <div class="row mx-2">
        <div class="col-md-6 ">
            <div class="project-info-box mt-0">
                <h5>{{ $projetPrevisionnel->nom }}</h5>
            </div><!-- / project-info-box -->

            <div class="project-info-box">
                <p><b>Montant:</b> {{ $projetPrevisionnel->montant }} FCFA</p>
                <p><b>Date Début:</b>
                    {{ \Carbon\Carbon::parse($projetPrevisionnel->debut)->translatedFormat('d M Y') }}
                </p>
                <p class="mb-0"><b>Date Fin:</b>
                    {{ \Carbon\Carbon::parse($projetPrevisionnel->fin)->translatedFormat('d M Y') }}
                </p>
            </div><!-- / project-info-box -->
            <div class="project-info-box">
                <h5><b>{{ 'Résultat(s) / Produit(s):' }}</b></h5>
                <p>{{ $projetPrevisionnel->resultatAttendu ?? '' }}</p>
            </div>
        </div><!-- / column -->

        <div class="col-md-6 mt-0">
            {{-- <img src="{{asset('img/bills.svg')}}" alt="project-image" class="myimg rounded"> --}}
            <div class="project-info-box mt-0" style="height: 250px;">
                <h5><b>{{ 'Objectif Principal / Impact:' }}</b></h5>
                <p>{{ $projetPrevisionnel->objectGeneral ?? '' }}</p>
            </div>


            <!-- / column -->
        </div>
    </div>

    <div class="row mx-3 mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#parts" data-toggle="tab"> <i class="fas fa-1x fa-user-cog"></i> Partenaires</a></li>
                        <li class="nav-item"><a class="nav-link" href="#activites" data-toggle="tab"> <i class="fas fa-1x fa-tasks"></i> Activités Prévisionnels</a></li>

                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="parts">
                            <div class=" mx-auto col-md-12 card">
                                <div class="card-header">

                                    <h3 class="card-title">{{ __('LISTE DES PARTENAIRES') }} </h3>

                                </div>

                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-bordered example1" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Type de partenaire</th>
                                                    <th>Partenaire</th>
                                                    <th>Téléphone</th>
                                                    <th>Email</th>
                                                    <th>Adresse</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $i = 0; ?>
                                                @foreach ($projetPrevisionnel->partenaires as $partenaire)
                                                <?php $i++; ?>
                                                <tr>
                                                    <th>{{ $i }}</th>
                                                    <td>
                                                        {{ $partenaire->typepartenaire->libelle }}
                                                    </td>
                                                    <td>{{ $partenaire->nom }}</td>
                                                    <td>{{ $partenaire->telephone }}
                                                    </td>
                                                    <td>{{ $partenaire->email }}</td>
                                                    <td>{{ $partenaire->adresse }}</td>
                                                    <td>{{ $partenaire->description }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @if (count($projetPrevisionnel->partenaires) >= 10)
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Type de partenaire</th>
                                                    <th>Partenaire</th>
                                                    <th>Téléphone</th>
                                                    <th>Email</th>
                                                    <th>Adresse</th>
                                                    <th>Description</th>
                                                </tr>
                                            </tfoot>
                                            @endif

                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane" id="activites">
                            <div class=" mx-auto col-md-12 card ">
                                <div class="card-header">

                                    <h3 class="card-title">{{ __('LISTE DES ACTIVITES PREVISIONNELS') }} </h3>

                                </div>

                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-bordered example1" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Projet</th>
                                                    <th>Projet prévisionnel</th>
                                                    <th>Quantité</th>
                                                    <th>Coût</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $i = 0; ?>
                                                @foreach ($projetPrevisionnel->activites as $activitePrevisionnelle)
                                                <?php $i++; ?>
                                                <tr>
                                                    <th>{{ $i }}</th>
                                                    <td>
                                                        {{ $activitePrevisionnelle->projetPrevisionnel->nom }}
                                                    </td>
                                                    <td>
                                                        {{ $activitePrevisionnelle->libelle }}
                                                    </td>
                                                    <td>
                                                        {{ $activitePrevisionnelle->quantite }}
                                                    </td>
                                                    <td>
                                                        {{ $activitePrevisionnelle->cout }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @if (count($projetPrevisionnel->activites) >= 10)
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Projet</th>
                                                    <th>Projet prévisionnel</th>
                                                    <th>Quantité</th>
                                                    <th>Coût</th>
                                                </tr>
                                            </tfoot>
                                            @endif

                                        </table>
                                    </div>
                                </div>

                            </div>

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
