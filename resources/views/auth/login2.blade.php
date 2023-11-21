@extends('layouts.login_default',['title'=>'Connexion'])

@section('content')

<div class="container mt-auto">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9 mt-2">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <span><i class="fas fa-info-circle"></i>{{ ' '.session('success') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
            @endif
            <div class="card o-hidden border-0 shadow-lg mt-5">
                <div class="card-body p-0">
                    <div class="col-lg-12">
                        <div class="row justify-content-center">
                            <div class="mt-3 mr-4">
                                <img src="img/yam.png" width="75" height="60" class="d-inline-block align-top" alt="">
                            </div>
                            <div class="text-center font-weight-lighter mt-3">
                                <h2>GESTION DE PROJETS</h2>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 d-none mt-3 d-lg-block">
                                <img src="/img/proj5.jpg" class="ml-2 img-fluid" alt="image projets">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">{{ __('CONNEXION') }}</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('login') }}" novalidate>
                                        @csrf
                                        @if ($errors->any())
                                            <div class="alert alert-warning" role="alert">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror" value="{{ old('username') ?? '' }}" autocomplete="off" placeholder="Utilisateur" name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" value="{{ old('password')?? '' }}" placeholder="Mot de passe" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-secondary btn-user btn-block">
                                                {{ __('Se connecter') }}
                                            </button>
                                        </div>
                                    </form>
                                    <div class="ml-5 mt-3">
                                        {{-- <img class="ml-2" src="{{ asset('img/ocades.gif') }}" width="100" height="100" class="d-inline-block " alt="Logo ocades"> --}}
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 @endsection
