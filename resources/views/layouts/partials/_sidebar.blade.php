<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('logo/'.\App\Models\Config::first()->logo) }}" alt="Logo " class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"> {{ \App\Models\Config::first()->nom }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @php
        $image = Auth::user()->avatar;
        @endphp
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('telechargements/avatars/' . $image . '') }}" style="width: 40px; height: 40px;" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('profil.index') }}" class="d-block"> {{ Auth::user()->name }}
                    {{ Auth::user()->forname }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Rechercher" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                @can('manage-users')
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link  {{ set_active_route('home') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        Tableau de Bord
                    </a>
                </li>
                @endcan
                @cannot('manage-users')
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ set_active_route('home') }} ">
                        <i class="nav-icon fas fa-home"></i>
                        Accueil
                    </a>
                </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ set_active_route('projets.index') }} {{ set_active_route('activites.index') }} {{ set_active_route('programs.index') }} {{ set_active_route('projets-previsionnels.index') }} {{ set_active_route('activites-previsionnelles.index') }} {{ set_active_route('partenaires.index') }} {{ set_active_route('projets.statistique') }}">
                        <img class="nav-icon" src="{{ asset('img/icons/projet.ico') }}" />
                        <p>
                            Gestion Projets
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item ">
                            <a href="{{ route('programs.index') }}" class="nav-link {{ set_active_route('programs.index') }}">
                                <i class="far fa-circle nav-icon text-info "></i>
                                <p>Programmes</p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('projets-previsionnels.index') }}" class="nav-link {{ set_active_route('projets-previsionnels.index') }}">
                                <i class="far fa-circle nav-icon text-warning "></i>
                                <p>Projets Prévisonnels</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('projets.index') }}" class="nav-link {{ set_active_route('projets.index') }}">
                                <i class="far fa-circle nav-icon text-success"></i>
                                <p>Projets</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('activites-previsionnelles.index') }}" class="nav-link {{ set_active_route('activites-previsionnelles.index') }}">
                                <i class="far fa-circle nav-icon text-orange"></i>
                                <p>Activités Prévisionnelles</p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('activites.index') }}" class="nav-link {{ set_active_route('activites.index') }}">
                                <i class="far fa-circle nav-icon text-primary"></i>
                                <p>Activités réalisées</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item ">
                            <a href="{{ route('projets.statistique') }}" class="nav-link {{ set_active_route('projets.statistique') }}">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>Statistiques</p>
                            </a>
                        </li> -->

                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('documents.index') }}"
                        class="nav-link {{ set_active_route('documents.index') }}">
                        <img class="nav-icon" src="{{ asset('img/icons/dossier.png') }}" />
                        <p> Vie Organisation</p>
                    </a>
                </li>

                @can('manage-users')

                <li class="nav-item ">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ set_active_route('admin.users.index') }}">
                        <img class="nav-icon" src="{{ asset('img/icons/adminuser.ico') }}" />
                        <p>
                            Utilisateurs
                        </p>
                    </a>
                </li>
                    <li class="nav-item ">
                        <a href="{{ route('home') }}" class="nav-link {{ set_active_route('objectif-specifiques.index') }} {{ set_active_route('regions.index') }} {{ set_active_route('provinces.index') }}  {{ set_active_route('communes.index') }} {{ set_active_route('villages.index') }} {{ set_active_route('paroisses.index') }} {{ set_active_route('secteurs.index') }} {{ set_active_route('domaines.index') }}  {{ set_active_route('typepartenaires.index') }}">
                            <img class="nav-icon" src="{{ asset('img/icons/parametre1.ico') }}" />
                            <p>
                                Paramètres
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('partenaires.index') }}" class="nav-link {{ set_active_route('partenaires.index') }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Partenaires</p>
                            </a>
                        </li>

                            <li class="nav-item ">
                                <a href="{{ route('objectif-specifiques.index') }}"
                                    class="nav-link {{ set_active_route('objectif-specifiques.index') }}">
                                    <i class="far fa-circle nav-icon text-success"></i>
                                    <p>Objectifs Spécifiques</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{ route('type-documents.index') }}"
                                    class="nav-link {{ set_active_route('type-documents.index') }}">
                                    <i class="far fa-circle nav-icon text-info"></i>
                                    <p>Types Documents</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{ route('typepartenaires.index') }}"
                                    class="nav-link {{ set_active_route('typepartenaires.index') }}">
                                    <i class="far fa-circle nav-icon text-primary"></i>
                                    <p>Types Partenaires</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('domaines.index') }}"
                                    class="nav-link {{ set_active_route('domaines.index') }}">
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    <p>Domaines</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('secteurs.index') }}"
                                    class="nav-link {{ set_active_route('secteurs.index') }}">
                                    <i class="far fa-circle nav-icon text-orange"></i>
                                    <p>Secteurs</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('paroisses.index') }}"
                                    class="nav-link {{ set_active_route('paroisses.index') }}">
                                    <i class="far fa-circle nav-icon text-success"></i>
                                    <p>Paroisses</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('villages.index') }}"
                                    class="nav-link {{ set_active_route('villages.index') }}">
                                    <i class="far fa-circle nav-icon text-primary"></i>
                                    <p>Villages</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('communes.index') }}"
                                    class="nav-link {{ set_active_route('communes.index') }}">
                                    <i class="far fa-circle nav-icon text-danger"></i>
                                    <p>Communes</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('provinces.index') }}"
                                    class="nav-link {{ set_active_route('provinces.index') }}">
                                    <i class="far fa-circle nav-icon text-info"></i>
                                    <p>Provinces</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('regions.index') }}"
                                    class="nav-link {{ set_active_route('regions.index') }}">
                                    <i class="far fa-circle nav-icon text-success"></i>
                                    <p>Régions</p>
                                </a>
                            </li>

                    </ul>
                </li>
                @endcan
                @can('admin')
                <li class="nav-item ">
                    <a href="{{ route('home') }}" class="nav-link {{ set_active_route('restaurer-projet-previsionnel.index') }} {{ set_active_route('restaurer-projet.index') }}">
                        <img class="nav-icon" src="{{ asset('img/icons/provenance.ico') }}" />
                        <p>
                            Restauration
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('restaurer-projet.index') }}" class="nav-link {{ set_active_route('restaurer-projet.index') }}">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>Projets</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('restaurer-projet-previsionnel.index') }}" class="nav-link {{ set_active_route('restaurer-projet-previsionnel.index') }}">
                                <i class="far fa-circle nav-icon text-danger "></i>
                                <p>Projets Prévisonnels</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('projet-history.index') }}" class="nav-link {{ set_active_route('projet-history.index') }}">
                        <img class="nav-icon" src="{{ asset('img/icons/journalsuivi.ico') }}" />
                        <p>
                            Historique
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('configs.index') }}" class="nav-link {{ set_active_route('configs.index') }}">
                        <img class="nav-icon" src="{{ asset('img/icons/parametre1.ico') }}" />
                        <p>
                            Configuration
                        </p>
                    </a>
                </li>

                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
