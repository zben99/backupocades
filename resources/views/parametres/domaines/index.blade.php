@extends('layouts.app',['title'=>'Domaines'])


@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-3">
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class=" mx-auto col-md-11 card shadow border-left-secondary">
        <div class="card-header">
            <h3 class="card-title">{{ __('LISTE DES DOMAINES') }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a class="d-sm-inline-block btn btn-secondary btn-icon-split" data-toggle="modal"
                        data-target="#addDomaineModal">
                        <span class="icon text-white">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Nouveau Domaine</span>
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
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($domaines as $domaine)
                            <?php $i++; ?>
                            <tr>
                                <th class="">{{ $i }}</th>
                                <td class="">{{ $domaine->secteur->nom }}</td>
                                <td class="">{{ $domaine->domaine }}</td>
                                <td class="">{{ $domaine->description }}</td>
                                <td class="">
                                    <button class="btn btn-warning btn-circle btn-sm ml-1 my-1"
                                        data-id="{{ $domaine->id }}" data-desc="{{ $domaine->description }}"
                                        data-domaine="{{ $domaine->domaine }}"
                                        data-secteur_id="{{ $domaine->secteur_id }}" data-toggle="modal"
                                        data-target="#editDomaineModal" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button class="btn btn-danger btn-circle btn-sm ml-2 my-1"
                                        data-rep="{{ $domaine->id }}"
                                        data-info="{{ $domaine->domaine }} ({{ $domaine->secteur->nom }})"
                                        data-toggle="modal" data-target="#delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @if (count($domaines) >= 10)
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Secteur</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    @endif

                </table>
            </div>
        </div>
    </div>


    {{-- Modal Ajouter un nouveau role --}}
    <div class="modal fade" id="addDomaineModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title m-auto">AJOUT D'UN NOUVEAU DOMAINE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-gradient-light">
                    <div class="alert alert-warning" style="display:none"></div>
                    <form id="addDomaine">
                        @include('parametres.domaines._form')

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Annuler</button>
                            <button type="submit" class="btn btn-primary close-modal">Enregistrer</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editDomaineModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title m-auto">MODIFICATION DOMAINE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-gradient-light">
                    <form id="updateDomaine">
                        <input type="hidden" name="code" id="domaine_id">
                        @include('parametres.domaines._formUpdate')

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
                    <img src="{{ asset('img/delete.svg') }}" width="60" height="45" class="d-inline-block align-top"
                        alt="">
                    <h5 class="modal-title m-auto"> Confirmation de suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-gradient-light">
                    <form method="post" action="{{ route('domaines.destroy', 'test') }}">
                        @csrf
                        @method('DELETE')

                        <div class="form-group">
                            <div class="text-center">
                                <label class="col-form-label">Etes vous sûr de vouloir supprimer ce domaine ?</label>
                                <input type="text" class="form-control text-center mx-auto col-8" readonly name="domaine"
                                    id="domaine" value="">
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

        $('#addDomaine').on('submit', (function(e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();
            var formData = new FormData(this);
            let _url = '/domaines/create';
            $.ajax({
                url: _url,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {

                    location.reload(true);
                    $('#domaine').text('');
                    $('#secteurError').text('');

                },
                error: function(response) {

                    $('#domaineError').text('');
                    $('#secteurError').text('');
                    $('#domaineError').text(response.responseJSON.errors.domaine);
                    $('#secteurError').text(response.responseJSON.errors.secteur_id);
                }
            });
        }));

        $('#updateDomaine').on('submit', (function(e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();
            var id = $('#domaine_id').val();
            var formData = new FormData(this);
            let _url = '/domaines/' + id;
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

                    $('#domaineEditError').text('');
                    $('#secteurEditError').text('');
                    $('#domaineEditError').text(response.responseJSON.errors.domaine);
                    $('#secteurEditError').text(response.responseJSON.errors.secteur_id);
                }
            });
        }));


        $("#editDomaineModal").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget);
            var id = button.data("id");
            var domaine = button.data("domaine");
            var secteur = button.data("secteur_id");
            var desc = button.data("desc");
            $(this).find(".modal-body #domaine_id").val(id);
            $(this).find(".modal-body #domaineEdit").val(domaine);
            $(this).find(".modal-body #secteurEdit").val(secteur).trigger('change');
            $(this).find(".modal-body #descEdit").val(desc);
        });

        $("#delete").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget);
            var id = button.data("rep");
            var domaine = button.data("info");
            $(this)
                .find(".modal-body #code")
                .val(id);
            $(this)
                .find(".modal-body #domaine")
                .val(domaine);
        });
    </script>
@endsection
