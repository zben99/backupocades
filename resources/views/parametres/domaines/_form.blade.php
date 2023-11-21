
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Secteur</label>
            <select class="form-control select2" style="width: 100%;" id="secteur" name="secteur_id">
            <option   value="">Choisir...</option>
            @foreach ($secteurs as $secteur)
                    <option value="{{ $secteur['id'] }}">{{ $secteur['nom'] }}</option>
            @endforeach
            </select>
            <span id="secteurError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="domaine" class="">Nom <span class="text-danger">*</span></label>
            <div class="">
                <input type="text" autocomplete="off" value="" class="form-control" id="domaine" name="domaine" placeholder="Entrez le domaine">
                <span id="domaineError" class="alert-message text-danger"></span>
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

