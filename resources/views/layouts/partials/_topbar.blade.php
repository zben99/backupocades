<!-- Navbar -->
<nav class="main-header navbar navbar-expand  navbar-primary ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i
                    class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link text-white">Accueil</a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        @if (set_active_route('recherche.index') != 'active')
            <a href="{{ route('recherche.index') }}" role="button">
                <button class="btn btn-navbar text-white" type="submit">
                    <i class="fas fa-search"></i>
                    Rechercher
                </button>
            </a>
        @endif

        <!-- Nav Item - Informations sur l'utilisateur-->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle text-white " href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-white small">{{ Auth::user()->username }} </span>
            </a>
            <!-- Menu déroulant | infos user-->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('profil.index') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Déconnexion
                </a>
            </div>
        </li>

    </ul>
</nav>
<!-- /.navbar -->


<!-- Modal de deconnexion -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bgcustom-gradient-light">
            <div class="modal-header">
                <img src="{{ asset('img/logout.svg') }}" width="60" height="45" class="d-inline-block align-top"
                    alt="">
                <h5 class="modal-title m-auto">Confirmation de Déconnexion</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Attention vos informations non enregistrés seront perdus! Voullez-vous vraiment
                quitter?</div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Retour</button>
                <a class="btn btn-warning" href="{{ route('logout') }}" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                    {{ __('Oui, Quitter') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
