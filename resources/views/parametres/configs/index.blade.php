@extends('layouts.app',['title'=>'Configurations'])


@section('content')


<section class="content-header">
    <div class="container-fluid">
        <div class="row my-3">
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class=" mx-auto col-md-11 card shadow border-left-secondary">
    <div class="card-header">
        <h3 class="card-title">{{ __('CONFIGURATION') }}</h3>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card-body">

        <form method="POST" action="{{ route('configs.update', $config->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">

                        <label for="logotmp" class="">Logo</label>
                        <div class="">
                            <img src="{{ asset("logo/".$config->logo) }}" alt="Pas de logo">
                            <input type="file" name="logotmp" />
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="telephone" class="">Telephone</label>
                        <div class="">
                            <input type="text" value="{{ $config->telephone }}" class="form-control" name="telephone" placeholder="Entrez le telephone">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="adresse" class="">Adresse</label>
                        <div class="">
                            <input type="text" value="{{ $config->adresse }}" class="form-control" name="adresse" placeholder="Entrez l'adresse">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nom" class="">Nom <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" value="{{ $config->nom }}" class="form-control" name="nom" placeholder="Entrez le nom">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="site" class="">Site</label>
                        <div class="">
                            <input type="text" value="{{ $config->site }}" class="form-control" name="site" placeholder="Entrez le site">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email" class="">Email</label>
                        <div class="">
                            <input type="email" value="{{ $config->email }}" class="form-control" name="email" placeholder="Entrez le email">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Enregistrer</button>
        </form>
    </div>
</div>



<section class="content-header">
    <div class="container-fluid">
        <div class="row my-2">
        </div>
    </div><!-- /.container-fluid -->
</section>


@endsection
