@extends('layouts.app',['title'=>'Projets'])


@section('content')


<section class="content-header">
    <div class="container-fluid">
        <div class="row my-3">
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class=" mx-auto col-md-11 card shadow border-left-secondary">
    <div class="card-header">
        <h3 class="card-title">{{ __('LISTE DES PROJETS') }}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool">
                <a class="d-sm-inline-block btn btn-secondary btn-icon-split" data-toggle="modal" data-target="#addProjetModal">
                    <span class="icon text-white">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Nouveau Projet</span>
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
                        <th>Secteur</th>
                        <th>Projet</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 0; ?>
                    @cannot('manage-users')
                    @foreach ($projets as $projet)
                    @if ($projet->agent == Auth::user()->id)
                    <?php $i++; ?>
                    <tr>
                        <th>{{ $i }}</th>
                        <td>@foreach ($projet->secteurs as $secteur) {{ $secteur->nom }} @endforeach</td>
                        <td>{{ $projet->libelle }}</td>
                        <td>

                            <button class="btn btn-warning btn-circle btn-sm ml-1 my-1" data-id="{{ $projet->id }}" data-desc="{{ $projet->description }}" data-libelle="{{ $projet->libelle }}" data-secteurs="{{ $projet->secteurs }}" data-budget="{{ $projet->budget }}" data-montantcharge="{{ $projet->montantCharge }}" data-montantequipement="{{ $projet->montantEquipement }}" data-totalressfinanciere="{{ $projet->totalRessFinanciere }}" data-chefprojet="{{ $projet->chefProjet }}" data-debut="{{ $projet->debut->format('Y-m-d') }}" data-fin="{{ $projet->fin->format('Y-m-d') }}" data-depensebeneficiaire="{{ $projet->depenseBeneficiaire }}" data-projetprevisionnel="{{ $projet->projetprevisionnel_id }}" data-montanttotaldepense="{{ $projet->montantTotalDepense }}" data-partenaires="{{ $projet->partenaires }}" data-documents="{{ $projet->documents }}" data-toggle="modal" data-target="#editProjetModal" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="{{ route('projets.show', $projet->id) }}">
                                <button class="btn btn-info btn-circle btn-sm ml-1 my-1" title="Details projet">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </a>
                            <button class="btn btn-danger btn-circle btn-sm ml-2 my-1" data-rep="{{ $projet->id }}" data-info="{{ $projet->libelle }}" data-toggle="modal" data-target="#delete" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>

                        </td>
                    </tr>
                    @endif
                    @endforeach
                    @endcannot

                    @can('manage-users')
                    @foreach ($projets as $projet)
                    <?php $i++; ?>
                    <tr>
                        <th>{{ $i }}</th>
                        <td>@foreach ($projet->secteurs as $secteur) {{ $secteur->nom }} @endforeach</td>
                        <td>{{ $projet->libelle }}</td>
                        <td>
                            <button class="btn btn-warning btn-circle btn-sm ml-1 my-1" data-id="{{ $projet->id }}" data-desc="{{ $projet->description }}" data-libelle="{{ $projet->libelle }}" data-secteurs="{{ $projet->secteurs }}" data-budget="{{ $projet->budget }}" data-montantcharge="{{ $projet->montantCharge }}" data-montantequipement="{{ $projet->montantEquipement }}" data-totalressfinanciere="{{ $projet->totalRessFinanciere }}" data-chefprojet="{{ $projet->chefProjet }}" data-debut="{{ $projet->debut->format('Y-m-d') }}" data-fin="{{ $projet->fin->format('Y-m-d') }}" data-depensebeneficiaire="{{ $projet->depenseBeneficiaire }}" data-projetprevisionnel="{{ $projet->projetprevisionnel_id }}" data-montanttotaldepense="{{ $projet->montantTotalDepense }}" data-partenaires="{{ $projet->partenaires }}" data-documents="{{ $projet->documents }}" data-toggle="modal" data-target="#editProjetModal" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="{{ route('projets.show', $projet->id) }}">
                                <button class="btn btn-info btn-circle btn-sm ml-1 my-1" title="Details projet">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </a>
                            <button class="btn btn-danger btn-circle btn-sm ml-2 my-1" data-rep="{{ $projet->id }}" data-info="{{ $projet->libelle }}" data-toggle="modal" data-target="#delete" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>

                        </td>
                    </tr>
                    @endforeach
                    @endcan
                </tbody>
                @if (count($projets) >= 10)
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Secteur</th>
                        <th>Projet</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                @endif

            </table>
        </div>
    </div>
</div>


{{-- Modal Ajouter un nouveau role --}}
<div class="modal fade" id="addProjetModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title m-auto">AJOUT D'UN NOUVEAU PROJET</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-gradient-light">
                <div class="alert alert-warning" style="display:none"></div>
                <form id="addProjet">
                    @include('projets._form')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Annuler</button>
                        <button type="submit" class="btn btn-primary close-modal">Enregistrer</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editProjetModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title m-auto">MODIFICATION PROJET</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-gradient-light">
                <form id="updateProjet">
                    <input type="hidden" name="code" id="projet_id">
                    @include('projets._formUpdate')

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
                <form method="post" action="{{ route('projets.destroy', 'test') }}">
                    @csrf
                    @method('DELETE')

                    <div class="form-group">
                        <div class="text-center">
                            <label class="col-form-label">Êtes-vous sûr de vouloir supprimer ce projet ?</label>
                            <input type="text" class="form-control text-center mx-auto col-8" readonly name="projet" id="projet" value="">
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

    var i = 0;
    var u = 0;
    var partenaires = [];
    partenaires = <?php print json_encode($partenaires) ?? null; ?>;
    var selected = [];

    function addPartenaire(tab) {
        $('#dynamic_field').prepend('<tr id="row' + i +
            '" class="dynamic-added"><td ><select name="partenaireSel[]" id="sel' + i +
            '" placeholder="Selectionner" class="form-control myselect" required><option value="">Selectionner ...</option></select></td><td><input type="number" name="montant[]" min="0" class="form-control name_list" value="0" required/></td><td><input type="text"  name="descriptions[]" /></td><td><button type="button" id="' +
            i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
        $('.myselect').select2();
        var x = document.getElementById("sel" + i);
        var c = document.createElement("option");
        $.each(tab, function(key, value) {
            var c = document.createElement("option");
            c.text = value.nom;
            c.value = value.id;
            x.options.add(c, 1);
        });
    }

    function addDocument() {
        $('#dynamic_fieldD').prepend('<tr id="rowDD' + u +
            '" class="dynamic-added"><td><input type="file" name="documents[]"/></td><td><button type="button" id="D' +
            u + '" class="btn btn-danger btn_removeD">X</button></td></tr>');
    }

    $(document).on('change', '.myselect', function() {
        var id = $(this).attr("id");
        var x = document.getElementById(id).value;
        var parte = partenaires.find(a => a.id == x);
        let keys;
        $.each(partenaires, function(key, value) {
            if (parte.id == value.id) {
                keys = key;
            }
        });
        selected.push(parte);
        partenaires.splice(keys, 1);

    });

    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        var x = document.getElementById("sel" + button_id);
        $.each(selected, function(key, value) {
            if (value && value.id == x.value) {
                partenaires.push(value);
                selected.splice(key, 1);
            }
        });
        $('#row' + button_id + '').remove();
    });

    $(document).on('click', '.btn_removeD', function() {
        var button_id = $(this).attr("id");
        $('#rowD' + button_id + '').remove();
    });

    $('#add').click(function() {
        i++;
        addPartenaire(partenaires);
    });

    $('#addD').click(function() {
        u++;
        addDocument();
    });

    $('#addProjet').on('submit', (function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();
        var formData = new FormData(this);
        let _url = '/projets/create';
        $.ajax({
            url: _url,
            type: "POST",
            data: formData,
            enctype: "multipart/form-data",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

                location.reload(true);

                $('#libelleError').text('');
                $('#secteurError').text('');
                $('#descError').text('');
                $('#budgetError').text('');
                $('#montantChargeError').text('');
                $('#montantEquipementError').text('');
                $('#totalRessFinanciereError').text('');
                $('#chefProjetError').text('');
                $('#montantChargeError').text('');
                $('#debutError').text('');
                $('#finError').text('');
                $('#depenseBeneficiaireError').text('');
                $('#montantTotalDepenseError').text('');
                $('#projet_previsionnel_idError').text('');

                $("#dynamic_field:not(:first)").remove();
                $("#dynamic_fieldD:not(:first)").remove();

            },
            error: function(response) {

                $('#libelleError').text('');
                $('#secteurError').text('');
                $('#descError').text('');
                $('#budgetError').text('');
                $('#montantChargeError').text('');
                $('#montantEquipementError').text('');
                $('#totalRessFinanciereError').text('');
                $('#chefProjetError').text('');
                $('#debutError').text('');
                $('#finError').text('');
                $('#depenseBeneficiaireError').text('');
                $('#montantTotalDepenseError').text('');
                $('#projet_previsionnel_idError').text('');
                $('#libelleError').text(response.responseJSON.errors.libelle);
                $('#secteurError').text(response.responseJSON.errors.secteur);
                $('#descError').text(response.responseJSON.errors.description);
                $('#budgetError').text(response.responseJSON.errors.budget);
                $('#montantChargeError').text(response.responseJSON.errors.montantCharge);
                $('#montantEquipementError').text(response.responseJSON.errors
                    .montantEquipement);
                $('#totalRessFinanciereError').text(response.responseJSON.errors
                    .totalRessFinanciere);
                $('#chefProjetError').text(response.responseJSON.errors.chefProjet);
                $('#debutError').text(response.responseJSON.errors.debut);
                $('#finError').text(response.responseJSON.errors.fin);
                $('#depenseBeneficiaireError').text(response.responseJSON.errors
                    .depenseBeneficiaire);
                $('#montantTotalDepenseError').text(response.responseJSON.errors
                    .montantTotalDepense);
                $('#projet_previsionnel_idError').text(response.responseJSON.errors
                    .projet_previsionnel_id);
            }
        });
    }));

    $('#updateProjet').on('submit', (function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();

        var id = $('#projet_id').val();
        var formData = new FormData(this);
        let _url = '/projets/' + id;
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

                $('#libelleEditError').text('');
                $('#secteurEditError').text('');
                $('#descEditError').text('');
                $('#budgetEditError').text('');
                $('#montantChargeEditError').text('');
                $('#montantEquipementEditError').text('');
                $('#totalRessFinanciereEditError').text('');
                $('#chefProjetEditError').text('');
                $('#debutEditError').text('');
                $('#finEditError').text('');
                $('#depenseBeneficiaireEditError').text('');
                $('#montantTotalDepenseEditError').text('');
                $('#projet_previsionnel_idEditError').text('');
                $('#libelleEditError').text(response.responseJSON.errors.libelle);
                $('#secteurEditError').text(response.responseJSON.errors.secteur);
                $('#descEditError').text(response.responseJSON.errors.description);
                $('#budgetEditError').text(response.responseJSON.errors.budget);
                $('#montantChargeEditError').text(response.responseJSON.errors.montantCharge);
                $('#montantEquipementEditError').text(response.responseJSON.errors
                    .montantEquipement);
                $('#totalRessFinanciereEditError').text(response.responseJSON.errors
                    .totalRessFinanciere);
                $('#chefProjetEditError').text(response.responseJSON.errors.chefProjet);
                $('#debutEditError').text(response.responseJSON.errors.debut);
                $('#finEditError').text(response.responseJSON.errors.fin);
                $('#depenseBeneficiaireEditError').text(response.responseJSON.errors
                    .depenseBeneficiaire);
                $('#montantTotalDepenseEditError').text(response.responseJSON.errors
                    .montantTotalDepense);
                $('#projet_previsionnel_idEditError').text(response.responseJSON.errors
                    .projet_previsionnel_id);
            }
        });
    }));


    $("#editProjetModal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var i = 0;
        var u = 0;
        var partenaires = [];
        partenaires = <?php print json_encode($partenaires) ?? null; ?>;
        var selection = button.data("partenaires");
        var docs = button.data("documents");
        var selected = [];
        $.each(selection, function(key, val) {

            $('#dynamic_fieldEdit').prepend('<tr id="row' + i + '" class="dynamic-added"><td ><select name="partenaireSel[]" id="sel' + i + '" placeholder="Selectionner" class="form-control myselect" required><option value="">Selectionner ...</option></select></td><td><input type="number" id="montant' + i + '" name="montant[]" min="0" class="form-control name_list" value="' + val.pivot
                .montant + '" required/></td><td style="width: 40%"><input type="text" id="description' + i + '" name="descriptions[]" value="' + val.pivot.description + '"/></td><td><button type="button" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
            $('.myselect').select2();
            var x = document.getElementById("sel" + i);
            var c = document.createElement("option");
            $.each(partenaires, function(key, value) {
                var c = document.createElement("option");
                c.text = value.nom;
                c.value = value.id;
                x.options.add(c, 1);
                if (val.id == value.id) {
                    x.value = val.id;
                }
            });
            i++
        });

        var mod = 1;
        $.each(docs, function(key, val) {
            $('#dynamic_fieldDelete').prepend('<tr id="rowDelete' + mod + '" class="dynamic-added"><td>' + val.url + ' <input type="hidden" value="' + val.id + '" id="valueDelete' + mod + '"/></td><td><button id="Delete' + mod + '" class="btn btn-danger btn_remov">X</button></td></tr>');
            mod++;
        });


        function addPartenaire(tab) {
            $('#dynamic_fieldEdit').prepend('<tr id="row' + i + '" class="dynamic-added"><td ><select name="partenaireSel[]" id="sel' + i + '" placeholder="Selectionner" class="form-control myselect" required><option value="">Selectionner ...</option></select></td><td><input type="number" id="montant' + i + '" name="montant[]" min="0" class="form-control name_list" value="0" required/></td><td style="width: 40%"><input type="text" id="description' + i + '" name="descriptions[]" /></td><td><button type="button" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');

            $('.myselect').select2();
            var x = document.getElementById("sel" + i);
            var c = document.createElement("option");
            $.each(tab, function(key, value) {
                var c = document.createElement("option");
                c.text = value.nom;
                c.value = value.id;
                x.options.add(c, 1);
            });
        }

        function addDocument() {
            $('#dynamic_fieldDEdit').prepend('<tr id="rowDD' + u + '" class="dynamic-added"><td><input type="file" name="documents[]"/></td><td><button type="button" id="D' + u + '" class="btn btn-danger btn_removeD">X</button></td></tr>');
        }

        $(document).on('change', '.myselect', function() {
            var id = $(this).attr("id");
            var x = document.getElementById(id).value;
            var parte = partenaires.find(a => a.id == x);
            let keys;
            $.each(partenaires, function(key, value) {
                if (parte.id == value.id) {
                    keys = key;
                }
            });
            selected.push(parte);
            partenaires.splice(keys, 1);

        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            var x = document.getElementById("sel" + button_id);
            $.each(selected, function(key, value) {
                if (value && value.id == x.value) {
                    partenaires.push(value);
                    selected.splice(key, 1);
                }
            });
            $('#row' + button_id + '').remove();
        });

        $(document).on('click', '.btn_removeD', function() {
            var button_id = $(this).attr("id");
            $('#rowD' + button_id + '').remove();
        });

        $(document).on('click', '.btn_remov', function(e) {
            e.preventDefault();
            var button_id = $(this).attr("id");
            var deleteVal = document.getElementById('value' + button_id).value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var formData = deleteVal;
            var route = '/projets/' + deleteVal + '/supprimerdocument';
            $.ajax({
                url: route,
                type: "DELETE",
                data: {
                    "id": deleteVal
                },
                dataType: "JSON",
                success: function(response) {},
                error: function(response) {}
            });


            $('#row' + button_id + '').remove();
        });

        $('#addEdit').click(function() {
            i++;
            addPartenaire(partenaires);
        });

        $('#addDEdit').click(function() {
            u++;
            addDocument();
        });

        var id = button.data("id");
        var libelle = button.data("libelle");
        var secteurs = button.data("secteurs");
        var desc = button.data("desc");
        var budget = button.data("budget");
        var montantcharge = button.data("montantcharge");
        var montantequipement = button.data("montantequipement");
        var totalRessFinanciere = button.data("totalressfinanciere");
        var chefprojet = button.data("chefprojet");
        var debut = button.data("debut");
        var fin = button.data("fin");

        sects = [];
        $.each(secteurs, function(key, secteur) {
            sects.push(secteur.id);
        });
        var depenseBeneficiaire = button.data("depensebeneficiaire");
        var montantTotalDepense = button.data("montanttotaldepense");
        var projetprevisionnel = button.data("projetprevisionnel");

        $(this).find(".modal-body #projet_id").val(id);
        $(this).find(".modal-body #libelleEdit").val(libelle);
        $(this).find(".modal-body #descEdit").val(desc);
        $(this).find(".modal-body #montantChargeEdit").val(montantcharge);
        $(this).find(".modal-body #montantEquipementEdit").val(montantequipement);
        $(this).find(".modal-body #totalRessFinanciereEdit").val(totalRessFinanciere);
        $(this).find(".modal-body #chefProjetEdit").val(chefprojet);
        //document.getElementById('chefProjetEdit').value = chefprojet;
        $(this).find(".modal-body #debutEdit").val(debut);
        $(this).find(".modal-body #finEdit").val(fin);
        $(this).find(".modal-body #budgetEdit").val(budget);
        $(this).find(".modal-body #depenseBeneficiaireEdit").val(depenseBeneficiaire);
        $(this).find(".modal-body #montantTotalDepenseEdit").val(montantTotalDepense);
        $(this).find(".modal-body #projet_previsionnel_idEdit").val(projetprevisionnel).trigger('change');
        $(this).find(".modal-body #secteurEdit").val(sects).trigger('change');

    });

    $("#delete").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var id = button.data("rep");
        var projet = button.data("info");
        $(this)
            .find(".modal-body #code")
            .val(id);
        $(this)
            .find(".modal-body #projet")
            .val(projet);
    });

    $('#projet_previsionnel_id').change(function() {
        var id = $(this).val();
        var url = '{{ route("projetPrev.details", ":id") }}';
        url = url.replace(':id', id);
        $('#rev').val("");
        $('#title').val("");
        $("#obj").val("");
        $("#res").val("");
        $("#montant").val("");
        $("#debut").val("");
        $("#fin").val("");

        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                if (response != null) {

                    $('#rev').val(response.rev_no);
                    $('#title').val(response.title);
                    $("#obj").val(response.objectGeneral);
                    $("#res").val(response.resultatAttendu);
                    $("#montant").val(response.montant);
                    $("#debut").val(response.debut);
                    $("#fin").val(response.fin);
                }
            }
        });
    });

    $('#projet_previsionnel_idEdit').change(function() {
        var id = $(this).val();
        var url = '{{ route("projetPrev.details", ":id") }}';
        url = url.replace(':id', id);
        $('#revEdit').val("");
        $('#titleEdit').val("");
        $("#objEdit").val("");
        $("#specEdit").val("");
        $("#resEdit").val("");
        $("#montantEdit").val("");
        $("#debutEdit").val("");
        $("#finEdit").val("");

        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                if (response != null) {
                    $('#revEdit').val(response.rev_no);
                    $('#titleEdit').val(response.title);
                    $("#objEdit").val(response.objectGeneral);
                    $("#specEdit").val(response.objectSpecifique);
                    $("#resEdit").val(response.resultatAttendu);
                    $("#montantEdit").val(response.montant);
                    $("#debutEdit").val(response.debut);
                    $("#finEdit").val(response.fin);
                }
            }
        });
    });

    $('#montantCharge').change(function() {
        var charge = parseFloat( $(this).val());
        var equipement = parseFloat( $('#montantEquipement').val());
        var beneficiaire = parseFloat( $('#depenseBeneficiaire').val());
        total = charge + equipement + beneficiaire;
        $('#montantTotalDepense').val(total);
    });

    $('#montantEquipement').change(function() {
        var charge = parseFloat( $('#montantCharge').val());
        var equipement = parseFloat( $(this).val());
        var beneficiaire = parseFloat( $('#depenseBeneficiaire').val());
        total = charge + equipement + beneficiaire;
        $('#montantTotalDepense').val(total);
    });

    $('#depenseBeneficiaire').change(function() {
        var charge = parseFloat( $('#montantCharge').val());
        var equipement = parseFloat( $('#montantEquipement').val());
        var beneficiaire = parseFloat( $(this).val());
        total = charge + equipement + beneficiaire;
        $('#montantTotalDepense').val(total);
    });

    $('#montantChargeEdit').change(function() {
        var charge = parseFloat( $(this).val());
        var equipement = parseFloat( $('#montantEquipementEdit').val());
        var beneficiaire = parseFloat( $('#depenseBeneficiaireEdit').val());
        total = charge + equipement + beneficiaire;
        $('#montantTotalDepenseEdit').val(total);
    });

    $('#montantEquipementEdit').change(function() {
        var charge = parseFloat( $('#montantChargeEdit').val());
        var equipement = parseFloat($(this).val());
        var beneficiaire = parseFloat($('#depenseBeneficiaireEdit').val());
        total = charge + equipement + beneficiaire;
        $('#montantTotalDepenseEdit').val(total);
    });

    $('#depenseBeneficiaireEdit').change(function() {
        var charge = parseFloat( $('#montantChargeEdit').val());
        var equipement = parseFloat( $('#montantEquipementEdit').val());
        var beneficiaire = parseFloat( $(this).val());
        total = charge + equipement + beneficiaire;
        $('#montantTotalDepenseEdit').val(total);
    });
</script>
@endsection
