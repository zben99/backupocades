<div>
    @if(session()->has('erreur') && $password!='')
            <div class="alert alert-warning" role="alert">
                <span><i class="fas fa-exclamation-triangle"></i>{{ ' '.session('erreur') }}</span>
            </div>
        @endif
    <form action="" wire:submit.prevent="store" method="POST">
        @csrf
        @include('admin.users._form')
        <div class="form-group">
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-primary mx-auto col-md-5">Ajouter</button>
                <button type="reset" class="btn btn-secondary mx-auto  col-md-5">Effacer</button>
            </div>

        </div>

    </form>
</div>
