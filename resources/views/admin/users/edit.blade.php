@extends('layouts.app',['title'=>'Utilisateurs'])

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row my-4">
      </div>
    </div><!-- /.container-fluid -->
  </section>

<div class="card card-primary mx-auto col-md-11 shadow border-bottom-secondary">
    <div class="card-header">
      <h3 class="card-title">Modification Utilisateur</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @livewire('usersupdate', ['user' => $user])
    </div>
  </div>

@endsection
