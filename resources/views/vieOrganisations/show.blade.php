@extends('layouts.app',['title'=>'Détails Document'])

@section('styles')
<style>
    .project {
        margin: 15px 0;
    }

    .no-gutter .project {
        margin: 0 !important;
        padding: 0 !important;
    }

    .has-spacer {
        margin-left: 30px;
        margin-right: 30px;
        margin-bottom: 30px;
    }

    .has-spacer-extra-space {
        margin-left: 30px;
        margin-right: 30px;
        margin-bottom: 30px;
    }

    .has-side-spacer {
        margin-left: 30px;
        margin-right: 30px;
    }

    .project-title {
        font-size: 1.25rem;
    }

    .project-skill {
        font-size: 0.9rem;
        font-weight: 400;
        letter-spacing: 0.06rem;
    }

    .project-info-box {
        margin: 15px 0;
        background-color: #fff;
        padding: 30px 40px;
        border-radius: 5px;
    }

    .project-info-box p {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #d5dadb;
    }

    .project-info-box p:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .myimg {
        width: 100%;
        max-width: 100%;
        height: auto;
        -webkit-backface-visibility: hidden;
    }

    .mr-5 {
        margin-right: 5px !important;
    }

    .mb-0 {
        margin-bottom: 0 !important;
    }

    .project-info-box p {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #d5dadb;
    }

    b,
    strong {
        font-weight: 700 !important;
    }
</style>
@endsection

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row my-2">
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="d-sm-flex align-items-center mb-5 ml-5 col-md-10 justify-content-between">

    <a href="{{ route('documents.index') }}" class="d-sm-inline-block btn btn-secondary btn-icon-split">
        <span class="icon text-white">
            <i class="fas fa-layer-group"></i>
        </span>
        <span class="text">Tous les Documents</span>
    </a>

</div>

<div class="container">
    <div class="row mx-2">
        <div class="col-md-6 ">
            <div class="project-info-box mt-0">
                <h5>{{ $document->nom }}</h5>
            </div><!-- / project-info-box -->

            <div class="project-info-box">
                <p><b>Type :</b> {{ $document->type->libelle }}</p>
                <p><b>Auteur:</b> {{ $document->auteur }}</p>
                <p><b>Date de publication:</b> {{\Carbon\Carbon::parse($document->date_publication)->translatedFormat('d M Y')}}</p>

            </div><!-- / project-info-box -->
            <div class="project-info-box mt-0">
                    <img src="{{ asset("logo/".$document->logo) }}" alt="Pas de photo de couverture" style="width:200px; height:200px">
                </div>
        </div><!-- / column -->

        <div class="col-md-6">

            <div class="project-info-box" style="height: 300px;">

                <h5><b>{{ 'Résumé :' }}</b></h5>
                <p>{{ $document->resume ?? '' }}</p>
            </div>
            <!-- / column -->
        </div>
    </div>

    <div class="row mx-3 mt-3">
        <div class=" mx-auto col-md-12 card ">
            <div class="card-header">

                <h3 class="card-title">{{ __('LISTE DES FICHIERS ATTACHES') }} </h3>

            </div>

            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered example1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fichier</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($document->fichiers as $file)
                            <?php $i++; ?>
                            <tr>
                                <th class="">{{ $i }}</th>
                                <td class="">{{ str_replace($document->id . '_', '', $file->url) }}</td>
                                <td>
                                    <a href="{{ route('fichier-documents.open', $file->url) }}">
                                        <button class="btn btn-info btn-circle btn-sm ml-1 my-1" title="Ouvrir">
                                            <i class="fas fa-glasses"></i>
                                        </button>
                                    </a>
                                    @can('manage-users')
                                    <form action="{{ route('fichier-documents.destroy', 'test') }}" method="POST" class=" d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="code" id="code" value="{{ $file->url }}">
                                        <input type="hidden" name="nom" id="nom" value="{{ str_replace($document->id . '_', '', $file->url) }}">

                                        <button class="btn btn-danger btn-circle btn-sm ml-2 my-1" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @if (count($document->fichiers) >= 10)
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Fichier</th>
                            </tr>
                        </tfoot>
                        @endif

                    </table>
                </div>
            </div>

        </div>

    </div>
</div>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2">
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Fin Modal-->
    @endsection
    @section('scripts')
    <script>
        function refresh() {
            location.reload(true);
        }
        //Initialize Select2 Elements
        $('.select2').select2();
    </script>
    @endsection
