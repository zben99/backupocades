<div>
    @if(session()->has('erreur'))
        <div class="alert alert-warning" role="alert">
            <span><i class="fas fa-exclamation-triangle"></i>{{ ' '.session('erreur') }}</span>
        </div>
    @endif
    <form action="" wire:submit.prevent='updateProfil' method="POST">
        @csrf
        @method('PATCH')
        @include('auth._profil_form')
        <div class="form-group">
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-primary mx-auto btn-block ">Modifier</button>
            </div>
        </div>
    </form>
</div>
