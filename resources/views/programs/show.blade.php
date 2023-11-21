@extends('layouts.app',['title'=>'Details Programme'])


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

    <a href="{{ route('programs.index') }}" class="d-sm-inline-block btn btn-secondary btn-icon-split">
        <span class="icon text-white">
            <i class="fas fa-layer-group"></i>
        </span>
        <span class="text">Tous les programmes</span>
    </a>

    <a data-toggle="modal" data-target="#rapportModal" class="d-sm-inline-block btn btn-primary btn-icon-split">
        <span class="icon text-white">
            <i class="fas fa-file-excel"></i>
        </span>
        <span class="text">Générer rapport</span>
    </a>


</div>

<div class="container">
    <div class="row mx-2">
        <div class="col-md-6 ">
            <div class="project-info-box mt-0">
                <h5>{{$program->nom??''}}</h5>
            </div><!-- / program-info-box -->

            <div class="project-info-box">
                <p class="mb-0"><b>Nombre de Projets:</b> {{count($program->projetsPrevisionnels??'')}}</p>
                <p><b>Budget Total:</b> {{ getBudget($program->id) }} FCFA</p>
            </div><!-- / program-info-box -->

            <div class="project-info-box mt-0 mb-0">
                <p><b>Description</b></p>
                <p><b></b> {{$program->description}}</p>
            </div>
            <!-- / program-info-box -->
        </div><!-- / column -->

        <div class="col-md-6">
            {{-- <img src="{{asset('img/bills.svg')}}" alt="program-image" class="myimg rounded"> --}}
            <div id="mon-chart" style="height: 500px;"></div>
            <!-- / program-info-box -->

        </div><!-- / column -->
    </div>

    <div class="row mx-3 mt-3">
        <div class="col-md-12 card shadow border-left-secondary">
        <div class="card-header">
            <h3 class="card-title">{{ __('LISTE DES PROJETS CONCERNES') }}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-bordered" width="100%" id="example1" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Secteur</th>
                            <th>Projet</th>
                            <th>Description</th>
                            <th>Budget</th>
                            <th>Periode</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($program->projetsPrevisionnels)>0)
                        <?php $i = 0;
                        ?>
                        @foreach ($program->projetsPrevisionnels as $projs)
                        @foreach($projs->projets as $projet)
                        <?php $i++;
                        ?>
                        <tr>
                            <th>{{ $i }}</th>
                            <td>@foreach ($projet->secteurs as $secteur) {{ $secteur->nom }} @endforeach</td>
                            <td>{{ $projet->libelle }}</td>
                            <td>{{ $projet->description }}</td>
                            <td>{{ $projet->budget }}</td>
                            <td>{{ $projet->debut->format('d/m/Y') }} - {{ $projet->fin->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('projets.show', $projet->id) }}">
                                    <button class="btn btn-info btn-circle btn-sm ml-1 my-1" title="Details projet">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </a>

                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                        @endif
                    </tbody>
                    @if (count($program->projetsPrevisionnels ) >= 10)
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Secteur</th>
                            <th>Projet</th>
                            <th>Description</th>
                            <th>Budget</th>
                            <th>Periode</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="rapportModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title m-auto">GENERER UN RAPPORT ANNUEL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-gradient-light">
                <div class="alert alert-warning" style="display:none"></div>
                <form method="post" action="{{ route('programs.rapportImprimer') }}">
                    {{ csrf_field() }}
                    @include('programs.rapport')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Annuler</button>
                        <button type="submit" class="btn btn-primary close-modal">Générer</button>
                    </div>
                </form>

            </div>
        </div>
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Projet', 'Taux \'execution budgetaire'],
            @if(count($program->projetsPrevisionnels)>0)
                @foreach($program->projetsPrevisionnels as $projs)
                    @foreach($projs->projets as $project)
                        ["{{ $project->libelle }}", {{ $project->budget }}], // poids par program
                    @endforeach
                 // poids par program
                @endforeach
            @endif
        ]);

        var options = {
            title: 'Répartition du Budget entre projets', // Le titre
            is3D: true // En 3D
        };

        // On crée le chart en indiquant l'élément où le placer "#mon-chart"
        var chart = new google.visualization.PieChart(document.getElementById('mon-chart'));

        // On désine le chart avec les données et les options
        chart.draw(data, options);
    }

    $('#addRegion').on('submit', (function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();
        var formData = new FormData(this);
        let _url = '/rapport/excel';
        $.ajax({
            url: _url,
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

                location.reload(true);
                $('#debut').text('');
                $('#fin').text('');

            },
            error: function(response) {

                $('#debutError').text('');
                $('#debutError').text(response.responseJSON.errors.debut);
                $('#finError').text('');
                $('#finError').text(response.responseJSON.errors.fin);

            }
        });
    }));
</script>
@endsection
