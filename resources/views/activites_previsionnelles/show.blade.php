@extends('layouts.app',['title'=>'Détails Activite previsionnelle'])

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

    <a href="{{ route('activites-previsionnelles.index') }}" class="d-sm-inline-block btn btn-secondary btn-icon-split">
        <span class="icon text-white">
            <i class="fas fa-layer-group"></i>
        </span>
        <span class="text">Toutes les activités prévisionelles</span>
    </a>


</div>
<div class="container">
    <div class="row mx-2">
        <div class="col-md-6 ">
            <div class="project-info-box mt-0">
                <h5>{{ $activite->libelle }}</h5>
            </div>

            <div class="project-info-box">
                <p><b>Montant total realisation:</b> {{ $activite->cout_total_realisation }} FCFA</p>
                <p><b>Unite physique: </b> {{ $activite->unite_physique }}</p>
                <p><b>Quantite à realiser: </b> {{ $activite->quantite }}</p>
                <p><b>Type beneficiaire: </b> {{ $activite->type_beneficiaire }}</p>
                <p><b>Contribution beneficiaire: </b> {{ $activite->contrib_beneficiaire }}</p>
                <p><b>Date de réalisation: </b> {{ \Carbon\Carbon::parse($activite->date_realisation)->translatedFormat('d M Y') }}</p>
                <p><b>Region: </b> {{ $activite->region->nom ?? '' }}</p>
                <p><b>Commune(s): </b> {{ implode(',',$activite->communes()->pluck('commune')->toArray()) ?? '' }}</p>
                <p><b>Paroisse(s): </b> {{ implode(',',$activite->paroisses()->pluck('paroisse')->toArray()) ?? '' }}</p>
                <p><b>Village(s): </b> {{  implode(',',$activite->villages()->pluck('village')->toArray()) ?? '' }}</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="project-info-box">
                <p><b>{{ 'Projet previsionnelle :' }} </b>{{ $activite->projetPrevisionnel->nom ?? '' }}</p>
                <p><b>Date de debut: </b> {{ \Carbon\Carbon::parse($activite->projetPrevisionnel->debut)->translatedFormat('d M Y') ?? ''}}</p>

                <p><b>Montant:</b> {{ $activite->projetPrevisionnel->montant ?? ''}} FCFA</p>

                <p><b>{{ 'Résultat(s) / Produit(s) attendus:' }}</b>
                {{ $activite->projetPrevisionnel->resultatAttendu ?? '' }}</p>

                <p><b>{{ 'Objectif Principal / Impact:' }}</b>
                {{ $activite->projetPrevisionnel->objectGeneral ?? '' }}</p>

            </div>
            <div class="project-info-box" style="height: 250px;">
                <h5><b>{{ 'Objectifs Spécifiques / Effets :' }}</b></h5>
                <p>{{ implode(',',$activite->objectif_specifiques->pluck('nom')->toArray()) ?? '' }}</p>
            </div>
        </div>
    </div>

    <div class="row mx-3 mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#parts" data-toggle="tab"> <i class="fas fa-1x fa-user-cog"></i>Partenaires</a></li>
                        <li class="nav-item"><a class="nav-link" href="#indics" data-toggle="tab"> <i class="fas fa-1x fa-user-cog"></i>Indicateurs</a></li>

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
                                                    <th>Contribution</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $i = 0; ?>
                                                @foreach ($activite->partenaires as $partenaire)
                                                <?php $i++; ?>
                                                <tr>
                                                    <th class="">{{ $i }}</th>
                                                    <td class="">{{ $partenaire->typepartenaire->libelle }}</td>
                                                    <td class="">{{ $partenaire->nom }}</td>
                                                    <td class="">{{ $partenaire->telephone }}</td>
                                                    <td class="">{{ $partenaire->pivot->montant }}</td>
                                                    <td class="">{{ $partenaire->pivot->description }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @if (count($activite->partenaires) >= 10)
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

                        <div class="tab-pane" id="indics">
                            <div class=" mx-auto col-md-12 card">
                                <div class="card-header">

                                    <h3 class="card-title">{{ __('LISTE DES INDICATEURS') }} </h3>

                                </div>

                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-bordered example1" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Indicateur</th>
                                                    <th>Type</th>
                                                    <th>Valeur</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $i = 0; ?>
                                                @foreach ($activite->indicateurs as $indicateur)
                                                <?php $i++; ?>
                                                <tr>
                                                    <th class="">{{ $i }}</th>
                                                    <td class="">{{ $indicateur->nom }}</td>
                                                    <td class="">{{ $indicateur->type }}</td>
                                                    <td class="">{{ $indicateur->valeur }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @if (count($activite->indicateurs) >= 10)
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Indicateur</th>
                                                    <th>Type</th>
                                                    <th>Valeur</th>
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
