<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="projet">Projet Prévisionnel <span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="projet" name="projet">
                <option value="">Choisir...</option>
                @can('manage-users')
                    @foreach ($projets as $projet)
                    <option value="{{ $projet['id'] }}">{{ $projet['nom'] }}</option>
                    @endforeach
                @endcan
                @cannot('manage-users')
                    @foreach ($projets as $projet)
                        @if($projet->agent == Auth::user()->id)
                            <option value="{{ $projet['id'] }}">{{ $projet['nom'] }}</option>
                        @endif
                    @endforeach
                @endcannot
            </select>
            <span id="projetError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="type_beneficiaire">Type Beneficiaire </label>
            <div class="">
                <input type="text" autocomplete="off" value="" class="form-control" id="type_beneficiaire" name="type_beneficiaire" placeholder="Entrez le type de beneficiaire">
                <span id="type_beneficiaireError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="libelle" class="">Activité prévisionnelle <span class="text-danger">*</span></label>
            <div class="">
                <textarea name="libelle" class="form-control" placeholder=" libelle de l'activité içi" id="libelle" cols="30" rows="2"></textarea>
                <span id="libelleError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="spec">Objectif Spécifique(s) / Effet <span class="text-danger">*</span></label>
            <select class="form-control select2" multiple="multiple" style="width: 100%;" id="spec" name="objectSpecifique[]">
                @foreach ($objectifs as $objectif)
                <option value="{{ $objectif['id'] }}">{{ $objectif['nom'] }}</option>
                @endforeach
            </select>
            <span id="specError" class="alert-message text-danger"></span>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-4">
        <div class="form-group">
            <label for="quantite" class="">Quantité <span class="text-danger">*</span></label>
            <div class="">
                <input type="number" autocomplete="off" value="" class="form-control" id="quantite" name="quantite" placeholder="Entrez le quantite">
                <span id="quantiteError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="cout" class="">Coût </label>
            <div class="">
                <input type="number" autocomplete="off" value="" class="form-control" id="cout" name="cout" placeholder="Entrez le cout">
                <span id="coutError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="debut" class="">Date Réalisation <span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control" autocomplete="off" name="debut" id="debut">
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            <span id="debutError" class="alert-message text-danger"></span>
        </div>
    </div>


</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="region_id">Region <span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="region" name="region_id">
                <option value="">Choisir...</option>
                @foreach ($regions as $region)
                <option value="{{ $region['id'] }}">{{ $region['nom'] }}</option>
                @endforeach
            </select>
            <span id="regionError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="commune_id">Commune <span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="commune" name="commune_id[]" multiple="multiple">
                <option value="">Choisir...</option>
                @foreach ($communes as $commune)
                <option value="{{ $commune['id'] }}">{{ $commune['commune'] }}</option>
                @endforeach
            </select>
            <span id="communeError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="village_id">Village <span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="village" name="village_id[]" multiple="multiple">
                <option value="">Choisir...</option>
                @foreach ($villages as $village)
                <option value="{{ $village['id'] }}">{{ $village['village'] }}</option>
                @endforeach
            </select>
            <span id="villageError" class="alert-message text-danger"></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="paroisse_id">Paroisse <span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="paroisse" name="paroisse_id[]" multiple="multiple">
                <option value="">Choisir...</option>
                @foreach ($paroisses as $paroisse)
                <option value="{{ $paroisse['id'] }}">{{ $paroisse['paroisse'] }}</option>
                @endforeach
            </select>
            <span id="paroisseError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="domaine_id">Domaine <span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="domaine" name="domaine_id" multiple="multiple">
                <option value="">Choisir...</option>
                @foreach ($domaines as $domaine)
                <option value="{{ $domaine['id'] }}">{{ $domaine['domaine'] }}</option>
                @endforeach
            </select>
            <span id="domaineError" class="alert-message text-danger"></span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="unite_physique" class="___class_+?27___">Unité physique <span class="text-danger">*</span></label>
            <div class="___class_+?29___">
                <input type="text" autocomplete="off" value="" class="form-control" id="unite_physique" name="unite_physique" placeholder="Entrez l'unité physique">
                <span id="unite_physiqueError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>

<div class="row">




    <div class="col-md-4">
        <div class="form-group">
            <label for="contrib_beneficiaire" class="___class_+?41___">Contribution beneficiaire<span class="text-danger">*</span></label>
            <div class="___class_+?43___">
                <input type="text" autocomplete="off" value="" class="form-control" id="contrib_beneficiaire" name="contrib_beneficiaire" placeholder="Entrez le contribution des beneficiaire">
                <span id="contrib_beneficiaireError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="bene_d_homme" class="___class_+?56___">Nombre de beneficiaires homme </label>
            <div class="___class_+?58___">
                <input type="text" autocomplete="off" value="" class="form-control" id="bene_d_homme" name="bene_d_homme" placeholder="Entrez le nombre de beneficiaires homme">
                <span id="bene_d_hommeError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="bene_d_femme" class="___class_+?63___">Nombre de beneficiaires femme </label>
            <div class="___class_+?65___">
                <input type="text" autocomplete="off" value="" class="form-control" id="bene_d_femme" name="bene_d_femme" placeholder="Entrez le nombre de beneficiaires femme">
                <span id="bene_d_femmeError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>

<div class="row">


    <div class="col-md-12">
        <div class="form-group">
            <label for="observation" class="___class_+?49___">Obervation </label>
            <div class="___class_+?51___">
                <input type="text" autocomplete="off" value="" class="form-control" id="observation" name="observation" placeholder="Observation">
                <span id="observationError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>

<hr />
<div class="row">
    <label>Liste des autres indicateurs </label>
    <label></label>
    <a href="#"><span id="addI" class="___class_+?70___"><img class="nav-icon" src="{{ asset('img/icons/plus.png') }}" /></span></a>
    <div class="table-responsive" id="indicateurs">
        <div class="table-responsive">
            <table class=" display table table-striped table-bordered" id="dynamic_fieldI" style="margin:11px">
                <thead>
                    <tr>
                        <th>Indicateur</th>
                        <th>Type</th>
                        <th>Valeur</th>
                        <th style="width:10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div>
            <span id="indicateurError" class="alert-message text-danger"></span>

        </div>
    </div>
</div>
<hr />
<div class="row">
    <label>Liste des partenaires <span class="text-danger">*</span></label>
    <label></label>
    <a href="#"><span id="add" class="___class_+?70___"><img class="nav-icon" src="{{ asset('img/icons/plus.png') }}" /></span></a>
    <div class="table-responsive" id="partenaires">
        <div class="table-responsive">
            <table class=" display table table-striped table-bordered" id="dynamic_field" style="margin:11px">
                <thead>
                    <tr>
                        <th>Partenaire</th>
                        <th>Montant</th>
                        <th style="width: 40%;">Description</th>
                        <th style="width:10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div>
            <span id="partenaireError" class="alert-message text-danger"></span>

        </div>
    </div>
</div>
