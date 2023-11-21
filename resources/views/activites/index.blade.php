@extends('layouts.app',['title'=>'Activites Réalisées'])

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row my-3">
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class=" mx-auto col-md-11 card shadow border-left-secondary">
    <div class="card-header">
        <h3 class="card-title">{{ __('LISTE DES ACTIVITES') }}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool">
                <a class="d-sm-inline-block btn btn-secondary btn-icon-split" data-toggle="modal" data-target="#addActiviteModal">
                    <span class="icon text-white">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Nouvelle Activité réalisée</span>
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
                        <th>Projet</th>
                        <th>Activité</th>
                        <th>Quantité Totale</th>
                        <th>Coût Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @cannot('manage-users')
                    @foreach ($activites as $key => $activite)
                    @if($activite->agent == Auth::user()->id)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $activite->projetPrevisionnel->nom }}</td>
                        <td>{{ $activite->libelle }}</td>
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
                    @endif
                    @endforeach
                    @endcannot

                    @can('manage-users')
                    @foreach ($activites as $key => $activite)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $activite->projetPrevisionnel->nom }}</td>
                        <td>{{ $activite->libelle }}</td>
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
                    @endcan
                </tbody>
                @if (count($activites) >= 10)
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Projet</th>
                        <th>Activité</th>
                        <th>Quantité Totale</th>
                        <th>Coût Total</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                @endif

            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="addActiviteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title m-auto">AJOUT D'UNE NOUVELLE ACTIVITE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-gradient-light">
                <div class="alert alert-warning" style="display:none"></div>
                <form id="addActivite" action="{{ route('activites.store') }}" method="POST" enctype="multipart/form-data">
                    @include('activites._form')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Annuler</button>
                        <button type="submit" class="btn btn-primary close-modal">Enregistrer</button>
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
    var o = 0;
    var partenaires = [];
    partenaires = <?php print json_encode($partenaires) ?? null; ?>;
    var selected = [];

    function addPartenaire(tab) {
        $('#dynamic_field').prepend('<tr id="row' + i +
            '" class="dynamic-added"><td ><select name="partenaireSel[]" id="sel' + i +
            '" placeholder="Selectionner" class="form-control myselect" required><option value="">Selectionner ...</option></select></td><td><input type="number" id="montant' +
            i +
            '" name="montant[]" min="0" class="form-control name_list" value="0" required/></td><td style="width: 40%"><input class="form-control" type="text" id="description' +
            i + '" name="description[]" /></td><td><button type="button" id="' + i +
            '" class="btn btn-danger btn_remove">X</button></td></tr>');
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

    function addIndicateur() {
        $('#dynamic_fieldI').prepend('<tr id="rowII' + o + '" class="dynamic-added"><td><input class="form-control" type="text" id="nom' + o + '" name="nom[]" /></td><td><select name="type[]" id="selI' + o + '" placeholder="Selectionner" class="form-control" required><option value="Quantitatif">Quantitatif</option><option value="Qualitatif">Qualitatif</option></select></td><td><input type="text" id="valeur' + o + '" name="valeur[]" class="form-control" required/></td><td><button type="button" id="I' + o + '" class="btn btn-danger btn_removeI">X</button></td></tr>');
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

    $(document).on('click', '.btn_removeI', function() {
        var button_id = $(this).attr("id");
        $('#rowI' + button_id + '').remove();
    });

    $(document).on('click', '.btn_removeD', function() {
        var button_id = $(this).attr("id");
        $('#rowD' + button_id + '').remove();
    });

    $('#add').click(function() {
        i++;
        addPartenaire(partenaires);
    });

    $('#addI').click(function() {
        o++;
        addIndicateur();
    });

    $('#addD').click(function() {
        u++;
        addDocument();
    });

    $('#addActivite').on('submit', (function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();

        var formData = new FormData(this);

        let _url = '/activites/create';
        $.ajax({
            url: _url,
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            enctype: "multipart/form-data",
            success: function(data) {

                location.reload(true);
                $('#libelle').text('');
                $('#debut').text('');
                $('#activite_previsionnelle').text('');
                $('#paroisse').text('');
                $('#domaine').text('');
                $('#observation').text('');
                $('#type_beneficiaire').text('');
                $('#unite_physique').text('');
                $('#quantite_realise').text('');
                $('#contrib_beneficiaire').text('');
                $('#cout_total_realisation').text('');
                $('#bene_d_homme').text('');
                $('#bene_d_femme').text('');

                $("#dynamic_field:not(:first)").remove();
                $("#dynamic_fieldD:not(:first)").remove();
                $("#dynamic_fieldI:not(:first)").remove();

            },
            error: function(response) {
                //console.log(response);
                $('#libelleError').text('');
                $('#activiteprevisionnelleError').text('');
                $('#paroisseError').text('');
                $('#domaineError').text('');
                $('#observationError').text('');
                $('#type_beneficiaireError').text('');
                $('#unite_physiqueError').text('');
                $('#quantite_realiseError').text('');
                $('#contrib_beneficiaireError').text('');
                $('#cout_total_realisationError').text('');
                $('#bene_d_hommeError').text('');
                $('#bene_d_femmeError').text('');
                $('#debutError').text('');
                $('#debutError').text(response.responseJSON.errors.debut);

                //console.log(response);
                $('#activiteprevisionnelleError').text(response.responseJSON.errors
                    .activite_previsionnelle_id);
                $('#paroisseError').text(response.responseJSON.errors.paroisse_id);
                $('#domaineError').text(response.responseJSON.errors.domaine_id);
                $('#observationError').text(response.responseJSON.errors.observation);
                $('#type_beneficiaireError').text(response.responseJSON.errors.type_beneficiaire);
                $('#unite_physiqueError').text(response.responseJSON.errors.unite_physique);
                $('#quantite_realiseError').text(response.responseJSON.errors.quantite_realise);
                $('#contrib_beneficiaireError').text(response.responseJSON.errors
                    .contrib_beneficiaire);
                $('#cout_total_realisationError').text(response.responseJSON.errors
                    .cout_total_realisation);
                $('#bene_d_hommeError').text(response.responseJSON.errors.bene_d_homme);
                $('#bene_d_femmeError').text(response.responseJSON.errors.bene_d_femme);
                $('#partenaireError').text(response.responseJSON.data.part);
                $('#indicateurError').text(response.responseJSON.data.indic);
                $('#documentError').text(response.responseJSON.data.doc);

            }
        });
        i = 0;
        u = 0;
        o = 0;
    }));

    $('#activite_previsionnelle').change(function() {
        var id = $(this).val();
        var url = '{{ route("activitePrev.details", ":id") }}';
        url = url.replace(':id', id);
        $('#quantite').val("");
        $('#cout').val("");
        $("#projet").val("");
        $("#spec").val("");

        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                if (response != null) {
                    var objectifs = '';
                    var i = 0;
                    response.objectif_specifiques.forEach(element => {
                        objectifs = objectifs +" "+element.nom;
                        i++;
                        if (i < response.objectif_specifiques.length) {
                            objectifs = objectifs +", ";
                        }
                    });
                    $('#quantite').val(response.quantite);
                    $('#cout').val(response.cout);
                    $("#projet1").val(response.projet_previsionnel.nom);
                    $("#spec").val(objectifs);
                }
            }
        });
    });

    $('#activite_previsionnelleEdit').change(function() {
        var id = $(this).val();
        var url = '{{ route("activitePrev.details", ":id") }}';
        url = url.replace(':id', id);
        $('#quantiteEdit').val("");
        $('#coutEdit').val("");
        $("#projetEdit").val("");
        $("#specEdit").val("");

        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                if (response != null) {
                    var objectifs = '';
                    var i = 0;
                    response.objectif_specifiques.forEach(element => {
                        objectifs = objectifs +" "+element.nom;
                        i++;
                        if (i < response.objectif_specifiques.length) {
                            objectifs = objectifs +", ";
                        }
                    });
                    $('#quantiteEdit').val(response.quantite);
                    $('#coutEdit').val(response.cout);
                    $("#projetEdit").val(response.projet_previsionnel.nom);
                    $("#specEdit").val(objectifs);
                }
            }
        });
    });
</script>
@endsection
