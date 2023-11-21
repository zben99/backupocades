@extends('layouts.app',['title'=>'Paroisses'])


@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-3">
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class=" mx-auto col-md-11 card shadow border-left-secondary">
        <div class="card-header">
            <h3 class="card-title">{{ __('LISTE DES PAROISSES') }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a class="d-sm-inline-block btn btn-secondary btn-icon-split" data-toggle="modal"
                        data-target="#addParoisseModal">
                        <span class="icon text-white">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Nouvelle Paroisse</span>
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
                            <th>Commune</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($paroisses as $paroisse)
                            <?php $i++; ?>
                            <tr>
                                <th class="">{{ $i }}</th>
                                <td class="">{{ $paroisse->commune->commune }}</td>
                                <td class="">{{ $paroisse->paroisse }}</td>
                                <td class="">{{ $paroisse->description }}</td>
                                <td class="">
                                    <button class="btn btn-warning btn-circle btn-sm ml-1 my-1"
                                        data-id="{{ $paroisse->id }}" data-desc="{{ $paroisse->description }}"
                                        data-paroisse="{{ $paroisse->paroisse }}"
                                        data-commune_id="{{ $paroisse->commune_id }}" data-toggle="modal"
                                        data-target="#editParoisseModal" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button class="btn btn-danger btn-circle btn-sm ml-2 my-1"
                                        data-rep="{{ $paroisse->id }}"
                                        data-info="{{ $paroisse->paroisse }} ({{ $paroisse->commune->commune }})"
                                        data-toggle="modal" data-target="#delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @if (count($paroisses) >= 10)
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Commune</th>
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
    <div class="modal fade" id="addParoisseModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title m-auto">AJOUT D'UNE NOUVELLE PAROISSE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-gradient-light">
                    <div class="alert alert-warning" style="display:none"></div>
                    <form id="addParoisse">
                        @include('parametres.paroisses._form')

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Annuler</button>
                            <button type="submit" class="btn btn-primary close-modal">Enregistrer</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editParoisseModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title m-auto">MODIFICATION PAROISSE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-gradient-light">
                    <form id="updateParoisse">
                        <input type="hidden" name="code" id="paroisse_id">
                        @include('parametres.paroisses._formUpdate')

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
                    <form method="post" action="{{ route('paroisses.destroy', 'test') }}">
                        @csrf
                        @method('DELETE')

                        <div class="form-group">
                            <div class="text-center">
                                <label class="col-form-label">Etes vous sûr de vouloir supprimer cette paroisse ?</label>
                                <input type="text" class="form-control text-center mx-auto col-8" readonly name="paroisse"
                                    id="paroisse" value="">
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

        $('#addParoisse').on('submit', (function(e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();
            var formData = new FormData(this);
            let _url = '/paroisses/create';
            $.ajax({
                url: _url,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {

                    location.reload(true);
                    $('#paroisse').text('');
                    $('#communeError').text('');

                },
                error: function(response) {

                    $('#paroisseError').text('');
                    $('#communeError').text('');
                    $('#paroisseError').text(response.responseJSON.errors.paroisse);
                    $('#communeError').text(response.responseJSON.errors.commune_id);
                }
            });
        }));

        $('#updateParoisse').on('submit', (function(e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();
            var id = $('#paroisse_id').val();
            var formData = new FormData(this);
            let _url = '/paroisses/' + id;
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

                    $('#paroisseEditError').text('');
                    $('#communeEditError').text('');
                    $('#paroisseEditError').text(response.responseJSON.errors.paroisse);
                    $('#communeEditError').text(response.responseJSON.errors.commune_id);
                }
            });
        }));


        $("#editParoisseModal").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget);
            var id = button.data("id");
            var paroisse = button.data("paroisse");
            var commune = button.data("commune_id");
            var desc = button.data("desc");
            $(this).find(".modal-body #paroisse_id").val(id);
            $(this).find(".modal-body #paroisseEdit").val(paroisse);
            $(this).find(".modal-body #communeEdit").val(commune).trigger('change');
            $(this).find(".modal-body #descEdit").val(desc);
        });

        $("#delete").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget);
            var id = button.data("rep");
            var paroisse = button.data("info");
            $(this)
                .find(".modal-body #code")
                .val(id);
            $(this)
                .find(".modal-body #paroisse")
                .val(paroisse);
        });
    </script>
@endsection
