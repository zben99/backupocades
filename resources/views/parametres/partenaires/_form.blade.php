
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Type de partenaire <span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="typepartenaire" name="typepartenaire_id">
            <option   value="">Choisir...</option>
            @foreach ($typepartenaires as $typepartenaire)
                    <option value="{{ $typepartenaire['id'] }}">{{ $typepartenaire['libelle'] }}</option>
            @endforeach
            </select>
            <span id="typepartenaireError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="nom" class="">Nom <span class="text-danger">*</span></label>
            <div class="">
                <input type="text" autocomplete="off" value="" class="form-control" id="nom" name="nom" placeholder="Entrez le partenaire">
                <span id="nomError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="telephone" class="">Téléphone</label>
            <div class="">
                <input type="text" autocomplete="off" value="" class="form-control" id="telephone" name="telephone" placeholder="Entrez le numéro de téléphone du partenaire">
                <span id="telephoneError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="email" class="">Email </label>
            <div class="">
                <input type="email" autocomplete="off" value="" class="form-control" id="email" name="email" placeholder="Entrez l'email du partenaire">
                <span id="emailError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="adresse" class="">Adresse</label>
            <div class="">
                <input type="text" autocomplete="off" value="" class="form-control" id="adresse" name="adresse" placeholder="Entrez l'adresse du partenaire">
                <span id="adresseError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="desc" class="">Description</label>
            <div class="">
                <textarea name="description" maxlength="200" class="form-control"  placeholder="description ici" id="desc" cols="30" rows="4"></textarea>
                <span id="descError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>

