<div>
    <form action="" wire:submit.prevent='updateUser' method="POST">
        @csrf
        @include('admin.users._formUpdate')
        <div class="form-group">
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-primary mx-auto col-md-5">Modifier</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mx-auto btn-block col-md-5">Annuler</a>
            </div>

        </div>

    </form>
</div>
