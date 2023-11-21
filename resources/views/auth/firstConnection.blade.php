@extends('layouts.auth-master')

@section('title')
Profil
@endsection


@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row my-2">
      </div>
    </div><!-- /.container-fluid -->
  </section>


<div class="container mt-auto">
    <div class="row justify-content-center">
        <div class="mt-3 mr-4">
            <img src="{{asset('img/portail3.jpg')}}" style="border-radius:20px;" width="75" height="60" class="d-inline-block align-top" alt="">
        </div>
        <div class="text-center font-weight-lighter mt-3">
            <h2>PORTAIL DE SECURITE</h2>
        </div>
    </div>
    <hr>
    <div class="alert alert-info" role="alert">
        <span><i class="fas fa-info-circle"></i>Bienvenue {{$user->name}} {{$user->forname}}, Veuillez modifier vôtre mot de passe avant toute utilisation de l'application.</span>

    </div>
<div class="row justify-content-center">
    <!-- Profile Image -->
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" style="width: 150px; height: 150px;"
                    src="/telechargements/avatars/{{ $user->avatar }}"
                            alt="Photo Profil">
                </div>

            <h3 class="profile-username text-center">{{$user->name}} {{ $user->forname }}</h3>

                <p class="text-muted text-center">{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Nom d'utilisateur</b> <a class="float-right">{{$user->username}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Direction</b> <a class="float-right">{{ getUserDirection($user->code_dir) }}</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card card-primary mx-auto  ">
            <div class="card-header">
                <h5>Modification Identifiants</h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @livewire('profil.profil-update',['user'=>$user])
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


@endsection
