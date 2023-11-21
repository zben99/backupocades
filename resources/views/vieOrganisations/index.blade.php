<?php

use Illuminate\Support\Facades\Auth;
?>
@extends('layouts.app',['title'=>'Documents'])


@section('content')


<section class="content-header">
    <div class="container-fluid">
        <div class="row my-3">
        </div>
    </div><!-- /.container-fluid -->
</section>


<div class=" mx-auto col-md-11 card shadow border-left-secondary">
    <div class="card-header">
        <h3 class="card-title">{{ __('LISTE DES DOCUMENTS') }}</h3>
        <div class="card-tools">

            <button type="button" class="btn btn-tool">
                <a class="d-sm-inline-block btn btn-secondary btn-icon-split" data-toggle="modal" data-target="#addDocumentModal">
                    <span class="icon text-white">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Nouveau document</span>
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
                        <th>Type Document</th>
                        <th>Titre</th>
                        <th>Résumé</th>
                        <th>Créer par</th>
                        <th>Publier le</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($documents as $document)
                    <tr>
                        <td>{{ $document->type->libelle }}</td>
                        <td>{{ $document->nom }}</td>
                        <td>{{ $document->nb_pages }}</td>
                        <td>{{ $document->auteur }}</td>
                        <td>{{\Carbon\Carbon::parse($document->date_publication)->translatedFormat('d M Y')}}</td>
                        <td>
                            @cannot('manage-users')
                            @if(Auth::user()->id==$document->agent)
                                <button title="Joindre des fichiers" type="button" data-doc="{{ $document->id }}" data-toggle="modal" data-target="#filesModal" class="btn btn-success btn-circle btn-sm ml-1 my-1">
                                    <i class="fas fa-download"></i>
                                </button>

                                <button class="btn btn-warning btn-circle btn-sm ml-1 my-1" data-id="{{ $document->id }}" data-auteur="{{ $document->auteur }}"  data-resume="{{ $document->resume }}" data-date="{{ $document->date_publication }}" data-titre="{{ $document->nom }}" data-type="{{ $document->type_document_id }}" data-nb="{{ $document->nb_pages }}" data-logo="{{ $document->logo }}" data-toggle="modal" data-target="#editDocumentModal" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-circle btn-sm ml-2 my-1" data-rep="{{ $document->id }}" data-info="{{ $document->nom }}" data-toggle="modal" data-target="#delete" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endif
                            @endcannot


                            @can('manage-users')
                                <button title="Joindre des fichiers" type="button" data-doc="{{ $document->id }}" data-toggle="modal" data-target="#filesModal" class="btn btn-success btn-circle btn-sm ml-1 my-1">
                                    <i class="fas fa-download"></i>
                                </button>

                                <button class="btn btn-warning btn-circle btn-sm ml-1 my-1" data-id="{{ $document->id }}" data-auteur="{{ $document->auteur }}"  data-resume="{{ $document->resume }}" data-date="{{ $document->date_publication }}" data-titre="{{ $document->nom }}" data-type="{{ $document->type_document_id }}" data-nb="{{ $document->nb_pages }}" data-logo="{{ $document->logo }}" data-toggle="modal" data-target="#editDocumentModal" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-circle btn-sm ml-2 my-1" data-rep="{{ $document->id }}" data-info="{{ $document->nom }}" data-toggle="modal" data-target="#delete" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endcan

                            <a href="{{ route('documents.show', $document->id) }}">
                                <button class="btn btn-info btn-circle btn-sm ml-1 my-1" title="Détails Document">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </a>


                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="addDocumentModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title m-auto">AJOUT D'UN NOUVEAU DOCUMENT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-gradient-light">
                <div class="alert alert-warning" style="display:none"></div>
                <form id="addDocument" enctype="multipart/form-data">
                    @include('vieOrganisations._form')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Fermer</button>
                        <button type="submit" class="btn btn-primary close-modal">Enregistrer</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editDocumentModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title m-auto">MODIFICATION DOCUMENT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-gradient-light">
                <form id="updateDocument" enctype="multipart/form-data">
                    <input type="hidden" name="code" id="document_id">
                    @include('vieOrganisations._formUpdate')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Fermer</button>
                        <button type="submit" class="btn btn-primary close-modal">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
                <form method="post" action="{{ route('documents.destroy', 'test') }}">
                    @csrf
                    @method('DELETE')

                    <div class="form-group">
                        <div class="text-center">
                            <label class="col-form-label">Etes vous sûr de vouloir supprimer ce document ?</label>
                            <input type="text" class="form-control text-center mx-auto col-8" readonly id="name" value="">
                        </div>
                        <input type="hidden" name="code" id="code" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Non, Annuler</button>
                        <button type="submit" class="btn btn-primary">Oui, Supprimer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal-->

<div class="modal fade" id="filesModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bgcustom-gradient-light">
            <div class="modal-header">
                <img src="{{ asset('img/files.svg') }}" width="60" height="45" class="d-inline-block align-top" alt="">
                <h5 class="modal-title m-auto"> Joindre des fichiers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('vieOrganisations._fichiers')
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

    $('#filesModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('doc');
        $(this).find('.modal-body #code_doc').val(id);
    });

    $('#addDocument').on('submit', (function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();
        var formData = new FormData(this);
        let _url = '/documents/create';
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
                $('#type_document_id').text('');
                $('#auteur').text('');
                //$('#date_publication').text('');
                $('#nb').text('');
                $('#resume').text('');
                $('#logo').text("");

            },
            error: function(response) {

                $('#nomError').text('');
                $('#typeError').text('');
                $('#auteurError').text('');
                $('#date_editionError').text('');
                $('#nbError').text('');
                $('#resumeError').text('');
                $('#nomError').text(response.responseJSON.errors.nom);
                $('#typeError').text(response.responseJSON.errors.type_document_id);
                $('#auteurError').text(response.responseJSON.errors.auteur);
                $('#resumeError').text(response.responseJSON.errors.resume);
                $('#nbError').text(response.responseJSON.errors.nb);
                //$('#date_editionError').text(response.responseJSON.errors.date_publication);
                $('#logoError').text(response.responseJSON.errors.logo);
            }
        });
    }));

    $('#updateDocument').on('submit', (function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();
        var id = $('#document_id').val();
        var formData = new FormData(this);
        let _url = '/documents/' + id;
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
                $('#typeEditError').text('');
                $('#auteurEditError').text('');
                $('#date_editionEditError').text('');
                $('#nbEditError').text('');
                $('#resumeEditError').text('');
                $('#logoEditError').text('');
                $('#nomEditError').text(response.responseJSON.errors.nom);
                $('#typeEditError').text(response.responseJSON.errors.type_document_id);
                $('#auteurEditError').text(response.responseJSON.errors.auteur);
                $('#nbEditError').text(response.responseJSON.errors.nb);
                $('#resumeEditError').text(response.responseJSON.errors.resume);
                $('#logoEditError').text(response.responseJSON.errors.logo);
                //$('#date_editionEditError').text(response.responseJSON.errors.date_publication);
            }
        });
    }));


    $("#editDocumentModal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var id = button.data("id");
        var titre = button.data("titre");
        var nb = button.data("nb");
        var type = button.data("type");
        //var date = button.data("date");
        var auteur = button.data("auteur");
        var resume = button.data("resume");
        var logo = button.data("logo");

        $(this).find(".modal-body #document_id").val(id);
        $(this).find(".modal-body #nomEdit").val(titre);
        $(this).find(".modal-body #nbEdit").val(nb);
        $(this).find(".modal-body #auteurEdit").val(auteur).trigger('change');
        //$(this).find(".modal-body #date_publicationEdit").val(date);
        $(this).find(".modal-body #resumeEdit").val(resume);
        $(this).find(".modal-body #imageEdit").attr('src', "/logo/"+logo);
        $(this).find(".modal-body #type_document_idEdit").val(type).trigger('change');
    });

    $("#delete").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var id = button.data("rep");
        var titre = button.data("info");
        $(this)
            .find(".modal-body #code")
            .val(id);
        $(this)
            .find(".modal-body #name")
            .val(titre);
    });
</script>
@endsection
