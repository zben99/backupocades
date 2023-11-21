@extends('layouts.app',['title'=>'Historiques'])

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="d-sm-flex align-items-center mb-5 ml-4 col-md-11 justify-content-between">

        <a href="{{ route('projet-history.vider') }}" class="d-sm-inline-block btn btn-outline-danger btn-icon-split">
            <span class="icon">
                <i class="fas fa-eraser"></i>
            </span>
            <span class="text">Tout Vider</span>
        </a>
    </div>
    <!-- Fin en tête de page -->
    <div class="card my-3">
        <div class="card-header">

            <h3 class="card-title">{{ __('HISTORIQUE DES OPERATIONS SUR LES PROJETS') }} </h3>
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
                <table class="table table-bordered example1" width="100%" id="example1" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Opération</th>
                            <th>Projet</th>
                            <th>Agent</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        @if ($operations->count() > 6)
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Opération</th>
                                <th>Projet</th>
                                <th>Agent</th>
                                <th>Actions</th>
                            </tr>
                        @endif
                    </tfoot>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($operations as $operation)
                            <?php $i++; ?>
                            <tr>
                                <th>{{ $i }}</th>
                                <td>
                                    {{ \Carbon\Carbon::parse($operation->created_at)->translatedFormat('d M Y H:m:s') }}
                                </td>
                                <td>{{ $operation->motif }}</td>
                                <td>
                                    {{ $operation->projet }}
                                </td>
                                <td>{{ $operation->user->name }}
                                    {{ $operation->user->forname }}</td>
                                <td>
                                    <form method="post" action="{{ route('projet-history.destroy', 'test') }}"
                                        class=" d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <input type="hidden" name="code" id="code" value="{{ $operation->id }}">
                                        <input type="hidden" name="nom" id="nom" value="{{ $operation->motif }}">

                                        <button class="btn btn-danger btn-circle btn-sm ml-2 my-1" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    </div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('scripts')
    <script>
        function refresh() {
            location.reload(true);
        }
    </script>
@endsection
