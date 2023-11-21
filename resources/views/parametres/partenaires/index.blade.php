@extends('layouts.app',['title'=>'Partenaires'])


@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-3">
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class=" mx-auto col-md-11 card shadow border-left-secondary">
        <div class="card-header">
            <h3 class="card-title">{{ __('LISTE DES PARTENAIRES') }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a class="d-sm-inline-block btn btn-secondary btn-icon-split" data-toggle="modal"
                        data-target="#addPartenaireModal">
                        <span class="icon text-white">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Nouveau Partenaire</span>
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
                            <th>Type de partenaire</th>
                            <th>Nom</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Adresse</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($partenaires as $partenaire)
                            <?php $i++; ?>
                            <tr>
                                <th>{{ $i }}</th>
                                <td>{{ $partenaire->typepartenaire->libelle }}</td>
                                <td>{{ $partenaire->nom }}</td>
                                <td>{{ $partenaire->telephone }}</td>
                                <td>{{ $partenaire->email }}</td>
                                <td>{{ $partenaire->adresse }}</td>
                                <td>{{ $partenaire->description }}</td>
                                <td>
                                    <button class="btn btn-warning btn-circle btn-sm ml-1 my-1"
                                        data-id="{{ $partenaire->id }}" data-desc="{{ $partenaire->description }}"
                                        data-nom="{{ $partenaire->nom }}"
                                        data-telephone="{{ $partenaire->telephone }}"
                                        data-email="{{ $partenaire->email }}"
                                        data-adresse="{{ $partenaire->adresse }}"
                                        data-typepartenaire_id="{{ $partenaire->typepartenaire_id }}" data-toggle="modal"
                                        data-target="#editPartenaireModal" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button class="btn btn-danger btn-circle btn-sm ml-2 my-1"
                                        data-rep="{{ $partenaire->id }}"
                                        data-info="{{ $partenaire->nom }} ({{ $partenaire->typepartenaire->libelle }})"
                                        data-toggle="modal" data-target="#delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @if (count($partenaires) >= 10)
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Type de partenaire</th>
                                <th>Nom</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Adresse</th>
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
    <div class="modal fade" id="addPartenaireModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title m-auto">AJOUT D'UN NOUVEAU PARTENAIRE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-gradient-light">
                    <div class="alert alert-warning" style="display:none"></div>
                    <form id="addPartenaire">
                        @include('parametres.partenaires._form')

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Annuler</button>
                            <button type="submit" class="btn btn-primary close-modal">Enregistrer</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editPartenaireModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title m-auto">MODIFICATION PARTENAIRE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-gradient-light">
                    <form id="updatePartenaire">
                        <input type="hidden" name="code" id="partenaire_id">
                        @include('parametres.partenaires._formUpdate')

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal"> Annuler</button>
                            <button type="submit" class="btn btn-warning close-modal">Enregistrer</button>
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
                    <form method="post" action="{{ route('partenaires.destroy', 'test') }}">
                        @csrf
                        @method('DELETE')

                        <div class="form-group">
                            <div class="text-center">
                                <label class="col-form-label">Etes vous sûr de vouloir supprimer cette partenaire ?</label>
                                <input type="text" class="form-control text-center mx-auto col-8" readonly name="partenaire"
                                    id="infoname" value="">
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

        $('#addPartenaire').on('submit', (function(e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();
            var formData = new FormData(this);
            let _url = '/partenaires/create';
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
                    $('#email').text('');
                    $('#adresse').text('');
                    $('#telephone').text('');
                    $('#typepartenaireError').text('');

                },
                error: function(response) {

                    $('#nomError').text('');
                    $('#emailError').text('');
                    $('#telephoneError').text('');
                    $('#adresseError').text('');
                    $('#typepartenaireError').text('');
                    $('#nomError').text(response.responseJSON.errors.nom);
                    $('#emailError').text(response.responseJSON.errors.email);
                    $('#telephoneError').text(response.responseJSON.errors.telephone);
                    $('#adresseError').text(response.responseJSON.errors.adresse);
                    $('#typepartenaireError').text(response.responseJSON.errors.typepartenaire_id);
                }
            });
        }));

        $('#updatePartenaire').on('submit', (function(e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();
            var id = $('#partenaire_id').val();
            var formData = new FormData(this);
            let _url = '/partenaires/' + id;
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
                    $('#telephoneEditError').text('');
                    $('#emailEditError').text('');
                    $('#adresseEditError').text('');
                    $('#typepartenaireEditError').text('');
                    $('#nomEditError').text(response.responseJSON.errors.nom);
                    $('#emailEditError').text(response.responseJSON.errors.email);
                    $('#telephoneEditError').text(response.responseJSON.errors.telephone);
                    $('#adresseEditError').text(response.responseJSON.errors.adresse);
                    $('#typepartenaireEditError').text(response.responseJSON.errors
                        .typepartenaire_id);
                }
            });
        }));


        $("#editPartenaireModal").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget);
            var id = button.data("id");
            var nom = button.data("nom");
            var telephone = button.data("telephone");
            var email = button.data("email");
            var adresse = button.data("adresse");
            var typepartenaire = button.data("typepartenaire_id");
            var desc = button.data("desc");
            $(this).find(".modal-body #partenaire_id").val(id);
            $(this).find(".modal-body #nomEdit").val(nom);
            $(this).find(".modal-body #telephoneEdit").val(telephone);
            $(this).find(".modal-body #emailEdit").val(email);
            $(this).find(".modal-body #adresseEdit").val(adresse);
            $(this).find(".modal-body #typepartenaireEdit").val(typepartenaire).trigger('change');
            $(this).find(".modal-body #descEdit").val(desc);
        });

        $("#delete").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget);
            var id = button.data("rep");
            var nom = button.data("info");
            $(this)
                .find(".modal-body #code")
                .val(id);
            $(this)
                .find(".modal-body #infoname")
                .val(nom);
        });
    </script>
@endsection
