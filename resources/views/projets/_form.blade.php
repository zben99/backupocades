<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="projet_previsionnel_id">Projet prévisionnel<span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="projet_previsionnel_id" name="projet_previsionnel_id">
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
            <span id="projet_previsionnel_idError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="montant" class="">Montant <span class="text-danger">*</span></label>
            <div class="">
                <input readonly type="number" autocomplete="off" value="" class="form-control" id="montant" name="montant" placeholder="Entrez le montant">
                <span id="montantError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="obj" class="">Objectif Principal / Impact <span class="text-danger">*</span></label>
            <div class="">
                <textarea readonly name="objectGeneral" maxlength="200" class="form-control" placeholder=" votre objectif général ici" id="obj" cols="30" rows="4"></textarea>
                <span id="objError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="res" class="">Résultats / Produits <span class="text-danger">*</span></label>
            <div class="">
                <textarea readonly name="resultatAttendu" maxlength="200" class="form-control" placeholder="resultat attendu ici" id="res" cols="30" rows="4"></textarea>
                <span id="resError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="debut" class="">Date Début <span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" readonly class="form-control" autocomplete="off" name="debut" id="debut">
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
                <input type="date" readonly class="form-control" autocomplete="off" name="fin" id="fin">
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            <span id="finError" class="alert-message text-danger"></span>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="libelle" class="___class_+?8___">Projet <span class="text-danger">*</span></label>
            <div class="___class_+?10___">
                <input type="text" autocomplete="off" value="" class="form-control" id="libelle" name="libelle" placeholder="Entrez le libelle">
                <span id="libelleError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="desc" class="___class_+?16___">Description <span class="text-danger">*</span></label>
            <div class="___class_+?17___">
                <textarea name="description" maxlength="200" class="form-control" placeholder="description ici" id="desc" cols="30" rows="2"></textarea>
                <span id="descError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">Secteur(s) <span class="text-danger">*</span></label>
            <select class="form-control select2" multiple="multiple" style="width: 100%;" id="secteur" name="secteur[]">
                <option value="">Choisir...</option>
                @foreach ($secteurs as $secteur)
                <option value="{{ $secteur['id'] }}">{{ $secteur['nom'] }}</option>
                @endforeach
            </select>
            <span id="secteurError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="budget" class="">Budget <span class="text-danger">*</span></label>
            <div class="">
                <input min="0" type="number" autocomplete="off" value="0" class="form-control" id="budget" name="budget" >
                <span id="budgetError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="montantCharge" class="">Montant dépensé les charges de fonctionnement<span class="text-danger">*</span></label>
            <div class="">
                <input min="0" type="number" autocomplete="off" value="0" class="form-control" id="montantCharge" name="montantCharge" >
                <span id="montantChargeError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="montantEquipement" class="">Montant dépensé le matériel d’équipement<span class="text-danger">*</span></label>
            <div class="">
                <input min="0" type="number" autocomplete="off" value="0" class="form-control" id="montantEquipement" name="montantEquipement" >
                <span id="montantEquipementError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="depenseBeneficiaire" class="___class_+?56___">Montant dépensé au profit des bénéficiaires <span class="text-danger">*</span></label>
            <div class="">
                <input min="0" type="number" autocomplete="off" value="0" class="form-control" id="depenseBeneficiaire" name="depenseBeneficiaire" >
                <span id="depenseBeneficiaireError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="montantTotalDepense" class="___class_+?64___">Montant Total Dépensé <span class="text-danger">*</span></label>
            <div class="">
                <input min="0" type="number" readonly="true" autocomplete="off" value="0" class="form-control" id="montantTotalDepense" name="montantTotalDepense" >
                <span id="montantTotalDepenseError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="debut" class="___class_+?79___">Date Début <span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control" autocomplete="off" name="debut" id="debut">
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            <span id="debutError" class="alert-message text-danger"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="fin" class="___class_+?89___">Date Fin <span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control" autocomplete="off" name="fin" id="fin">
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            <span id="finError" class="alert-message text-danger"></span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="chefProjet" class="___class_+?71___">Chef de Projet <span class="text-danger">*</span></label>
            <div class="___class_+?73___">
                <input type="text" autocomplete="off" value="" class="form-control" id="chefProjet" name="chefProjet" placeholder="Entrez le chef de Projet">
                <span id="chefProjetError" class="alert-message text-danger"></span>
            </div>
        </div>
    </div>
</div>

<div class="row" id="mat">
    <label>Liste des partenaires <span class="text-danger">*</span></label>
    <label></label>
    <a href="#"><span id="add"><img class="nav-icon" src="{{ asset('img/icons/plus.png') }}" /></span></a>
    <div class="table-responsive">
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
    </div>
</div>
<hr />
<div class="row" id="doc">
    <label>Liste des documents</label>
    <a href="#"><span id="addD" class="___class_+?104___"><img class="nav-icon" src="{{ asset('img/icons/plus.png') }}" /></span></a>
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
    </div>
</div>
