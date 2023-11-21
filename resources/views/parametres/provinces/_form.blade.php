
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Région <span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="region" name="region_id">
            <option   value="">Choisir...</option>
            @foreach ($regions as $region)
                    <option value="{{ $region['id'] }}">{{ $region['nom'] }}</option>
            @endforeach
            </select>
            <span id="regionError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="province" class="">Nom <span class="text-danger">*</span></label>
            <div class="">
                <input type="text" autocomplete="off" value="" class="form-control" id="province" name="province" placeholder="Entrez le province">
                <span id="provinceError" class="alert-message text-danger"></span>
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

