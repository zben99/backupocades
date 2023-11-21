@extends('layouts.app',['title'=>'Type partenaires'])


@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-3">
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class=" mx-auto col-md-11 card shadow border-left-secondary">
        <div class="card-header">
            <h3 class="card-title">{{ __('LISTE DES TYPES DE PARTENAIRES') }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a class="d-sm-inline-block btn btn-secondary btn-icon-split" data-toggle="modal"
                        data-target="#addTypepartenaireModal">
                        <span class="icon text-white">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Nouveau type de partenaire</span>
                    </a>
                </button>
                <button type="button" class="btn btn-tool">
                    <a class="d-sm-inline-block btn btn-primary btn-icon-split" onclick="refresh()">
                        <img class="nav-icon" width="30px" height="30px"
                            src="{{ asset('img/icons/provenance.ico') }}" />
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
                            <th>Libelle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($typepartenaires as $typepartenaire)
                            <?php $i++; ?>
                            <tr>
                                <th class="___class_+?19___">{{ $i }}</th>
                                <td class="___class_+?20___">{{ $typepartenaire->libelle }}</td>
                                <td class="___class_+?21___">
                                    <button class="btn btn-warning btn-circle btn-sm ml-1 my-1"
                                        data-id="{{ $typepartenaire->id }}"
                                        data-libelle="{{ $typepartenaire->libelle }}"
                                        data-desc="{{ $typepartenaire->description }}" data-toggle="modal"
                                        data-target="#editTypepartenaireModal" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button class="btn btn-danger btn-circle btn-sm ml-2 my-1"
                                        data-rep="{{ $typepartenaire->id }}" data-info="{{ $typepartenaire->libelle }}"
                                        data-toggle="modal" data-target="#delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @if (count($typepartenaires) >= 10)
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Libelle</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    @endif

                </table>
            </div>
        </div>
    </div>


    {{-- Modal Ajouter un nouveau role --}}
    <div class="modal fade" id="addTypepartenaireModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title m-auto">AJOUT D'UN NOUVEAU TYPE DE PARTENAIRE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-gradient-light">
                    <div class="alert alert-warning" style="display:none"></div>
                    <form id="addTypepartenaire">
                        @include('parametres.typepartenaires._form')

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Annuler</button>
                            <button type="submit" class="btn btn-primary close-modal">Enregistrer</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editTypepartenaireModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title m-auto">MODIFICATION TYPE PARTENAIRE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-gradient-light">
                    <form id="updateTypepartenaire">
                        <input type="hidden" name="code" id="typepartenaire_id">
                        @include('parametres.typepartenaires._formUpdate')

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
                    <form method="post" action="{{ route('typepartenaires.destroy', 'test') }}">
                        @csrf
                        @method('DELETE')

                        <div class="form-group">
                            <div class="text-center">
                                <label class="col-form-label">Etes vous sûr de vouloir supprimer ce type de partenaire
                                    ?</label>
                                <input type="text" class="form-control text-center mx-auto col-8" readonly name="libelle"
                                    id="libelle" value="">
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
        $('#addTypepartenaire').on('submit', (function(e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();
            var formData = new FormData(this);
            let _url = '/typepartenaires/create';
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

                },
                error: function(response) {

                    $('#libelleError').text('');
                    $('#libelleError').text(response.responseJSON.errors.libelle);
                }
            });
        }));

        $('#updateTypepartenaire').on('submit', (function(e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();
            var id = $('#typepartenaire_id').val();
            var formData = new FormData(this);
            let _url = '/typepartenaires/' + id;
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
                    $('#libelleEditError').text(response.responseJSON.errors.libelle);
                }
            });
        }));


        $("#editTypepartenaireModal").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget);
            var id = button.data("id");
            var libelle = button.data("libelle");
            $(this).find(".modal-body #typepartenaire_id").val(id);
            $(this).find(".modal-body #libelleEdit").val(libelle);
        });

        $("#delete").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget);
            var id = button.data("rep");
            var libelle = button.data("info");
            $(this)
                .find(".modal-body #code")
                .val(id);
            $(this)
                .find(".modal-body #libelle")
                .val(libelle);
        });
    </script>
@endsection
