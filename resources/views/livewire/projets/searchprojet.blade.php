<div>

    @if (session()->has('Alert'))
        <div class="alert alert-warning mx-auto col-md-11" role="alert">
            <span><i class="fas fa-exclamation-triangle"></i> Attention: {{ ' ' . session('Alert') }}</span>
        </div>
    @endif

    <div class="card card-light mx-auto col-md-11 shadow border-bottom-secondary">
        <div class="card-header">
            <h3 class="card-title">Rechercher Projet</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a class="d-sm-inline-block btn btn-primary btn-icon-split" onclick="refresh()">
                        <img class="nav-icon" width="35px" height="35px"
                            src="{{ asset('img/icons/provenance.ico') }}" />
                        <span class="text text-white">Reinitialiser</span>
                    </a>
                </button>

            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="" wire:submit.prevent="found" method="POST">
                @csrf
                @include('recherche._search_form')
                <div class="form-group">
                    <div class="row justify-content-center">
                        <button type="submit" class=" mt-2 btn btn-primary mx-auto btn-block">Rechercher</button>
                    </div>

                </div>

            </form>
        </div>
    </div>

    <div wire:loading wire:target="found" class="mx-auto col-md-11">
        <div class="text-center">
            <div class="spinner-border text-info" role="status">
            </div><br>
            <span>Recherche en cours...</span>

        </div>

    </div>
    <div wire:loading.remove>
        @if (count($projets) > 0)

            <div class=" mx-auto col-md-11 card shadow border-left-secondary">
                <div class="card-header">{{ __('RESULTATS') }}</div>

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
                                @cannot('manage-users')
                                @foreach ($projets as $projet)
                                @if($projet->agent == Auth::user()->id)
                                    <?php $i++; ?>
                                    <tr>
                                        <th>{{ $i }}</th>
                                        <td>{{ getSecteurs($projet->id) }}</td>
                                        <td>{{ $projet->libelle }}</td>
                                        <td>{{ $projet->description }}</td>
                                        <td>
                                            <a href="{{ route('projets.show', $projet->id) }}">
                                                <button class="btn btn-info btn-circle btn-sm ml-1 my-1"
                                                    title="Details projet">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                @endcannot

                                @can('manage-users')
                                @foreach ($projets as $projet)
                                    <?php $i++; ?>
                                    <tr>
                                        <th>{{ $i }}</th>
                                        <td>{{ getSecteurs($projet->id) }}</td>
                                        <td>{{ $projet->libelle }}</td>
                                        <td>{{ $projet->description }}</td>
                                        <td>
                                            <a href="{{ route('projets.show', $projet->id) }}">
                                                <button class="btn btn-info btn-circle btn-sm ml-1 my-1"
                                                    title="Details projet">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                @endcan
                            </tbody>
                            @if (count($projets) >= 10)
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

        @elseif($okBtn===1)
            <div class="alert alert-warning mx-auto col-md-11 mt-5" role="alert">
                <div class="text-center ">
                    Aucun résultat pour cette recherche, Veuillez Réessayer!!
                </div>

            </div>
        @endif
    </div>



    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2">
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>


@section('scripts')
    <script>
        function refresh() {
            location.reload(true);
        }
    </script>
@endsection
