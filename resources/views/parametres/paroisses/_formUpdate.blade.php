
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Commune <span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="communeEdit" name="commune_id">
            <option   value="">Choisir...</option>
            @foreach ($communes as $commune)
                    <option value="{{ $commune['id'] }}">{{ $commune['commune'] }}</option>
            @endforeach
            </select>
            <span id="communeEditError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="paroisse" class="">Nom <span class="text-danger">*</span></label>
            <div class="">
                <input type="text" autocomplete="off" class="form-control" id="paroisseEdit" name="paroisse" placeholder="Entrez le paroisse">
                <span id="paroisseEditError" class="alert-message text-danger"></span>
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
