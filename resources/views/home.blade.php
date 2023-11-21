@extends('layouts.app',['title'=>'Accueil'])

@section('content')

@cannot('manage-users')
<div class="row my-auto mx-3">
        <div class="col-xl-4 col-md-6 mt-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $progsU }}</h3>

                    <p>{{ $progsU == 1 ? 'Programme' : 'Programmes' }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dashboard "></i>

                </div>
                <a href="{{ route('programs.index') }}" class="small-box-footer">
                    voir détails <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mt-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $nbProjetPU }}</h3>

                    <p>{{ $nbProjetPU == 1 ? 'Projet prévisionnel Enregistré' : 'Projets prévisionnels Enregistrés' }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-project-diagram "></i>

                </div>
                <a href="{{ route('projets-previsionnels.index') }}" class="small-box-footer">
                    voir détails <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mt-3">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $nbActivitePU }}</h3>

                    <p>{{ $nbActivitePU == 1 ? 'Activité prévisionnelle Enregistré' : 'Activités prévisionnelles Enregistrées' }}
                    </p>
                </div>
                <div class="icon">
                    <i class="fas fa-tasks  "></i>

                </div>
                <a href="{{ route('activites-previsionnelles.index') }}" class="small-box-footer">
                    voir détails <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mt-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $nbProjetU }}</h3>

                    <p>{{ $nbProjetU == 1 ? 'Projet Enregistré' : 'Projets Enregistrés' }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-project-diagram "></i>

                </div>
                <a href="{{ route('projets.index') }}" class="small-box-footer">
                    voir détails <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mt-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $nbActiviteU }}</h3>

                    <p>{{ $nbActiviteU == 1 ? 'Activité Enregistré' : 'Activités Enregistrées' }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tasks  "></i>

                </div>
                <a href="{{ route('activites.index') }}" class="small-box-footer">
                    voir détails <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
@endcannot

    @can('manage-users')
    <div class="row my-auto mx-3">
        <div class="col-xl-4 col-md-6 mt-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $progs }}</h3>

                    <p>{{ $progs == 1 ? 'Programme' : 'Programmes' }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dashboard "></i>

                </div>
                <a href="{{ route('programs.index') }}" class="small-box-footer">
                    voir détails <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mt-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $nbProjetP }}</h3>

                    <p>{{ $nbProjetP == 1 ? 'Projet prévisionnel Enregistré' : 'Projets prévisionnels Enregistrés' }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-project-diagram "></i>

                </div>
                <a href="{{ route('projets-previsionnels.index') }}" class="small-box-footer">
                    voir détails <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mt-3">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $nbActiviteP }}</h3>

                    <p>{{ $nbActiviteP == 1 ? 'Activité prévisionnelle Enregistré' : 'Activités prévisionnelles Enregistrées' }}
                    </p>
                </div>
                <div class="icon">
                    <i class="fas fa-tasks  "></i>

                </div>
                <a href="{{ route('activites-previsionnelles.index') }}" class="small-box-footer">
                    voir détails <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mt-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $nbProjet }}</h3>

                    <p>{{ $nbProjet == 1 ? 'Projet Enregistré' : 'Projets Enregistrés' }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-project-diagram "></i>

                </div>
                <a href="{{ route('projets.index') }}" class="small-box-footer">
                    voir détails <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mt-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $nbActivite }}</h3>

                    <p>{{ $nbActivite == 1 ? 'Activité Enregistré' : 'Activités Enregistrées' }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tasks  "></i>

                </div>
                <a href="{{ route('activites.index') }}" class="small-box-footer">
                    voir détails <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>


        <div class="col-xl-4 col-md-6 mt-3">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $nbPart }}</h3>

                    <p>{{ $nbPart == 1 ? 'Partenaire Enregistré' : 'Partenaires Enregistrés' }}
                    </p>
                </div>
                <div class="icon">
                    <i class="fas fa-hands-helping   "></i>

                </div>
                <a href="{{ route('partenaires.index') }}" class="small-box-footer">
                    voir détails <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
        <div class="row my-auto mx-3">
        <div class="col-xl-4 col-md-6 mt-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $news }}</h3>

                    <p>{{ $news == 1 ? 'Utilisateur' : 'Utilisateurs' }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users "></i>

                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                    voir détails <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        @can('admin')
            <div class="col-xl-4 col-md-6 mt-3">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $delProj }}</h3>

                        <p>{{ $delProj == 1 ? 'Projet Supprimé' : 'Projets Supprimées' }}</p>
                    </div>
                    <div class="icon">
                        <i class="___class_+?48___">
                            <img src="{{ asset('img/delete.svg') }}" width="60" height="45" class="d-inline-block align-top"
                                alt="">
                        </i>
                    </div>
                    <a href="{{ route('restaurer-projet.index') }}" class="small-box-footer">
                        voir détails <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mt-3">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $delPrev }}</h3>

                        <p>{{ $delPrev == 1 ? 'Projet Prévisionnel Supprimé' : 'Projets Prévisionnels Supprimées' }}</p>
                    </div>
                    <div class="icon">
                        <i class="___class_+?48___">
                            <img src="{{ asset('img/delete.svg') }}" width="60" height="45" class="d-inline-block align-top"
                                alt="">
                        </i>
                    </div>
                    <a href="{{ route('restaurer-projet-previsionnel.index') }}" class="small-box-footer">
                        voir détails <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
    @endcan
        </div>

    </div>
@endcan
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-4">
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
