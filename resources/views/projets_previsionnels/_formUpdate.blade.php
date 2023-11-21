<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="name">Programme <span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="programEdit" name="program_id">
                <option value="">Choisir...</option>
                @can('manage-users')
                    @foreach ($programs as $program)
                    <option value="{{ $program['id'] }}">{{ $program['nom'] }}</option>
                    @endforeach
                @endcan
                @cannot('manage-users')
                    @foreach ($programs as $program)
                        @if(Auth::user()->id==$program->agent)
                        <option value="{{ $program['id'] }}">{{ $program['nom'] }}</option>
                        @endif
                    @endforeach
                @endcannot
            </select>
            <span id="programEditError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="nomEdit" class="">Projet prévisionnel <span class="text-danger">*</span></label>
            <div class="">
                <input type="text" autocomplete="off" value="" class="form-control" id="nomEdit" name="nom" placeholder="Entrez le nom">
                <span id="nomEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="montantEdit" class="">Montant </label>
            <div class="">
                <input type="number" min="0" autocomplete="off" value="" class="form-control" id="montantEdit" name="montant" placeholder="Entrez le montant">
                <span id="montantEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="objEdit" class="">Objectif Principal/Impact<span class="text-danger">*</span></label>
            <div class="">
                <textarea name="objectGeneral" maxlength="200" class="form-control" placeholder=" votre objectif général ici" id="objEdit" cols="30" rows="4"></textarea>
                <span id="objEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="resEdit" class="">Résultat(s) / Produit(s)</label>
            <div class="">
                <textarea name="resultatAttendu" maxlength="200" class="form-control" placeholder="resultat attendu ici" id="resEdit" cols="30" rows="4"></textarea>
                <span id="resEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>




<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="partsEdit">Partenaire (s)</label>
            <select class="form-control select2" multiple="multiple" style="width: 100%;" id="partsEdit" name="parts[]">
                @foreach ($partenaires as $partenaire)
                <option value="{{ $partenaire['id'] }}">{{ $partenaire['nom'] }}
                    ({{ $partenaire->typepartenaire->libelle }})</option>
                @endforeach
            </select>
            <span id="partsEditError" class="alert-message text-danger"></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="debutEdit" class="">Date Début </label>
            <div class="input-group date">
                <input type="date" class="form-control" autocomplete="off" name="debut" id="debutEdit">
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            <span id="debutEditError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="finEdit" class="">Date Fin </label>
            <div class="input-group date">
                <input type="date" class="form-control" autocomplete="off" name="fin" id="finEdit">
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            <span id="finEditError" class="alert-message text-danger"></span>
        </div>
    </div>
</div>
