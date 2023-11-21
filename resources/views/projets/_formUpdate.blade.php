<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="projet_previsionnel_id">Projet prévisionnel<span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="projet_previsionnel_idEdit" name="projet_previsionnel_id">
                <option value="">Choisir...</option>
                @can('manage-users')
                    @foreach ($projetprevisionnels as $projetprevisionnel)
                        <option value="{{ $projetprevisionnel['id'] }}">{{ $projetprevisionnel['nom'] }}</option>
                    @endforeach
                @endcan
                @cannot('manage-users')
                    @foreach ($projetprevisionnels as $projetprevisionnel)
                        @if($projetprevisionnel->agent == Auth::user()->id)
                          <option value="{{ $projetprevisionnel['id'] }}">{{ $projetprevisionnel['nom'] }}</option>
                        @endif
                    @endforeach
                @endcannot
            </select>
            <span id="projet_previsionnel_idEditError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="montantEdit" readonly class="">Montant <span class="text-danger">*</span></label>
            <div class="">
                <input type="number" autocomplete="off" value="" class="form-control" id="montantEdit" name="montant" placeholder="Entrez le montant">
                <span id="montantEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="objEdit" class="">Objectif Principal / Impact</label>
            <div class="">
                <textarea readonly name="objectGeneral" maxlength="200" class="form-control" placeholder=" votre objectif général ici" id="objEdit" cols="30" rows="4"></textarea>
                <span id="objEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="resEdit" class="">Résultats / Produits</label>
            <div class="">
                <textarea readonly name="resultatAttendu" maxlength="200" class="form-control" placeholder="resultat attendu ici" id="resEdit" cols="30" rows="4"></textarea>
                <span id="resEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="debutEdit" class="">Date Début </label>
            <div class="input-group date">
                <input readonly type="date" class="form-control" autocomplete="off" name="debut" id="debutEdit">
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
                <input readonly type="date" class="form-control" autocomplete="off" name="fin" id="finEdit">
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            <span id="finEditError" class="alert-message text-danger"></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="libelle" class="___class_+?8___">Projet <span class="text-danger">*</span></label>
            <div class="___class_+?10___">
                <input type="text" autocomplete="off" value="" class="form-control" id="libelleEdit" name="libelle" placeholder="Entrez le libelle">
                <span id="libelleEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="desc" class="___class_+?16___">Description<span class="text-danger">*</span></label>
            <div class="___class_+?18___">
                <textarea name="description" maxlength="200" class="form-control" placeholder="description ici" id="descEdit" cols="30" rows="4"></textarea>
                <span id="descEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>

<div class="row">
<div class="col-md-4">
        <div class="form-group">
            <label for="secteur">Secteur <span class="text-danger">*</span></label>
            <select class="form-control select2" multiple="multiple" style="width: 100%;" id="secteurEdit" name="secteur[]">
                <option value="">Choisir...</option>
                @foreach ($secteurs as $secteur)
                <option value="{{ $secteur['id'] }}">{{ $secteur['nom'] }}</option>
                @endforeach
            </select>
            <span id="secteurEditError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="budget" class="___class_+?29___">Budget <span class="text-danger">*</span></label>
            <div class="">
                <input min="0" type="number" autocomplete="off" value="" class="form-control" id="budgetEdit" name="budget" >
                <span id="budgetEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="montantCharge" class="">Montant dépensé les charges de fonctionnement<span class="text-danger">*</span></label>
            <div class="">
                <input min="0" type="number" autocomplete="off" value="" class="form-control" id="montantChargeEdit" name="montantCharge" >
                <span id="montantChargeEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="montantEquipement" class="">Montant dépensé le matériel d’équipement<span class="text-danger">*</span></label>
            <div class="">
                <input min="0" type="number" autocomplete="off" value="" class="form-control" id="montantEquipementEdit" name="montantEquipement" >
                <span id="montantEquipementEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="depenseBeneficiaire" class="___class_+?58___">Montant dépensé au profit des bénéficiaires<span class="text-danger">*</span></label>
            <div class="___class_+?60___">
                <input min="0" type="number" autocomplete="off" value="" class="form-control" id="depenseBeneficiaireEdit" name="depenseBeneficiaire" >
                <span id="depenseBeneficiaireEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="montantTotalDepense" class="___class_+?65___">Montant Total Dépensé <span class="text-danger">*</span></label>
            <div class="___class_+?67___">
                <input min="0" type="number" readonly="true"  autocomplete="off" value="" class="form-control" id="montantTotalDepenseEdit" name="montantTotalDepense" >
                <span id="montantTotalDepenseEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="debut" class="___class_+?81___">Date Début <span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control" autocomplete="off" name="debut" id="debutEdit">
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            <span id="debutEditError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="fin" class="___class_+?91___">Date Fin <span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control" autocomplete="off" name="fin" id="finEdit">
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            <span id="finEditError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="chefProjet" class="___class_+?73___">Chef de Projet <span class="text-danger">*</span></label>
            <div class="___class_+?75___">
                <input type="text" autocomplete="off" value="" class="form-control" id="chefProjetEdit" name="chefProjet" placeholder="Entrez le chef de Projet">
                <span id="chefProjetEditError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <label>Liste des partenaires <span class="text-danger">*</span></label>
    <label></label>
    <a href="#"><span id="addEdit" class="___class_+?100___"><img class="nav-icon" src="{{ asset('img/icons/plus.png') }}" /></span></a>
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
<hr />
<div class="row">
    <label>Liste des documents</label>
    <a href="#"><span id="addDEdit" class="___class_+?106___"><img class="nav-icon" src="{{ asset('img/icons/plus.png') }}" /></span></a>
    <div class="table-responsive">
        <div class="table-responsive">
            <table id="dynamic_fieldDelete">

            </table>
            <table class=" display table table-striped table-bordered" id="dynamic_fieldDEdit" style="margin:11px">
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
    </div>
</div>
