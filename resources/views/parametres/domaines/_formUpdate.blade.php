
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="secteur_id">Secteur <span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="secteurEdit" name="secteur_id">
            <option   value="">Choisir...</option>
            @foreach ($secteurs as $secteur)
                    <option value="{{ $secteur['id'] }}">{{ $secteur['nom'] }}</option>
            @endforeach
            </select>
            <span id="secteurEditError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="domaine" class="">Nom <span class="text-danger">*</span></label>
            <div class="">
                <input type="text" autocomplete="off" class="form-control" id="domaineEdit" name="domaine" placeholder="Entrez le domaine">
                <span id="domaineEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="descEdit" class="">Description</label>
            <div class="">
                <textarea name="description" maxlength="200" class="form-control"  placeholder="description ici" id="descEdit" cols="30" rows="4"></textarea>
                <span id="descEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>
