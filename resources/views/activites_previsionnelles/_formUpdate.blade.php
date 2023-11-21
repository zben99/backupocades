<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="projetEdit">Projet Prévisionnel <span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="projetEdit" name="projet">
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
            <span id="projetEditError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="type_beneficiaire">Type Beneficiaire</label>
            <input type="text" autocomplete="off" class="form-control" id="type_beneficiaireEdit" name="type_beneficiaire" placeholder="Entrez le type Beneficiaire">
            <span id="type_beneficiaireEditError" class="alert-message text-danger"></span>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="libelleEdit" class="">Activité prévisionnelle <span class="text-danger">*</span></label>
            <div class="">
                <textarea name="libelle" class="form-control" placeholder=" libelle de l'activité içi" id="libelleEdit" cols="30" rows="2"></textarea>
                <span id="libelleEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="specEdit">Objectif Spécifique(s) / Effet(s)<span class="text-danger">*</span></label>
            <select class="form-control select2" multiple="multiple" style="width: 100%;" id="specEdit" name="objectSpecifique[]">
                @foreach ($objectifs as $objectif)
                <option value="{{ $objectif['id'] }}">{{ $objectif['nom'] }}</option>
                @endforeach
            </select>
            <span id="specEditError" class="alert-message text-danger"></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="quantiteEdit" class="">Quantité <span class="text-danger">*</span></label>
            <div class="">
                <input type="number" autocomplete="off" value="" class="form-control" id="quantiteEdit" name="quantite" placeholder="Entrez le quantite">
                <span id="quantiteEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="coutEdit" class="">Coût </label>
            <div class="">
                <input type="number" autocomplete="off" value="" class="form-control" id="coutEdit" name="cout" placeholder="Entrez le cout">
                <span id="coutEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="debutEdit" class="">Date Réalisation </label>
            <div class="input-group date">
                <input type="date" class="form-control" autocomplete="off" name="debut" id="debutEdit">
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            <span id="debutEditError" class="alert-message text-danger"></span>
        </div>
    </div>


</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="region_id">Region<span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="regionEdit" name="region_id">
                @foreach ($regions as $region)
                <option value="{{ $region['id'] }}">{{ $region['nom'] }}</option>
                @endforeach
            </select>
            <span id="regionEditError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="commune_id">Commune(s)</label>
            <select class="form-control select2" style="width: 100%;" id="communeEdit" name="commune_id[]" multiple="multiple">
                @foreach ($communes as $commune)
                <option value="{{ $commune['id'] }}">{{ $commune['commune'] }}</option>
                @endforeach
            </select>
            <span id="communeEditError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="village_id">Village(s)</label>
            <select class="form-control select2" style="width: 100%;" id="villageEdit" name="village_id[]" multiple="multiple">
                @foreach ($villages as $village)
                <option value="{{ $village['id'] }}">{{ $village['village'] }}</option>
                @endforeach
            </select>
            <span id="villageEditError" class="alert-message text-danger"></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="paroisse_id">Paroisse(s)</label>
            <select class="form-control select2" style="width: 100%;" id="paroisseEdit" name="paroisse_id[]" multiple="multiple">
                @foreach ($paroisses as $paroisse)
                <option value="{{ $paroisse['id'] }}">{{ $paroisse['paroisse'] }}</option>
                @endforeach
            </select>
            <span id="paroisseEditError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="domaine_id">Domaine</label>
            <select class="form-control select2" style="width: 100%;" id="domaineEdit" name="domaine_id">
                @foreach ($domaines as $domaine)
                <option value="{{ $domaine['id'] }}">{{ $domaine['domaine'] }}</option>
                @endforeach
            </select>
            <span id="domaineEditError" class="alert-message text-danger"></span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="unite_physique" class="___class_+?25___">Unité physique <span class="text-danger">*</span></label>
            <div class="___class_+?27___">
                <input type="text" autocomplete="off" value="" class="form-control" id="unite_physiqueEdit" name="unite_physique" placeholder="Entrez l'unité physique">
                <span id="unite_physiqueEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>

<div class="row">


    <div class="col-md-4">
        <div class="form-group">
            <label for="contrib_beneficiaire" class="___class_+?39___">Contribution beneficiaire<span class="text-danger">*</span></label>
            <div class="___class_+?41___">
                <input type="text" autocomplete="off" value="" class="form-control" id="contrib_beneficiaireEdit" name="contrib_beneficiaire" placeholder="Entrez le contribution des beneficiaire">
                <span id="contrib_beneficiaireEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="bene_d_homme" class="___class_+?54___">Nombre de beneficiaires homme </label>
            <div class="___class_+?56___">
                <input type="text" autocomplete="off" value="" class="form-control" id="bene_d_hommeEdit" name="bene_d_homme" placeholder="Entrez le nombre de beneficiaires homme">
                <span id="bene_d_hommeEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="bene_d_femme" class="___class_+?61___">Nombre de beneficiaires femme </label>
            <div class="___class_+?63___">
                <input type="text" autocomplete="off" value="" class="form-control" id="bene_d_femmeEdit" name="bene_d_femme" placeholder="Entrez le nombre de beneficiaires femme">
                <span id="bene_d_femmeEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="observation" class="___class_+?47___">Observation </label>
            <div class="___class_+?49___">
                <input type="text" autocomplete="off" value="" class="form-control" id="observationEdit" name="observation" placeholder="Entrez le coût total de la réalisation">
                <span id="observationEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>
<hr />
<div class="row">
    <label>Liste des autres indicateurs</label>
    <label></label>
    <a href="#"><span id="addIEdit" class="___class_+?67___"><img class="nav-icon" src="{{ asset('img/icons/plus.png') }}" /></span></a>
    <div class="table-responsive">
        <div class="table-responsive">
            <table class=" display table table-striped table-bordered" id="dynamic_fieldIEdit" style="margin:11px">
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
    </div>
</div>
<hr />
<div class="row">
    <label>Liste des partenaires</label>
    <label></label>
    <a href="#"><span id="addEdit" class="___class_+?67___"><img class="nav-icon" src="{{ asset('img/icons/plus.png') }}" /></span></a>
    <div class="table-responsive">
        <div class="table-responsive">
            <table class=" display table table-striped table-bordered" id="dynamic_fieldEdit" style="margin:11px">
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
    </div>
</div>
