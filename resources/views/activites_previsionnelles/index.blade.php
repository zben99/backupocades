@extends('layouts.app',['title'=>'Activités Prévisionnelles'])


@section('content')


<section class="content-header">
    <div class="container-fluid">
        <div class="row my-3">
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class=" mx-auto col-md-11 card shadow border-left-secondary">
    <div class="card-header">
        <h3 class="card-title">{{ __('LISTE DES ACTIVITES PREVISIONNELLES') }}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool">
                <a class="d-sm-inline-block btn btn-secondary btn-icon-split" data-toggle="modal" data-target="#addActivitePrevisionnelleModal">
                    <span class="icon text-white">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Nouvelle Activité Prévisionnelle</span>
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
                        <th>Activité prévisionnelle</th>
                        <th>Quantité</th>
                        <th>Coût</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 0; ?>
                    @cannot('manage-users')
                    @foreach ($activitePrevisionnelles as $activitePrevisionnelle)
                    @if ($activitePrevisionnelle->agent == Auth::user()->id)
                    <?php $i++; ?>
                    <tr>
                        <th>{{ $i }}</th>
                        <td>
                            <a class="btn btn-outline-info " title="cliquez pour voir les details" href="{{ route('projets-previsionnels.show', $activitePrevisionnelle->projet_previsionnel_id) }}">
                                {{ $activitePrevisionnelle->projetPrevisionnel->nom }}
                            </a>
                        </td>
                        {{-- <td>{{ $activitePrevisionnelle->commune->commune }}</td> --}}
                        <td>{{ $activitePrevisionnelle->libelle }}</td>
                        <td>{{ $activitePrevisionnelle->quantite }}</td_>
                        <td>{{ $activitePrevisionnelle->cout }}</td>
                        <td>
                            <button class="btn btn-warning btn-circle btn-sm ml-1 my-1" data-parts="{{implode(',',$activitePrevisionnelle->partenaires->pluck('id')->toArray())}}" data-unite="{{$activitePrevisionnelle->unite_physique}}" data-contrib="{{$activitePrevisionnelle->contrib_beneficiaire}}" data-domaine="{{$activitePrevisionnelle->domaine_id}}" data-region="{{$activitePrevisionnelle->region_id}}" data-nbfemme="{{$activitePrevisionnelle->bene_d_femme}}" data-nbhomme="{{$activitePrevisionnelle->bene_d_homme}}" data-date="{{$activitePrevisionnelle->date_realisation }}"  data-obs="{{$activitePrevisionnelle->observation }}" data-benef="{{$activitePrevisionnelle->type_beneficiaire}}" data-commune="{{ implode(',',$activitePrevisionnelle->communes()->pluck('commune_id')->toArray()) ?? '' }}" data-village = "{{ implode(',',$activitePrevisionnelle->villages()->pluck('village_id')->toArray()) ?? '' }}" data-paroisses="{{ implode(',',$activitePrevisionnelle->paroisses()->pluck('paroisse_id')->toArray()) ?? '' }}" data-objs="{{ getProjetPrevObj($activitePrevisionnelle->id) }}" data-id="{{ $activitePrevisionnelle->id }}" data-libelle="{{ $activitePrevisionnelle->libelle }}" data-projet="{{ $activitePrevisionnelle->projet_previsionnel_id }}" data-cout="{{ $activitePrevisionnelle->cout }}" data-quantite="{{ $activitePrevisionnelle->quantite }}" data-toggle="modal" data-target="#editActivitePrevisionnelleModal" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>

                            <a href="{{ route('activites-previsionnelles.show', $activitePrevisionnelle->id) }}">
                                <button class="btn btn-info btn-circle btn-sm ml-1 my-1" title="Voir Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </a>

                            <button class="btn btn-danger btn-circle btn-sm ml-2 my-1" data-rep="{{ $activitePrevisionnelle->id }}" data-info="{{ $activitePrevisionnelle->libelle }}" data-toggle="modal" data-target="#delete" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    @endcannot

                    @can('manage-users')
                    @foreach ($activitePrevisionnelles as $activitePrevisionnelle)
                    <?php $i++; ?>
                    <tr>
                        <th>{{ $i }}</th>
                        <td>
                            <a class="btn btn-outline-info " title="cliquez pour voir les details" href="{{ route('projets-previsionnels.show', $activitePrevisionnelle->projet_previsionnel_id) }}">
                                {{ $activitePrevisionnelle->projetPrevisionnel->nom }}
                            </a>
                        </td>
                        {{-- <td>{{ $activitePrevisionnelle->commune->commune }}</td> --}}
                        <td>{{ $activitePrevisionnelle->libelle }}</td>
                        <td>{{ $activitePrevisionnelle->quantite }}</td_>
                        <td>{{ $activitePrevisionnelle->cout }}</td>
                        <td>
                            <button class="btn btn-warning btn-circle btn-sm ml-1 my-1" data-parts="{{implode(',',$activitePrevisionnelle->partenaires->pluck('id')->toArray())}}" data-unite="{{$activitePrevisionnelle->unite_physique}}" data-contrib="{{$activitePrevisionnelle->contrib_beneficiaire}}" data-domaine="{{$activitePrevisionnelle->domaine_id}}" data-region="{{$activitePrevisionnelle->region_id}}" data-nbfemme="{{$activitePrevisionnelle->bene_d_femme}}" data-nbhomme="{{$activitePrevisionnelle->bene_d_homme}}" data-date="{{$activitePrevisionnelle->date_realisation }}"  data-obs="{{$activitePrevisionnelle->observation }}" data-benef="{{$activitePrevisionnelle->type_beneficiaire}}" data-commune="{{ implode(',',$activitePrevisionnelle->communes()->pluck('commune_id')->toArray()) ?? '' }}" data-village = "{{ implode(',',$activitePrevisionnelle->villages()->pluck('village_id')->toArray()) ?? '' }}" data-paroisses="{{ implode(',',$activitePrevisionnelle->paroisses()->pluck('paroisse_id')->toArray()) ?? '' }}" data-objs="{{ getProjetPrevObj($activitePrevisionnelle->id) }}" data-id="{{ $activitePrevisionnelle->id }}" data-libelle="{{ $activitePrevisionnelle->libelle }}" data-projet="{{ $activitePrevisionnelle->projet_previsionnel_id }}" data-cout="{{ $activitePrevisionnelle->cout }}" data-quantite="{{ $activitePrevisionnelle->quantite }}" data-toggle="modal" data-target="#editActivitePrevisionnelleModal" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>

                            <a href="{{ route('activites-previsionnelles.show', $activitePrevisionnelle->id) }}">
                                <button class="btn btn-info btn-circle btn-sm ml-1 my-1" title="Voir Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </a>

                            <button class="btn btn-danger btn-circle btn-sm ml-2 my-1" data-rep="{{ $activitePrevisionnelle->id }}" data-info="{{ $activitePrevisionnelle->libelle }}" data-toggle="modal" data-target="#delete" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    @endcan
                </tbody>
                @if (count($activitePrevisionnelles) >= 10)
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Projet</th>
                        <th>Activité prévisionnelle</th>
                        <th>Quantité</th>
                        <th>Coût</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                @endif

            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="addActivitePrevisionnelleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title m-auto">AJOUT D'UNE NOUVELLE ACTIVITE PREVISIONNELLE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-gradient-light">
                <div class="alert alert-warning" style="display:none"></div>
                <form id="addActivitePrevisionnelle">
                    @include('activites_previsionnelles._form')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Annuler</button>
                        <button type="submit" class="btn btn-primary close-modal">Enregistrer</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editActivitePrevisionnelleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title m-auto">MODIFICATION ACTIVITE PREVISIONNELLE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-gradient-light">
                <form id="updateActivitePrevisionnelle">
                    <input type="hidden" name="code" id="activitePrevisionnelle_id">
                    @include('activites_previsionnelles._formUpdate')

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
                <form method="post" action="{{ route('activites-previsionnelles.destroy', 'test') }}">
                    @csrf
                    @method('DELETE')

                    <div class="form-group">
                        <div class="text-center">
                            <label class="col-form-label">Êtes-vous sûr de vouloir supprimer cette activité
                                prévisionnelle
                                ?</label>
                            <input type="text" class="form-control text-center mx-auto col-8" readonly name="activitePrevisionnelle" id="activitePrevisionnelle" value="">
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


    $('#add').click(function() {
        i++;
        addPartenaire(partenaires);
    });

    $('#addI').click(function() {
        o++;
        addIndicateur();
    });


    $('#addActivitePrevisionnelle').on('submit', (function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();
        var formData = new FormData(this);
        let _url = '/activites-previsionnelles/create';
        $.ajax({
            url: _url,
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

                location.reload(true);
                $('#libelle').text('');
                $('#projet').text('');
                $('#commune').text('');
                $('#quantite').text('');
                $('#cout').text('');
                $('#paroisse').text('');
                $('#region').text('');
                $('#village').text('');
                $('#domaine').text('');
                $('#observation').text('');
                $('#spec').text('');
                $('#type_beneficiaire').text('');
                $('#unite_physique').text('');
                $('#contrib_beneficiaire').text('');
                $('#bene_d_homme').text('');
                $('#bene_d_femme').text('');
                $('#debut').text('');
                $("#dynamic_field:not(:first)").remove();
                $("#dynamic_fieldI:not(:first)").remove();

            },
            error: function(response) {
                //$('#libelleError').text(response.responseJSON.errors);
                $('#libelleError').text('');
                $('#projetError').text('');
                $('#communeError').text('');
                $('#quantiteError').text('');
                $('#coutError').text('');
                $('#paroisseError').text('');
                $('#domaineError').text('');
                $('#observationError').text('');
                $('#type_beneficiaireError').text('');
                $('#unite_physiqueError').text('');
                $('#contrib_beneficiaireError').text('');
                $('#bene_d_hommeError').text('');
                $('#specError').text('');
                $('#bene_d_femmeError').text('');
                $('#debutError').text('');
                $('#debutError').text(response.responseJSON.errors.debut);

                $('#libelleError').text(response.responseJSON.errors
                    .libelle);
                $('#projetError').text(response.responseJSON.errors.projet);
                $('#communeError').text(response.responseJSON.errors.commune);
                $('#coutError').text(response.responseJSON.errors.cout);
                $('#quantiteError').text(response.responseJSON.errors.quantite);
                $('#paroisseError').text(response.responseJSON.errors.paroisse_id);
                $('#domaineError').text(response.responseJSON.errors.domaine_id);
                $('#observationError').text(response.responseJSON.errors.observation);
                $('#type_beneficiaireError').text(response.responseJSON.errors.type_beneficiaire);
                $('#unite_physiqueError').text(response.responseJSON.errors.unite_physique);
                $('#contrib_beneficiaireError').text(response.responseJSON.errors
                    .contrib_beneficiaire);
                $('#bene_d_hommeError').text(response.responseJSON.errors.bene_d_homme);
                $('#bene_d_femmeError').text(response.responseJSON.errors.bene_d_femme);
                $('#partenaireError').text(response.responseJSON.data.part);
                $('#specError').text(response.responseJSON.errors.objectSpecifique);
                $('#indicateurError').text(response.responseJSON.data.indic);
            }
        });
    }));

    $("#delete").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var id = button.data("rep");
        var activitePrevisionnelle = button.data("info");
        $(this)
            .find(".modal-body #code")
            .val(id);
        $(this)
            .find(".modal-body #activitePrevisionnelle")
            .val(activitePrevisionnelle);
    });



    var p = 0;
    var ind = 0;
    //var partenaires = [];
    //partenaires = <?php print json_encode($partenaires) ?? null; ?>;
    var selected = [];

    $('#updateActivitePrevisionnelle').on('submit', (function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();
        var id = $('#activitePrevisionnelle_id').val();
        var formData = new FormData(this);
        let _url = '/activites-previsionnelles/' + id;
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
            },
            error: function(response) {

                $('#libelleEditError').text('');
                $('#projetEditError').text('');
                $('#communeEditError').text('');
                $('#quantiteEditError').text('');
                $('#coutEditError').text('');
                $('#specEditError').text('');
                $('#paroisseEditError').text('');
                $('#villageEditError').text('');
                $('#domaineEditError').text('');
                $('#observationEditError').text('');
                $('#type_beneficiaireEditError').text('');
                $('#unite_physiqueEditError').text('');
                $('#contrib_beneficiaireEditError').text('');
                $('#bene_d_hommeEditError').text('');
                $('#bene_d_femmeEditError').text('');
                //$('#libelleEditError').text(response.responseJSON)

                $('#libelleEditError').text(response.responseJSON.errors.libelle);
                $('#projetEditError').text(response.responseJSON.errors.projet);
                $('#communeEditError').text(response.responseJSON.errors.commune);
                $('#coutEditError').text(response.responseJSON.errors.cout);
                $('#quantiteEditError').text(response.responseJSON.errors.quantite);
                $('#coutError').text(response.responseJSON.errors.cout);
                $('#quantiteEditError').text(response.responseJSON.errors.quantite);
                $('#paroisseEditError').text(response.responseJSON.errors.paroisse_id);
                $('#domaineEditError').text(response.responseJSON.errors.domaine_id);
                $('#observationEditError').text(response.responseJSON.errors.observation);
                $('#type_beneficiaireEditError').text(response.responseJSON.errors.type_beneficiaire);
                $('#unite_physiqueEditError').text(response.responseJSON.errors.unite_physique);
                $('#specEditError').text(response.responseJSON.errors.objectSpecifique);
                $('#villageEditError').text(response.responseJSON.errors.village);
                $('#contrib_beneficiaireEditError').text(response.responseJSON.errors
                    .contrib_beneficiaire);
                $('#bene_d_hommeEditError').text(response.responseJSON.errors.bene_d_homme);
                $('#bene_d_femmeEditError').text(response.responseJSON.errors.bene_d_femme);
                //$('#partenaireError').text(response.responseJSON.data.part);
                //$('#indicateurError').text(response.responseJSON.data.indic);
            }
        });
        p = 0;
        ind = 0;
    }));

    $("#editActivitePrevisionnelleModal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        $("#dynamic_fieldEdit:not(:first)").remove();
        $("#dynamic_fieldIEdit:not(:first)").remove();
        var ind = 0;
        var p = 0;
        var partenaires = [];
        partenaires = <?php print json_encode($partenaires) ?? null; ?>;

        function addPartenaire(tab) {
            $('#dynamic_fieldEdit').prepend('<tr id="row' + p +
                '" class="dynamic-added"><td ><select name="partenaireSel[]" id="seledit' + p +
                '" placeholder="Selectionner" class="form-control myselect" required><option value="">Selectionner ...</option></select></td><td><input type="number" id="montant' +
                p +
                '" name="montant[]" min="0" class="form-control name_list" value="0" required/></td><td style="width: 40%"><input type="text" id="description' +
                p + '" name="description[]" /></td><td><button type="button" id="' + p +
                '" class="btn btn-danger btn_remove">X</button></td></tr>');
            $('.myselect').select2();
            var x = document.getElementById("seledit" + p);
            var c = document.createElement("option");
            $.each(tab, function(key, value) {
                var c = document.createElement("option");
                c.text = value.nom;
                c.value = value.id;
                x.options.add(c, 1);
            });
        }

        function addIndicateur() {
            $('#dynamic_fieldIEdit').prepend('<tr id="rowII' + ind + '" class="dynamic-added"><td><input class="form-control" type="text" id="nom' + ind + '" name="nom[]" /></td><td><select name="type[]" id="selI' + ind + '" placeholder="Selectionner" class="form-control" required><option value="Quantitatif">Quantitatif</option><option value="Qualitatif">Qualitatif</option></select></td><td><input type="text" id="valeur' + ind + '" name="valeur[]" class="form-control" required/></td><td><button type="button" id="I' + ind + '" class="btn btn-danger btn_removeI">X</button></td></tr>');
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
            var x = document.getElementById("seledit" + button_id);
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




        $('#addEdit').click(function() {
            i++;
            addPartenaire(partenaires);
        });

        $('#addIEdit').click(function() {
            o++;
            addIndicateur();
        });

        var button = $(event.relatedTarget);
        var id = button.data("id");
        var libelle = button.data("libelle");
        var parts = button.data("parts");
        var projet = button.data("projet");
        var commune = button.data("commune");
        var cout = button.data("cout");
        var quantite = button.data("quantite");
        var paroisse = button.data("paroisses");
        var domaine = button.data("domaine");
        var observation = button.data("obs");
        var type_beneficiaire = button.data("benef");
        var unite_physique = button.data("unite");
        var contrib_beneficiaire = button.data("contrib");
        var bene_d_homme = button.data("nbhomme");
        var region = button.data("region");
        var village = button.data("village");
        var bene_d_femme = button.data("nbfemme");
        var debut = button.data("date");
        var objs = button.data("objs").toString();
        var spec = objs.split(',');
        var paroisses = paroisse.toString().split(',');
        var communes = commune.toString().split(',');
        var villages = village.toString().split(',');

        $(this).find(".modal-body #activitePrevisionnelle_id").val(id);
        $(this).find(".modal-body #libelleEdit").val(libelle);
        $(this).find(".modal-body #quantiteEdit").val(quantite);
        $(this).find(".modal-body #coutEdit").val(cout);
        $(this).find(".modal-body #communeEdit").val(communes).trigger('change');
        $(this).find(".modal-body #projetEdit").val(projet).trigger('change');
        $(this).find(".modal-body #paroisseEdit").val(paroisses).trigger('change');
        $(this).find(".modal-body #domaineEdit").val(domaine).trigger('change');
        $(this).find(".modal-body #observationEdit").val(observation).trigger('change');
        $(this).find(".modal-body #unite_physiqueEdit").val(unite_physique).trigger('change');
        $(this).find(".modal-body #type_beneficiaireEdit").val(type_beneficiaire).trigger('change');
        $(this).find(".modal-body #contrib_beneficiaireEdit").val(contrib_beneficiaire).trigger('change');
        $(this).find(".modal-body #bene_d_hommeEdit").val(bene_d_homme);
        $(this).find(".modal-body #bene_d_femmeEdit").val(bene_d_femme);
        $(this).find(".modal-body #regionEdit").val(region).trigger('change');
        $(this).find(".modal-body #villageEdit").val(villages).trigger('change');
        $(this).find(".modal-body #debutEdit").val(debut);
        $(this).find(".modal-body #specEdit").val(spec).trigger('change');

        var url = '{{ route("activites-previsionnelles.partenaires", ":id") }}';
        url = url.replace(':id', id);

        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                if (response != null) {
                    var selected = [];
                    $.each(response, function(key, val) {

                        $('#dynamic_fieldEdit').prepend('<tr id="row' + p +
                            '" class="dynamic-added"><td ><select name="partenaireSel[]" id="seledit' + p +
                            '" placeholder="Selectionner" class="form-control myselect" required><option value="">Selectionner ...</option></select></td><td><input type="number" id="montant' +
                            p + '" name="montant[]" min="0" class="form-control name_list" value="' + val.pivot
                            .montant +
                            '" required/></td><td style="width: 40%"><input class="form-control" type="text" id="description' + p +
                            '" name="description[]" value="' + val.pivot.description +
                            '"/></td><td><button type="button" id="' + p +
                            '" class="btn btn-danger btn_remove">X</button></td></tr>');
                            $('.myselect').select2();
                            var x = document.getElementById("seledit" + p);
                            var c = document.createElement("option");
                            $.each(partenaires, function(key, value) {
                                var c = document.createElement("option");
                                c.text = value.nom;
                                c.value = value.id;
                                if (val.id == value.id) {
                                    c.selected=true;
                                }
                                x.options.add(c, 1);
                            });
                        p++;
                    });
                }
            }
        });

        var url = '{{ route("activites-previsionnelles.indicateurs", ":id") }}';
        url = url.replace(':id', id);

        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                if (response != null) {
                    var selected = [];

                $.each(response, function(key, val) {

                    $('#dynamic_fieldIEdit').prepend('<tr id="rowII' + ind + '" class="dynamic-added"><td><input class="form-control" type="text" id="nom' + ind + '" name="nom[]" value="' + val.nom + '" /></td><td><select name="type[]" id="selI' + ind + '" placeholder="Selectionner" class="form-control" required><option value="Quantitatif">Quantitatif</option><option value="Qualitatif">Qualitatif</option></select></td><td><input type="text" id="valeur' + ind + '" name="valeur[]" value="' + val.valeur + '" class="form-control" required/></td><td><button type="button" id="I' + ind + '" class="btn btn-danger btn_removeI">X</button></td></tr>');
                    var x = document.getElementById("selI" + ind);

                    if (val.type == "Quantitatif") {
                        x.value = "Quantitatif";
                    } else {
                        x.value = "Qualitatif";
                    }
                    ind++;
                });
            }
            }
        });
    });
</script>
@endsection
