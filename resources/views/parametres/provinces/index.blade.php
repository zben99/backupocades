@extends('layouts.app',['title'=>'Provinces'])


@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-3">
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class=" mx-auto col-md-11 card shadow border-left-secondary">
        <div class="card-header">
            <h3 class="card-title">{{ __('LISTE DES PROVINCES') }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a class="d-sm-inline-block btn btn-secondary btn-icon-split" data-toggle="modal"
                        data-target="#addProvinceModal">
                        <span class="icon text-white">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Nouvelle Province</span>
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
                            <th>Région</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($provinces as $province)
                            <?php $i++; ?>
                            <tr>
                                <th class="">{{ $i }}</th>
                                <td class="">{{ $province->region->nom }}</td>
                                <td class="">{{ $province->province }}</td>
                                <td class="">{{ $province->description }}</td>
                                <td class="">
                                    <button class="btn btn-warning btn-circle btn-sm ml-1 my-1"
                                        data-id="{{ $province->id }}" data-desc="{{ $province->description }}"
                                        data-province="{{ $province->province }}"
                                        data-region_id="{{ $province->region_id }}" data-toggle="modal"
                                        data-target="#editProvinceModal" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button class="btn btn-danger btn-circle btn-sm ml-2 my-1"
                                        data-rep="{{ $province->id }}"
                                        data-info="{{ $province->province }} ({{ $province->region->nom }})"
                                        data-toggle="modal" data-target="#delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @if (count($provinces) >= 10)
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Région</th>
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
    <div class="modal fade" id="addProvinceModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title m-auto">AJOUT D'UNE NOUVELLE PROVINCE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-gradient-light">
                    <div class="alert alert-warning" style="display:none"></div>
                    <form id="addProvince">
                        @include('parametres.provinces._form')

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Annuler</button>
                            <button type="submit" class="btn btn-primary close-modal">Enregistrer</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProvinceModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title m-auto">MODIFICATION PROVINCE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-gradient-light">
                    <form id="updateProvince">
                        <input type="hidden" name="code" id="province_id">
                        @include('parametres.provinces._formUpdate')

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
                    <form method="post" action="{{ route('provinces.destroy', 'test') }}">
                        @csrf
                        @method('DELETE')

                        <div class="form-group">
                            <div class="text-center">
                                <label class="col-form-label">Etes vous sûr de vouloir supprimer cette province ?</label>
                                <input type="text" class="form-control text-center mx-auto col-8" readonly name="province"
                                    id="province" value="">
                            </div>
                            <input type="hidden" name="code" id="code" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Non, Annuler</button>
                            <button type="submit" class="btn btn-secondary">Oui, Supprimer</button>
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

        $('#addProvince').on('submit', (function(e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();
            var formData = new FormData(this);
            let _url = '/provinces/create';
            $.ajax({
                url: _url,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {

                    location.reload(true);
                    $('#province').text('');
                    $('#regionError').text('');

                },
                error: function(response) {

                    $('#provinceError').text('');
                    $('#regionError').text('');
                    $('#provinceError').text(response.responseJSON.errors.province);
                    $('#regionError').text(response.responseJSON.errors.region_id);
                }
            });
        }));

        $('#updateProvince').on('submit', (function(e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();
            var id = $('#province_id').val();
            var formData = new FormData(this);
            let _url = '/provinces/' + id;
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

                    $('#provinceEditError').text('');
                    $('#regionEditError').text('');
                    $('#provinceEditError').text(response.responseJSON.errors.province);
                    $('#regionEditError').text(response.responseJSON.errors.region_id);
                }
            });
        }));


        $("#editProvinceModal").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget);
            var id = button.data("id");
            var province = button.data("province");
            var region = button.data("region_id");
            var desc = button.data("desc");
            $(this).find(".modal-body #province_id").val(id);
            $(this).find(".modal-body #provinceEdit").val(province);
            $(this).find(".modal-body #regionEdit").val(region).trigger('change');
            $(this).find(".modal-body #descEdit").val(desc);
        });

        $("#delete").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget);
            var id = button.data("rep");
            var province = button.data("info");
            $(this)
                .find(".modal-body #code")
                .val(id);
            $(this)
                .find(".modal-body #province")
                .val(province);
        });
    </script>
@endsection
