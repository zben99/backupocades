
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Paroisse <span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="paroisseEdit" name="paroisse_id">
            <option   value="">Choisir...</option>
            @foreach ($paroisses as $paroisse)
                    <option value="{{ $paroisse['id'] }}">{{ $paroisse['paroisse'] }}</option>
            @endforeach
            </select>
            <span id="paroisseEditError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="village" class="">Nom <span class="text-danger">*</span></label>
            <div class="">
                <input type="text" autocomplete="off" class="form-control" id="villageEdit" name="village" placeholder="Entrez le village">
                <span id="villageEditError" class="alert-message text-danger"></span>
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
