@extends('layouts.app',['title'=>'Détails Projet'])

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

    #content{
        word-wrap: break-word;
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

    <a href="{{ route('projets.index') }}" class="d-sm-inline-block btn btn-secondary btn-icon-split">
        <span class="icon text-white">
            <i class="fas fa-layer-group"></i>
        </span>
        <span class="text">Tous les Projets</span>
    </a>

    <a href="{{ route('programs.show',$projet->projetprevisionnel->program_id) }}" class="d-sm-inline-block btn btn-primary btn-icon-split">
        <span class="icon text-white">
            <i class="fas fa-project"></i>
        </span>
        <span class="text">Voir le programme</span>
    </a>


</div>

<div class="container">
    <div class="row mx-2">
        <div class="col-md-12">

        <div class="project-info-box mt-0">
                <h5>{{ $projet->libelle }}</h5>
            </div><!-- / project-info-box -->
        </div>
        <div class="col-md-6 ">

            <div class="project-info-box mt-0">
                <p><b>Chef Projet:</b> {{ $projet->chefProjet }}</p>
                <p><b>Programme:</b> {{ $projet->projetprevisionnel->program->nom }}</p>
                <p><b>Budget:</b> {{ $projet->budget }} FCFA</p>
                <p><b>Montant:</b> {{ $projet->montantCharge }} FCFA</p>
                <p><b>Montant Equipement:</b> {{ $projet->montantEquipement }} FCFA</p>
                <p><b>Total Ressource Financière:</b> {{ $projet->totalRessFinanciere }} FCFA</p>
                <p><b>Dépense Bénéficiaire:</b> {{ $projet->depenseBeneficiaire }} FCFA</p>
                <p><b>Montant Total Dépensé:</b> {{ $projet->montantTotalDepense }} FCFA</p>
                <p><b>Date Début:</b> {{ $projet->debut->format('d/m/Y') }}</p>
                <p><b>Date Fin:</b> {{ $projet->fin->format('d/m/Y') }}</p>
            </div><!-- / project-info-box -->

        </div><!-- / column -->

        <div class="col-md-6">
            <div class="project-info-box mt-0" style="height: 200px;" id="content">
                <h5><b>{{ 'Description :' }}</b></h5>
                {{ $projet->description ?? '' }}
            </div>
            <div class="project-info-box" style="height: 200px;">
                <h5><b>{{ 'Secteur(s) :' }}</b></h5>
                @foreach ($projet->secteurs as $secteur)
                <p>{{ $secteur->nom ?? '' }}</p>
                @endforeach
            </div>
            <div class="project-info-box" style="height: 200px;">
                <h5><b>{{ 'Projet Previsionnel :' }}</b></h5>
                <p>{{ $projet->projetprevisionnel->libelle ?? '' }}</p>
                <p>{{ $projet->projetprevisionnel->objectGeneral ?? '' }}</p>
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
                        <li class="nav-item"><a class="nav-link" href="#activites" data-toggle="tab"> <i class="fas fa-1x fa-tasks"></i> Activités</a></li>
                        <li class="nav-item"><a class="nav-link" href="#documents" data-toggle="tab"> <i class="fas fa-1x fa-folder"></i> Documents</a></li>

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
                                                @foreach ($projet->partenaires as $key => $partenaire)
                                                <tr>
                                                    <th class="?40">{{ $key + 1 }}</th>
                                                    <td class="?41">
                                                        {{ $partenaire->typepartenaire->libelle }}
                                                    </td>
                                                    <td class="?42">{{ $partenaire->nom }}</td>
                                                    <td class="?43">{{ $partenaire->telephone }}
                                                    </td>
                                                    <td class="?44">
                                                        {{ $partenaire->pivot->montant }}
                                                    </td>
                                                    <td class="?45">
                                                        {{ $partenaire->pivot->description }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @if (count($projet->partenaires) >= 10)
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Type de partenaire</th>
                                                    <th>Partenaire</th>
                                                    <th>Téléphone</th>
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

                                    <h3 class="card-title">{{ __('LISTE DES ACTIVITES') }} </h3>

                                </div>

                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-bordered example1" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Activité</th>
                                                    <th>Quantité Réalisée</th>
                                                    <th>Coût Total</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($projet->projetPrevisionnel->activites as $key => $activite)
                                                <tr>
                                                    <th class="?53">{{ $key + 1 }}</th>
                                                    <td class="?55">{{ $activite->libelle }}</td>
                                                    <td>{{ getActiviteQuantiteTotal($activite->id) }}</td>
                                                    <td>{{ getActiviteCoutTotal($activite->id) }}</td>
                                                    <td>
                                                        <a href="{{ route('activites.details', $activite->id) }}">
                                                            <button class="btn btn-info btn-circle btn-sm ml-1 my-1" title="Details activite">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @if (count($projet->projetPrevisionnel->activites) >= 10)
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Activité</th>
                                                    <th>Quantité Réalisée</th>
                                                    <th>Coût Total</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                            @endif

                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="tab-pane" id="documents">
                            <div class=" mx-auto col-md-12 card ">
                                <div class="card-header">

                                    <h3 class="card-title">{{ __('LISTE DES DOCUMENTS') }} </h3>

                                </div>

                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-bordered example1" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Document</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $i = 0; ?>
                                                @foreach ($projet->documents as $document)
                                                <?php $i++; ?>
                                                <tr>
                                                    <th class="">{{ $i }}</th>
                                                    <td class=""><a href="{{ asset('projetFiles') }}/{{ $document->url }}" target="_blank">{{ $document->url }}</a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @if (count($projet->documents) >= 10)
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Document</th>
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
