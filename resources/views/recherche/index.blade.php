@extends('layouts.app',['title'=>'Recherches'])

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @livewire('projets.searchprojet',[
    'types' => $types,
    'regions' => $regions,
    'provinces' => $provinces,
    'communes' => $communes,
    'paroisses' => $paroisses,
    'secteurs' => $secteurs,
    'domaines' => $domaines,
    'partenaires' => $partenaires,
    'projets' => $projets
    ])

@endsection
@push('scripts')
    <script>
        function refresh() {
            location.reload(true);
        }
        //Initialize Select2 Elements
        $('.select2').select2();
    </script>
@endpush
