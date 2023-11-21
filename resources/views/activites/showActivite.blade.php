@extends('layouts.app',['title'=>'Détails Activite'])

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

    <a href="{{ route('activites.index') }}" class="d-sm-inline-block btn btn-secondary btn-icon-split">
        <span class="icon text-white">
            <i class="fas fa-layer-group"></i>
        </span>
        <span class="text">Toutes les activités</span>
    </a>


</div>

<div class="container">
    <div class="row mx-2">
        <div class="col-md-6 ">
            <div class="project-info-box mt-0">
                <h5>{{ $activ->libelle }}</h5>
            </div>
            <div class="project-info-box">
                <p><b>Montant Prévisionnel: </b> {{ $activ->cout ?? 0}} FCFA<br><b>Montant Total Utilisé:</b> {{ getActiviteCoutTotal($activ->id) }} FCFA</p>
                {{-- <p><b>Unité physique Total Réalisé:</b> {{ getActiviteUniteTotal($activ->id) }}</p> --}}
                <p><b>Quantité Prévue:</b> {{ $activ->quantite }}<br><b>Quantité totale réalise:</b> {{ getActiviteQuantiteTotal($activ->id) }}</p>
                {{-- <p><b>Contribution bénéficiaire:</b> {{ getActiviteContribTotal($activ->id )}}</p> --}}
            </div>

        </div>
        <?php $indicas = array(); ?>
        @foreach($activ->activites as $activitie)
        @foreach($activitie->indicateurs as $indica)
        <?php
        if (isset($indicas[$indica->nom])) {
            if ($indica->type == "Quantitatif") {
                $indicas[$indica->nom] += $indica->valeur;
            } else {
                $content = $indicas[$indica->nom];
                $content[] = ucfirst($indica->valeur);
                $indicas[$indica->nom] = $content;
            }
        } else {
            if ($indica->type == "Quantitatif") {
                $indicas[$indica->nom] = $indica->valeur;
            } else {
                $indicas[$indica->nom] = array(ucfirst($indica->valeur));
            }
        }
        ?>
        @endforeach
        @endforeach
        <div class="col-md-6">
            <div class="project-info-box">
                <p><b>{{ 'Total Hommes Beneficiaires :' }}</b> {{ getActiviteHommeTotal($activ->id) ?? '' }}</p>
                <p><b>{{ 'Total Femmes Beneficiaires :' }}</b> {{ getActiviteFemmeTotal($activ->id) ?? '' }}</p>
                <p><b>{{ 'Autres Indicateurs :' }}</b><br> @foreach($indicas as $key=>$value) <b>{{ $key }}:</b> @if(is_array($value)) @foreach(array_count_values($value) as $k=>$v) {{$k}}({{$v}}) - @endforeach @else {{ $value }} @endif <br> @endforeach </p>
            </div>
            <!-- / column -->
        </div>
    </div>

    <div class=" mx-auto col-md-12 card ">
        <div class="card-header">
            <h3 class="card-title">{{ __('LISTE DES ACTIVITES EFFECTUEES') }}</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-bordered" width="100%" id="example1" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Activité</th>
                            <th>Quantité réalisée</th>
                            <th>Coût total réalisation</th>
                            <th>Paroisse</th>
                            <th>Domaine</th>
                            <th>Date réalisation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($activ->activites as $key => $activite)
                        <tr>
                            <th>{{ $key + 1 }}</th>
                            <td>{{ $activite->libelle }}</td>
                            <td>{{ $activite->quantite_realise }}</td>
                            <td>{{ $activite->cout_total_realisation }}</td>
                            <td>{{ $activite->paroisse->paroisse??'' }}</td>
                            <td>{{ $activite->domaine->domaine ??''}}</td>
                            <td>{{ \Carbon\Carbon::parse($activite->date_realisation)->translatedFormat('d M Y')  }}</td>
                            <td>
                                @cannot('manage-users')
                                @if ($activite->agent == Auth::user()->id)
                                <button class="btn btn-warning btn-circle btn-sm ml-1 my-1" data-debut="{{ $activite->date_realisation }}" data-id="{{ $activite->id }}" data-libelle="{{ $activite->libelle }}" data-unite_physique="{{ $activite->unite_physique }}" data-quantite_realise="{{ $activite->quantite_realise }}" data-observation="{{ $activite->observation }}" data-type_beneficiaire="{{ $activite->type_beneficiaire }}" data-cout_total_realisation="{{ $activite->cout_total_realisation }}" data-contrib_beneficiaire="{{ $activite->contrib_beneficiaire }}" data-bene_d_homme="{{ $activite->bene_d_homme }}" data-bene_d_femme="{{ $activite->bene_d_femme }}" data-activiteprevisionnelle="{{ $activite->activite_previsionnelle_id }}" data-paroisse="{{ $activite->paroisse_id }}" data-domaine="{{ $activite->domaine_id }}" data-partenaires="{{ $activite->partenaires }}" data-documents="{{ $activite->documents }}" data-indicateurs="{{ $activite->indicateurs }}" data-toggle="modal" data-target="#editActiviteModal" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @endif
                                @endcannot

                                @can('manage-users')
                                <button class="btn btn-warning btn-circle btn-sm ml-1 my-1" data-debut="{{ $activite->date_realisation }}" data-id="{{ $activite->id }}" data-libelle="{{ $activite->libelle }}" data-unite_physique="{{ $activite->unite_physique }}" data-quantite_realise="{{ $activite->quantite_realise }}" data-observation="{{ $activite->observation }}" data-type_beneficiaire="{{ $activite->type_beneficiaire }}" data-cout_total_realisation="{{ $activite->cout_total_realisation }}" data-contrib_beneficiaire="{{ $activite->contrib_beneficiaire }}" data-bene_d_homme="{{ $activite->bene_d_homme }}" data-bene_d_femme="{{ $activite->bene_d_femme }}" data-activiteprevisionnelle="{{ $activite->activite_previsionnelle_id }}" data-paroisse="{{ $activite->paroisse_id }}" data-domaine="{{ $activite->domaine_id }}" data-partenaires="{{ $activite->partenaires }}" data-documents="{{ $activite->documents }}" data-indicateurs="{{ $activite->indicateurs }}" data-toggle="modal" data-target="#editActiviteModal" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @endcan

                                <a href="{{ route('activites.show', $activite->id) }}">
                                    <button class="btn btn-info btn-circle btn-sm ml-1 my-1" title="Details activite">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </a>
                                @cannot('manage-users')
                                @if ($activite->agent == Auth::user()->id)
                                <button class="btn btn-danger btn-circle btn-sm ml-2 my-1" data-rep="{{ $activite->id }}" data-info="{{ $activite->libelle }}" data-toggle="modal" data-target="#delete" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                                @endcannot

                                @can('manage-users')
                                <button class="btn btn-danger btn-circle btn-sm ml-2 my-1" data-rep="{{ $activite->id }}" data-info="{{ $activite->libelle }}" data-toggle="modal" data-target="#delete" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @if (count($activ->activites) >= 10)
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Activité</th>
                            <th>Quantité réalisée</th>
                            <th>Coût total réalisation</th>
                            <th>Paroisse</th>
                            <th>Domaine</th>
                            <th>Date réalisation</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    @endif

                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editActiviteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title m-auto">MODIFICATION ACTIVITE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-gradient-light">
                    <form id="updateActivite">
                        <input type="hidden" name="code" id="activite_id">
                        @include('activites._formUpdate')

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
                    <form method="post" action="{{ route('activites.destroy', 'test') }}">
                        @csrf
                        @method('DELETE')

                        <div class="form-group">
                            <div class="text-center">
                                <label class="col-form-label">Êtes-vous sûr de vouloir supprimer cette activité ?</label>
                                <input type="text" class="form-control text-center mx-auto col-8" readonly name="activite" id="activite" value="">
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

    <!-- Fin Modal-->
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

        $('#updateActivite').on('submit', (function(e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();
            var id = $('#activite_id').val();
            var formData = new FormData(this);
            let _url = '/activites/' + id;
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
                    $('#activite_previsionnelleEditError').text('');
                    $('#paroisseEditError').text('');
                    $('#domaineEditError').text('');
                    $('#observationEditError').text('');
                    $('#type_beneficiaireEditError').text('');
                    $('#unite_physiqueEditError').text('');
                    $('#quantite_realiseEditError').text('');
                    $('#contrib_beneficiaireEditError').text('');
                    $('#cout_total_realisationEditError').text('');
                    $('#bene_d_hommeError').text('');
                    $('#bene_d_femmeEditError').text('');
                    $('#debutEditError').text('');
                    $('#debutEditError').text(response.responseJSON.errors.debut);

                    $('#activite_previsionnelleEditError').text(response.responseJSON.errors
                        .activite_previsionnelle_id);
                    $('#paroisseEditError').text(response.responseJSON.errors.paroisse_id);
                    $('#domaineEditError').text(response.responseJSON.errors.domaine_id);
                    $('#observationEditError').text(response.responseJSON.errors.observation);
                    $('#type_beneficiaireEditError').text(response.responseJSON.errors.type_beneficiaire);
                    $('#unite_physiqueEditError').text(response.responseJSON.errors.unite_physique);
                    $('#quantite_realiseEditError').text(response.responseJSON.errors
                        .quantite_realise);
                    $('#contrib_beneficiaireEditError').text(response.responseJSON.errors
                        .contrib_beneficiaire);
                    $('#cout_total_realisationEditError').text(response.responseJSON.errors
                        .cout_total_realisation);
                    $('#bene_d_hommeEditError').text(response.responseJSON.errors.bene_d_homme);
                    $('#bene_d_femmeEditError').text(response.responseJSON.errors.bene_d_femme);
                }
            });
            i = 0;
            u = 0;
            o = 0;
        }));


        $("#editActiviteModal").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget);
            $("#dynamic_fieldEdit:not(:first)").remove();
            $("#dynamic_fieldIEdit:not(:first)").remove();
            $("#dynamic_fieldDEdit:not(:first)").remove();
            var i = 0;
            var u = 0;
            var o = 0;
            var partenaires = [];
            partenaires = <?php print json_encode($partenaires) ?? null; ?>;
            var selection = button.data("partenaires");
            var docs = button.data("documents");
            var indicateurs = button.data("indicateurs");
            //console.log(selection);
            //console.log(docs);
            var selected = [];
            $.each(selection, function(key, val) {

                $('#dynamic_fieldEdit').prepend('<tr id="row' + i +
                    '" class="dynamic-added"><td ><select name="partenaireSel[]" id="sel' + i +
                    '" placeholder="Selectionner" class="form-control myselect" required><option value="">Selectionner ...</option></select></td><td><input type="number" id="montant' +
                    i + '" name="montant[]" min="0" class="form-control name_list" value="' + val.pivot
                    .montant +
                    '" required/></td><td style="width: 40%"><input class="form-control" type="text" id="description' + i +
                    '" name="description[]" value="' + val.pivot.description +
                    '"/></td><td><button type="button" id="' + i +
                    '" class="btn btn-danger btn_remove">X</button></td></tr>');
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

            $.each(indicateurs, function(key, val) {

                $('#dynamic_fieldIEdit').prepend('<tr id="rowII' + o + '" class="dynamic-added"><td><input class="form-control" type="text" id="nom' + o + '" name="nom[]" value="' + val.nom + '" /></td><td><select name="type[]" id="selI' + o + '" placeholder="Selectionner" class="form-control" required><option value="Quantitatif">Quantitatif</option><option value="Qualitatif">Qualitatif</option></select></td><td><input type="text" id="valeur' + o + '" name="valeur[]" value="' + val.valeur + '" class="form-control" required/></td><td><button type="button" id="I' + o + '" class="btn btn-danger btn_removeI">X</button></td></tr>');
                var x = document.getElementById("selI" + o);

                if (val.type == "Quantitatif") {
                    x.value = "Quantitatif";
                } else {
                    x.value = "Qualitatif";
                }
                o++;
            });

            var mod = 1;
            $.each(docs, function(key, val) {

                $('#dynamic_fieldDelete').prepend('<tr id="rowDelete' + mod +
                    '" class="dynamic-added"><td>' + val.url + ' <input type="hidden" value="' + val
                    .id + '" id="valueDelete' + mod + '"/></td><td><button id="Delete' + mod +
                    '" class="btn btn-danger btn_remov">X</button></td></tr>');
                mod++;
            });

            function addPartenaire(tab) {
                $('#dynamic_fieldEdit').prepend('<tr id="row' + i +
                    '" class="dynamic-added"><td ><select name="partenaireSel[]" id="sel' + i +
                    '" placeholder="Selectionner" class="form-control myselect" required><option value="">Selectionner ...</option></select></td><td><input type="number" id="montant' +
                    i +
                    '" name="montant[]" min="0" class="form-control name_list" value="0" required/></td><td style="width: 40%"><input type="text" id="description' +
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
                $('#dynamic_fieldIEdit').prepend('<tr id="rowII' + o + '" class="dynamic-added"><td><input class="form-control" type="text" id="nom' + o + '" name="nom[]" /></td><td><select name="type[]" id="selI' + o + '" placeholder="Selectionner" class="form-control" required><option value="Quantitatif">Quantitatif</option><option value="Qualitatif">Qualitatif</option></select></td><td><input type="text" id="valeur' + o + '" name="valeur[]" class="form-control" required/></td><td><button type="button" id="I' + o + '" class="btn btn-danger btn_removeI">X</button></td></tr>');
            }

            function addDocument() {
                $('#dynamic_fieldDEdit').prepend('<tr id="rowDD' + u +
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
                var route = '/activites/' + deleteVal + '/supprimerdocument';
                $.ajax({
                    url: route,
                    type: "DELETE",
                    data: {
                        "id": deleteVal
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
                $('#row' + button_id + '').remove();
            });

            $('#addEdit').click(function() {
                i++;
                addPartenaire(partenaires);
            });

            $('#addIEdit').click(function() {
                o++;
                addIndicateur();
            });

            $('#addDEdit').click(function() {
                u++;
                addDocument();
            });


            var id = button.data("id");
            var libelle = button.data("libelle");
            var activiteprevisionnelle = button.data("activiteprevisionnelle");
            var paroisse = button.data("paroisse");
            var domaine = button.data("domaine");
            var observation = button.data("observation");
            var type_beneficiaire = button.data("type_beneficiaire");
            var unite_physique = button.data("unite_physique");
            var quantite_realise = button.data("quantite_realise");
            var contrib_beneficiaire = button.data("contrib_beneficiaire");
            var cout_total_realisation = button.data("cout_total_realisation");
            var bene_d_femme = button.data("bene_d_femme");
            var bene_d_homme = button.data("bene_d_homme");
            var debutD = button.data("debut");
            $(this).find(".modal-body #activite_id").val(id);
            $(this).find(".modal-body #libelleEdit").val(libelle);
            $(this).find(".modal-body #activite_previsionnelleEdit").val(activiteprevisionnelle)
                .trigger('change');
            $(this).find(".modal-body #paroisseEdit").val(paroisse).trigger('change');
            $(this).find(".modal-body #domaineEdit").val(domaine).trigger('change');
            $(this).find(".modal-body #observationEdit").val(observation);
            $(this).find(".modal-body #type_beneficiaireEdit").val(type_beneficiaire);
            $(this).find(".modal-body #unite_physiqueEdit").val(unite_physique);
            $(this).find(".modal-body #quantite_realiseEdit").val(quantite_realise);
            $(this).find(".modal-body #contrib_beneficiaireEdit").val(contrib_beneficiaire);
            $(this).find(".modal-body #cout_total_realisationEdit").val(cout_total_realisation);
            $(this).find(".modal-body #bene_d_femmeEdit").val(bene_d_femme);
            $(this).find(".modal-body #bene_d_hommeEdit").val(bene_d_homme);
            $(this).find(".modal-body #debutEdit").val(debutD);
        });


        $("#delete").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget);
            var id = button.data("rep");
            var activite = button.data("info");
            $(this)
                .find(".modal-body #code")
                .val(id);
            $(this)
                .find(".modal-body #activite")
                .val(activite);
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
