@extends('layouts.app',['title'=>'Profil'])

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row my-2">
      </div>
    </div><!-- /.container-fluid -->
  </section>
@if(session()->has('success'))
  <div class="alert alert-success" role="alert">
      <span><i class="fas fa-info-circle"></i>{{ ' '.session('success') }}</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
@endif
<div class="row">
    <!-- Profile Image -->
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center" data-toggle="modal" data-target="#photo">
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
        <div class="card card-primary mx-auto shadow border-bottom-secondary">
            <div class="card-header">
              <h3 class="card-title">Modification Identifiants</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @livewire('profil.profil-update',['user'=>$user])
            </div>
          </div>
    </div>
</div>


<div class="modal fade" id="photo" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-gradient-primary">
            <img src="/telechargements/avatars/{{ $user->avatar }}" width="60" height="45" class="d-inline-block align-top" alt="">
          <h5 class="modal-title m-auto">MODIFICATION PHOTO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row col-10 m-auto">
            {{-- <img src="/telechargements/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;"> --}}

            <form enctype="multipart/form-data" action="{{ route('photo.store') }}" method="POST">
                @csrf
                <input type="hidden" name="code_user" value="{{ $user->id }}">
                        <input type="file" name="avatar">

                <div class="modal-footer">
                    <button type="submit" class="btn  btn-primary">Modifier</button>
                </div>
            </form>
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
