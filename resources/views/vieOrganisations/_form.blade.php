<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="type">Type de document <span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="type_document_id" name="type_document_id">
                <option value="">Choisir...</option>
                @foreach ($types as $type)
                <option value="{{ $type['id'] }}">{{ $type['libelle'] }}</option>
                @endforeach
            </select>
            <span id="typeError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="nom" class="">Titre <span class=" text-danger">*</span></label>
            <div class="">
                <textarea type="text" autocomplete="off" rows="1" class="form-control" id="nom" name="nom" placeholder="Entrez le nom"></textarea>
                <span id="nomError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="nb" class="">Nb pages</label>
            <div class="">
                <input type=" number" autocomplete="off" value="" class="form-control" id="nb" name="nb" placeholder="">
                <span id="nbError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <label for="auteur" class="">Auteur <span class=" text-danger">*</span></label>
            <div class="">
                <input type=" text" autocomplete="off" class="form-control" id="auteur" name="auteur" placeholder="Entrez l'auteur"></input>
                <span id="auteurError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="name" class="">Résumé/Description<span class=" text-danger">*</span></label>
            <div class="">
                <textarea class=" form-control" id="resume" rows="3" placeholder="entrez le résumé du document" autocomplete="off" name="resume"></textarea>
                <span id="resumeError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="logo" class="">Photo Couverture</label>
            <div class="">
                <img src="" alt="Pas de logo" id="imageId">
                <input type="file" name="logo" id="logo" />
            </div>
            <span id="logoError" class="alert-message text-danger"></span>
        </div>
    </div>


</div>
