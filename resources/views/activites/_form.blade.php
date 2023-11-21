<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="activite_previsionnelle_id">Activité prévisionnelle<span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="activite_previsionnelle" name="activite_previsionnelle_id">
                <option value="">Choisir...</option>

                @can('manage-users')
                    @foreach ($activiteprevisionnelles as $activiteprevisionnelle)
                    <option value="{{ $activiteprevisionnelle['id'] }}">{{ $activiteprevisionnelle['libelle'] }}
                    </option>
                    @endforeach
                @endcan
                @cannot('manage-users')
                    @foreach ($activiteprevisionnelles as $activiteprevisionnelle)
                        @if($activiteprevisionnelle->agent == Auth::user()->id)
                            <option value="{{ $activiteprevisionnelle['id'] }}">{{ $activiteprevisionnelle['libelle'] }}
                            </option>
                        @endif
                    @endforeach
                @endcannot
            </select>
            <span id="activiteprevisionnelleError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="projet1">Projet Prévisionnel </label>
            <div class="">
                <input readonly type="text" autocomplete="off" value="" class="form-control" id="projet1" name="projet" placeholder="">
                <span id="projetError" class="alert-message text-danger"></span>
            </div>
        </div>

    </div>

</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="spec" class="">Objectif Spécifique / Effet <span class="text-danger">*</span></label>
            <div class="">
                <textarea readonly name="objectSpecifique" class="form-control" placeholder="" id="spec" cols="30" rows="2"></textarea>
                <span id="specError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="quantite" class="">Quantité</label>
            <div class="">
                <input readonly type="text" autocomplete="off" value="" class="form-control" id="quantite" name="quantite" placeholder="Entrez le quantite">
                <span id="quantiteError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="cout" class="">Coût </label>
            <div class="">
                <input readonly type="text" autocomplete="off" value="" class="form-control" id="cout" name="cout" placeholder="Entrez le cout">
                <span id="coutError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="libelle" class="___class_+?8___">Activité réalisée</label>
            <div class="___class_+?10___">
                <input type="text" autocomplete="off" value="" class="form-control" id="libelle" name="libelle" placeholder="Entrez le libelle">
                <span id="libelleError" class="alert-message text-danger"></span>
            </div>
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
    <div class="col-md-4">
        <div class="form-group">
            <label for="paroisse_id">Paroisse<span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="paroisse" name="paroisse_id">
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
            <label for="domaine_id">Domaine<span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="domaine" name="domaine_id">
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
            <label for="unite_physique" class="___class_+?27___">Unité physique <span class="text-danger">*</span></label>
            <div class="___class_+?29___">
                <input type="text" autocomplete="off" value="" class="form-control" id="unite_physique" name="unite_physique" placeholder="Entrez l'unité physique">
                <span id="unite_physiqueError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="quantite_realise" class="___class_+?34___">Quantité realisée <span class="text-danger">*</span></label>
            <div class="___class_+?36___">
                <input type="text" autocomplete="off" value="" class="form-control" id="quantite_realise" name="quantite_realise" placeholder="Entrez le quantité realisée">
                <span id="quantite_realiseError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="contrib_beneficiaire" class="___class_+?41___">Contribution beneficiaire<span class="text-danger">*</span></label>
            <div class="___class_+?43___">
                <input type="text" autocomplete="off" value="" class="form-control" id="contrib_beneficiaire" name="contrib_beneficiaire" placeholder="Entrez le contribution des beneficiaire">
                <span id="contrib_beneficiaireError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="cout_total_realisation" class="___class_+?49___">Coût total de la réalisation <span class="text-danger">*</span></label>
            <div class="___class_+?51___">
                <input type="text" autocomplete="off" value="" class="form-control" id="cout_total_realisation" name="cout_total_realisation" placeholder="Entrez le coût total de la réalisation">
                <span id="cout_total_realisationError" class="alert-message text-danger"></span>
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
<hr />
<div class="row">
    <label>Liste des documents</label>
    <a href="#"><span id="addD" class="___class_+?76___"><img class="nav-icon" src="{{ asset('img/icons/plus.png') }}" /></span></a>
    <div class="table-responsive">
        <div class="table-responsive">
            <table class=" display table table-striped table-bordered" id="dynamic_fieldD" style="margin:11px">
                <thead>
                    <tr>
                        <th>Document</th>
                        <th style="width:10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div>
            <span id="documentError" class="alert-message text-danger"></span>

        </div>
    </div>
</div>
