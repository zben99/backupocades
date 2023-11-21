@extends('layouts.auth-master')

@section('title')
Connexion
@endsection

@section('styles')
<link href="assets/css/style.css" rel="stylesheet">
<link href="assets/css/custom.css" rel="stylesheet">
@endsection

@section('content')
<section class="text-center py-0">
    <div class="background-holder overlay overlay-2" style="background-image:url(img/bg2.jpg);">
    </div>
    <!--/.background-holder-->
    <div class="container">
        <div class="row h-full align-items-center">
            <div class="col-md-8 col-lg-5 mx-auto" data-zanim-timeline="{}" data-zanim-trigger="scroll">


                <div class="background-white radius-secondary p-4 p-md-5 mt-5" data-zanim='{"delay":0.1}'>
                    <div data-zanim='{"delay":0}'><a href="{{ route('index') }}"><img src="{{ asset('logo/'.\App\Models\Config::first()->logo) }}" width="150" alt="Image" /></a>
                    </div><br>
                    <form class="text-left mt-4" method="post" action="{{ route('login') }}">
                        @csrf

                        @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <span><i class="fas fa-info-circle"></i>{{ ' '.session('success') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="input-group">
                                    <input class="form-control"
                                    type="username" placeholder="nom d'utilisateur"
                                    aria-label="Zone de saisie du pseudo" name="username" id="username" required autofocus value="{{old('username')}}"/>
                                </div>
                            </div>
                            <div class="col-12 mt-2 mt-sm-4">
                                <div class="input-group" id="show_hide_password">
                                    <input class="form-control" type="password" value="{{old('password')}}" placeholder="Mot de passe" aria-label="Zone de saisie du mot de passe" name="password" required/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-12 mt-2 mt-sm-3"><button class="btn btn-primary btn-block"
                                type="submit">Se connecter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass( "fa-eye-slash" );
                $('#show_hide_password i').removeClass( "fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass( "fa-eye-slash" );
                $('#show_hide_password i').addClass( "fa-eye" );
            }
        });
    });


</script>
@endsection
