@extends('layouts.app',['title'=>'Restauration'])

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class=" mx-auto col-md-11 card shadow border-left-secondary">
        <div class="card-header">{{ __('LISTE DES PROJETS PROVISIONNELS SUPPRIMES') }}
            <div class="card-tools">

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
                            <th>Nom</th>
                            <th>Montant</th>
                            <th>Date Debut</th>
                            <th>Date Fin</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($projetPrevisionnels as $projetPrevisionnel)
                            <?php $i++; ?>
                            <tr>
                                <th>{{ $i }}</th>
                                <td>{{ $projetPrevisionnel->nom }}</td>
                                <td>{{ $projetPrevisionnel->montant }}</td>
                                <td>{{ \Carbon\Carbon::parse($projetPrevisionnel->debut)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($projetPrevisionnel->fin)->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('projet-previsionnel.restore', $projetPrevisionnel->id) }}">
                                        <button class="btn btn-warning btn-circle btn-sm ml-1 my-1" title="Restaurer">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-danger btn-circle btn-sm ml-2 my-1"
                                        data-doc="{{ $projetPrevisionnel->id }}"
                                        data-info="{{ $projetPrevisionnel->nom }}" data-toggle="modal"
                                        data-target="#delete" title="Supprimer definitivement">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @if (count($projetPrevisionnels) >= 10)
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Montant</th>
                                <th>Date Debut</th>
                                <th>Date Fin</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    @endif

                </table>
            </div>
        </div>
    </div>


    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2">
            </div>
        </div><!-- /.container-fluid -->
    </section>
    {{-- Model de confirmation de suppression --}}
    <div class="modal fade" id="delete" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bgcustom-gradient-light">
                <div class="modal-header">
                    <img src="{{ asset('img/delete.svg') }}" width="60" height="45" class="d-inline-block align-top"
                        alt="">
                    <h5 class="modal-title m-auto"> Confirmation de suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('projet-previsionnel.delete', 'test') }}">
                        @csrf
                        @method('DELETE')

                        <div class="form-group">
                            <div class="text-center">
                                <label class="col-form-label">Etes vous sûr de vouloir supprimer définitivement ce projet
                                    prévisionnel
                                    ?</label>
                                <input type="text" class="form-control text-center mx-auto col-8" readonly name="nom"
                                    id="nom" value="">
                            </div>
                            <input type="hidden" name="code" id="code" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Non, Annuler</button>
                            <button type="submit" class="btn btn-danger">Oui, Supprimer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal-->

@endsection
@section('scripts')
    <script>
        $('#delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('doc');
            var nom = button.data('info');
            $(this).find('.modal-body #code').val(id);
            $(this).find('.modal-body #nom').val(nom);
        });

        function refresh() {
            location.reload(true);
        }
    </script>
@endsection
