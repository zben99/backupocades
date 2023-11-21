<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="name">Programme <span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="program" name="program_id">
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
            <span id="programError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="nom" class="">Projet prévisionnel <span class="text-danger">*</span></label>
            <div class="">
                <input type="text" autocomplete="off" value="" class="form-control" id="nom" name="nom" placeholder="Entrez le nom">
                <span id="nomError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="montant" class="">Montant </label>
            <div class="">
                <input type="number" min="0" autocomplete="off" value="0" class="form-control" id="montant" name="montant" placeholder="Entrez le montant">
                <span id="montantError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="obj" class="">Objectif Principal/ Impact <span class="text-danger">*</span></label>
            <div class="">
                <textarea name="objectGeneral" maxlength="200" class="form-control" placeholder=" votre objectif général ici" id="obj" cols="30" rows="4"></textarea>
                <span id="objError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="res" class="">Résultat(s) / Produit(s)<span class="text-danger">*</span></label>
            <div class="">
                <textarea name="resultatAttendu" maxlength="200" class="form-control" placeholder="resultat attendu ici" id="res" cols="30" rows="4"></textarea>
                <span id="resError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="parts">Partenaire (s) <span class="text-danger">*</span></label>
            <select class="form-control select2" multiple="multiple" style="width: 100%;" id="parts" name="parts[]">
                @foreach ($partenaires as $partenaire)
                <option value="{{ $partenaire['id'] }}">{{ $partenaire['nom'] }}
                    ({{ $partenaire->typepartenaire->libelle }})</option>
                @endforeach
            </select>
            <span id="partsError" class="alert-message text-danger"></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="debut" class="">Date Début <span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control" autocomplete="off" name="debut" id="debut">
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            <span id="debutError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="fin" class="">Date Fin <span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control" autocomplete="off" name="fin" id="fin">
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            <span id="finError" class="alert-message text-danger"></span>
        </div>
    </div>
</div>
