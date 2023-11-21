@extends('layouts.app',['title'=>'Projet Prévisionnels'])


@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row my-3">
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class=" mx-auto col-md-11 card shadow border-left-secondary">
    <div class="card-header">
        <h3 class="card-title">{{ __('LISTE DES PROJETS PREVISIONNELS') }}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool">
                <a class="d-sm-inline-block btn btn-secondary btn-icon-split" data-toggle="modal" data-target="#addProjetPrevisionnelModal">
                    <span class="icon text-white">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Nouveau Projet Prévisionnel</span>
                </a>
            </button>
            <button type="button" class="btn btn-tool">
                <a class="d-sm-inline-block btn btn-primary btn-icon-split" onclick="refresh()">
                    <img class="nav-icon" width="30px" height="30px" src="{{ asset('img/icons/provenance.ico') }}" />
                    <span class="text">Actualiser</span>
                </a>
            </button>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-bordered" width="100%" id="example1" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Projet prévisionnel</th>
                        <th>Montant</th>
                        <th>Date Debut</th>
                        <th>Date Fin</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 0; ?>
                    @cannot('manage-users')
                    @foreach ($projetPrevisionnels as $projetPrevisionnel)
                    @if ($projetPrevisionnel->agent == Auth::user()->id)
                    <?php $i++; ?>
                    <tr>
                        <th>{{ $i }}</th>
                        <td>{{ $projetPrevisionnel->nom }}</td>
                        <td>{{ $projetPrevisionnel->montant }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($projetPrevisionnel->debut)->format('d M Y') }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($projetPrevisionnel->fin)->format('d M Y') }}
                        </td>
                        <td>

                            <button class="btn btn-warning btn-circle btn-sm ml-1 my-1" data-id="{{ $projetPrevisionnel->id }}" data-nom="{{ $projetPrevisionnel->nom }}" data-res="{{ $projetPrevisionnel->resultatAttendu }}" data-obj="{{ $projetPrevisionnel->objectGeneral }}" data-debut="{{ $projetPrevisionnel->debut }}" data-fin="{{ $projetPrevisionnel->fin }}" data-parts="{{ getProjetPrevPartners($projetPrevisionnel->id) }}" data-montant="{{ $projetPrevisionnel->montant }}" data-toggle="modal" data-target="#editProjetPrevisionnelModal" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="{{ route('projets-previsionnels.show', $projetPrevisionnel->id) }}">
                                <button class="btn btn-info btn-circle btn-sm ml-1 my-1" title="Details projet previsionnel">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </a>
                            <button class="btn btn-danger btn-circle btn-sm ml-2 my-1" data-rep="{{ $projetPrevisionnel->id }}" data-info="{{ $projetPrevisionnel->nom }}" data-toggle="modal" data-target="#delete" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    @endcannot

                    @can('manage-users')
                    @foreach ($projetPrevisionnels as $projetPrevisionnel)
                    <?php $i++; ?>
                    <tr>
                        <th>{{ $i }}</th>
                        <td>{{ $projetPrevisionnel->nom }}</td>
                        <td>{{ $projetPrevisionnel->montant }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($projetPrevisionnel->debut)->format('d M Y') }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($projetPrevisionnel->fin)->format('d M Y') }}
                        </td>
                        <td>
                            <button class="btn btn-warning btn-circle btn-sm ml-1 my-1" data-id="{{ $projetPrevisionnel->id }}" data-nom="{{ $projetPrevisionnel->nom }}" data-res="{{ $projetPrevisionnel->resultatAttendu }}" data-obj="{{ $projetPrevisionnel->objectGeneral }}" data-debut="{{ $projetPrevisionnel->debut }}" data-fin="{{ $projetPrevisionnel->fin }}" data-parts="{{ getProjetPrevPartners($projetPrevisionnel->id) }}" data-montant="{{ $projetPrevisionnel->montant }}" data-toggle="modal" data-target="#editProjetPrevisionnelModal" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="{{ route('projets-previsionnels.show', $projetPrevisionnel->id) }}">
                                <button class="btn btn-info btn-circle btn-sm ml-1 my-1" title="Details projet previsionnel">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </a>
                            <button class="btn btn-danger btn-circle btn-sm ml-2 my-1" data-rep="{{ $projetPrevisionnel->id }}" data-info="{{ $projetPrevisionnel->nom }}" data-toggle="modal" data-target="#delete" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    @endcan
                </tbody>
                @if (count($projetPrevisionnels) >= 10)
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Projet prévisionnel</th>
                        <th>Montant</th>
                        <th>Date Debut</th>
                        <th>Date Fin</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                @endif

            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="addProjetPrevisionnelModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title m-auto">AJOUT D'UN NOUVEAU PROJET PREVISIONNEL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-gradient-light">
                <div class="alert alert-warning" style="display:none"></div>
                <form id="addProjetPrevisionnel">
                    @include('projets_previsionnels._form')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Annuler</button>
                        <button type="submit" class="btn btn-primary close-modal">Enregistrer</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editProjetPrevisionnelModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title m-auto">MODIFICATION PROJET PREVISIONNEL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-gradient-light">
                <form id="updateProjetPrevisionnel">
                    <input type="hidden" name="code" id="projetPrevisionnel_id">
                    @include('projets_previsionnels._formUpdate')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Annuler</button>
                        <button type="submit" class="btn btn-primary close-modal">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal de confirmation de suppression --}}
<div class="modal fade" id="delete" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-gradient-danger">
                <img src="{{ asset('img/delete.svg') }}" width="60" height="45" class="d-inline-block align-top" alt="">
                <h5 class="modal-title m-auto"> Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-gradient-light">
                <form method="post" action="{{ route('projets-previsionnels.destroy', 'test') }}">
                    @csrf
                    @method('DELETE')

                    <div class="form-group">
                        <div class="text-center">
                            <label class="col-form-label">Êtes-vous sûr de vouloir supprimer ce projet prévisionnel
                                ?</label>
                            <input type="text" class="form-control text-center mx-auto col-8" readonly name="projetPrevisionnel" id="projetPrevisionnel" value="">
                        </div>
                        <input type="hidden" name="code" id="code" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Non, Annuler</button>
                        <button type="submit" class="btn btn-warning">Oui, Supprimer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal-->

<section class="content-header">
    <div class="container-fluid">
        <div class="row my-2">
        </div>
    </div><!-- /.container-fluid -->
</section>


@endsection
@section('scripts')
<script>
    function refresh() {
        location.reload(true);
    }
    //Initialize Select2 Elements
    $('.select2').select2();

    $('#addProjetPrevisionnel').on('submit', (function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();
        var formData = new FormData(this);
        let _url = '/projets-previsionnels/create';
        $.ajax({
            url: _url,
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

                location.reload(true);
                $('#nom').text('');
                $('#debut').text('');
                $('#fin').text('');
                $('#montant').text('');
                $('#parts').text('');
                $('#resultatAttendu').text('');
                $('#objectGeneral').text('');
                $('#program').text('');
            },
            error: function(response) {

                $('#nomError').text('');
                $('#debutError').text('');
                $('#finError').text('');
                $('#montantError').text('');
                $('#partsError').text('');
                $('#resError').text('');
                $('#programError').text('');
                $('#objError').text('');
                $('#nomError').text(response.responseJSON.errors.nom);
                $('#debutError').text(response.responseJSON.errors.debut);
                $('#finError').text(response.responseJSON.errors.fin);
                $('#montantError').text(response.responseJSON.errors.montant);
                $('#resError').text(response.responseJSON.errors.resultatAttendu);
                $('#objError').text(response.responseJSON.errors.objectGeneral);
                $('#partsError').text(response.responseJSON.errors.parts);
                $('#programError').text(response.responseJSON.errors.program_id);
            }
        });
    }));

    $('#updateProjetPrevisionnel').on('submit', (function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();
        var id = $('#projetPrevisionnel_id').val();
        var formData = new FormData(this);
        let _url = '/projets-previsionnels/' + id;
        $.ajax({
            url: _url,
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

                location.reload(true);

            },
            error: function(response) {

                $('#nomEditError').text('');
                $('#debutEditError').text('');
                $('#finEditError').text('');
                $('#montantEditError').text('');
                $('#partsEditError').text('');
                $('#resEditError').text('');
                $('#objEditError').text('');
                $('#programEditError').text('');
                $('#nomEditError').text(response.responseJSON.errors.nom);
                $('#debutEditError').text(response.responseJSON.errors.debut);
                $('#finEditError').text(response.responseJSON.errors.fin);
                $('#montantEditError').text(response.responseJSON.errors.montant);
                $('#resEditError').text(response.responseJSON.errors.resultatAttendu);
                $('#objEditError').text(response.responseJSON.errors.objectGeneral);
                $('#partsEditError').text(response.responseJSON.errors.parts);
                $('#programEditError').text(response.responseJSON.errors.program_id);
            }
        });
    }));


    $("#editProjetPrevisionnelModal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var id = button.data("id");
        var nom = button.data("nom");
        var debut = button.data("debut");
        var fin = button.data("fin");
        var montant = button.data("montant");
        var obj = button.data("obj");
        var res = button.data("res");
        var prog = button.data("prog");
        var parts = button.data("parts").toString();
        var partenaires = parts.split(',');
        $(this).find(".modal-body #projetPrevisionnel_id").val(id);
        $(this).find(".modal-body #nomEdit").val(nom);
        $(this).find(".modal-body #partsEdit").val(partenaires).trigger('change');
        $(this).find(".modal-body #programEdit").val(prog).trigger('change');
        $(this).find(".modal-body #objEdit").val(obj);
        $(this).find(".modal-body #resEdit").val(res);
        $(this).find(".modal-body #montantEdit").val(montant);
        $(this).find(".modal-body #debutEdit").val(debut);
        $(this).find(".modal-body #finEdit").val(fin);
    });

    $("#delete").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var id = button.data("rep");
        var projetPrevisionnel = button.data("info");
        $(this)
            .find(".modal-body #code")
            .val(id);
        $(this)
            .find(".modal-body #projetPrevisionnel")
            .val(projetPrevisionnel);
    });
</script>
@endsection
