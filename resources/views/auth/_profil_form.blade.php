<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="username">Login/Nom Utilisateur <span class="text-danger">*</span></label>
            <input id="username" type="text" wire:model='username' class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  autocomplete="off">
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
              <label for="password"> Nouveau Mot de passe <span class="text-danger">*</span></label>
              <input id="password" type="password" wire:model='password' class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" >
              @error('password')
                  <span class="invalid-feedback" role="alert">
                   <strong>{{ 'Le mot de passe doit être composé d\'au moins 10 caractères avec au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial'  }}</strong>
                  </span>
              @enderror
        </div>
      </div>
</div>
<div class="row">
    <!-- form-group -->
    <div class="col-md-12">
       <div class="form-group">
           <label for="confirm">Confirmer le Mot de passe <span class="text-danger">*</span></label>
           <input id="confirm" type="password" wire:model.lazy='confirm' class="form-control @error('confirm') is-invalid @enderror" name="confirm" value="{{ old('confirm') }}" >
           @error('confirm')
               <span class="invalid-feedback" role="alert">
                   <strong>{{ 'veuillez confirmer le mot de passe'  }}</strong>
               </span>
           @enderror
       </div>
   </div>
</div>
</div>
