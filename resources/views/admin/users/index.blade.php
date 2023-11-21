@extends('layouts.app',['title'=>'Utilisateurs'])

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @if (session()->has('success'))
        <div class="alert alert-success mx-auto col-md-11" role="alert">
            <span><i class="fas fa-info-circle"></i>{{ ' ' . session('success') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-light mx-auto col-md-11 shadow border-bottom-secondary collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Ajouter un utilisateur</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <a class="d-sm-inline-block btn btn-primary btn-icon-split">
                        <span class="icon text-white">
                            <i class="fas fa-plus"></i>
                        </span>
                    </a>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @livewire('users')
        </div>
    </div>
    <div class=" mx-auto col-11 card shadow border-left-secondary">
        <div class="card-header">{{ __('LISTE DES UTILISATEURS') }}
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a class="d-sm-inline-block btn btn-primary btn-icon-split" onclick="refresh()">
                        <img class="nav-icon" width="35px" height="35px"
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
                            <th>Prénom(s)</th>
                            <th>Direction</th>
                            <th>Login</th>
                            <th>Rôle</th>
                            <th>Etat</th>
                            {{-- @can('admin')
                                <th>Créateur</th>
                            @endcan --}}
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($users as $user)
                            <?php $i++; ?>
                            <tr class="{{ $user->state ? 'table-success' : 'table-secondary' }}">
                                <th>{{ $i }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->forname }}</td>
                                <td>{{ getUserDirection($user->code_dir) }}</td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    {{ implode(
    ', ',
    $user->roles()->get()->pluck('name')->toArray(),
) }}</td>
                                <td>{{ $user->state ? 'Actif' : 'Inactif' }}</td>
                                <td>

                                    @cannot('admin')
                                        <a href="{{ route('admin.users.edit', $user->id) }}">
                                            <button class="btn btn-warning btn-circle btn-sm ml-1 my-1"
                                                title="Modifier ce utilisateur" @if ($user->roles()->get()->pluck('name')->contains('admin') &&
            !Auth::user()->roles()->pluck('name')->contains('admin'))
                                                disabled
                            @endif
                            @if (Auth::user()->id != $user->owner && Auth::user()->id != $user->id)
                                disabled
                            @endif >
                            <i class="fas fa-edit"></i>
                            </button>
                            </a>

                        @endcan
                        @can('admin')
                            <a href="{{ route('activate', $user->id) }}">
                                <button class="btn btn-secondary btn-circle btn-sm ml-1 my-1"
                                    title="{{ $user->state ? 'Désactiver' : 'Activer' }} l'utilisateur">
                                    <i class="fas {{ $user->state ? 'fa-lock' : 'fa-lock-open' }} "></i>
                                </button>
                            </a>
                            <a href="{{ route('profil.edit', $user->id) }}">
                                <button class="btn btn-success btn-circle btn-sm ml-1 my-1"
                                    title="renitialiser le mot de passe">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </a>

                            <a href="{{ route('admin.users.edit', $user->id) }}">
                                <button class="btn btn-warning btn-circle btn-sm ml-1 my-1" title="Modifier ce utilisateur">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </a>
                            <button class="btn btn-danger btn-circle btn-sm ml-2 my-1" data-user="{{ $user->id }}"
                                data-info="{{ $user->name }} {{ $user->forname }} alias {{ $user->username }}"
                                data-toggle="modal" data-target="#delete" title="Supprimer ce utilisateur">
                                <i class="fas fa-trash"></i>
                            </button>
                        @endcan
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


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
                    <form method="post" action="{{ route('admin.users.destroy', 'test') }}">
                        @csrf
                        @method('DELETE')

                        <div class="form-group">
                            <div class="text-center">
                                <label class="col-form-label">Etes vous sûr de vouloir supprimer ce utilisateur ?</label>
                                <input type="text" class="form-control text-center mx-auto col-8" readonly name="nom"
                                    id="nom" value="">
                            </div>
                            <input type="hidden" name="id" id="id" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Non, Annuler</button>
                            <button type="submit" class="btn btn-danger">Oui, Supprimer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('scripts')
    <script>
        $('#delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('user');
            var nom = button.data('info');
            $(this).find('.modal-body #id').val(id);
            $(this).find('.modal-body #nom').val(nom);
        });

        function refresh() {
            location.reload(true);
        }
    </script>
@endsection
