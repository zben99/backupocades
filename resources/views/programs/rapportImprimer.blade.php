{{-- @extends('layouts.app',['title'=>'Programmes'])


@section('content')


<section class="content-header">
    <div class="container-fluid">
        <div class="row my-3">
        </div>
    </div>
</section>
<div class="card-body">
    <div class="table-responsive-sm"> --}}
        <table class="table table-bordered" width="100%"  cellspacing="0">
            <thead>
                <tr>
                    <th colspan="21" align="center">Canevas de bilan annuel des activités (se référer au canevas de programmation annuelle selon RAC)</th>
                </tr>
                <tr>
                    <th>Activités</th>
                    <th>Programme</th>
                    <th>Secteur de l’activité</th>
                    <th>Unité de mésure</th>
                    <th>Quantité prévue</th>
                    <th>Quantité réalisée</th>
                    <th>Taux de réalisation physique (%)</th>
                    <th>Montant total prévu</th>
                    <th>Montant total réalisé</th>
                    <th>Taux d'exécution budgétaire (%)</th>
                    <th>Bénéficiaires H</th>
                    <th>Bénéficiaires F</th>
                    <th>Bénéficiaires T</th>
                    <th>Bénéficiaires désagrégées atteints en fonction du contexte</th>
                    <th>Contribution des bénéficiaires</th>
                    <th>Contribution des partenaires financier</th>
                    <th>Période de réalisation (préciser)</th>
                    <th>Village</th>
                    <th>Commune</th>
                    <th>Paroisse</th>
                    <th>Région</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($activites as $key => $activite)
                <tr>
                    <td colspan="21">{{ $key }}</td>
                </tr>
                @foreach($activite as $act)
                @php
                $tauxQte = $act->activitePrevisionnelle->quantite==0 ? 0 :$act->quantite_realise/$act->activitePrevisionnelle->quantite;
                $tauxBudget = $act->activitePrevisionnelle->cout==0 ? 0 :$act->cout_total_realisation/$act->activitePrevisionnelle->cout;
                @endphp
                <tr>
                    <td>{{ $act->libelle }}</td>
                    <td>{{ $act->activitePrevisionnelle->projetPrevisionnel->program->nom }}</td>
                    <td>{{ $act->domaine->secteur->nom }}</td>
                    <td>{{ $act->unite_physique }}</td>
                    <td>{{ $act->activitePrevisionnelle->quantite }}</td>
                    <td>{{ $act->quantite_realise }}</td>
                    <td>{{ $tauxQte * 100 }}%</td>
                    <td>{{ $act->activitePrevisionnelle->cout }}</td>
                    <td>{{ $act->cout_total_realisation }}</td>
                    <td>{{ $tauxBudget * 100 }}%</td>
                    <td>{{ $act->bene_d_homme }}</td>
                    <td>{{ $act->bene_d_femme }}</td>
                    <td>@if(isset($act->bene_d_homme) & isset($act->bene_d_femme) ){{ $act->bene_d_homme+$act->bene_d_femme }}@else 0 @endif</td>
                    <td>Quoi??</td>
                    <td>{{ $act->contrib_beneficiaire }}</td>
                    <td><?php $ct = 0; ?> @foreach($act->partenaires as $partenaire) <?php $ct = $ct + $partenaire->pivot->montant ?> @endforeach {{ $ct}}</td>
                    <td>@if(isset($act->date_realisation)){{$act->date_realisation->format('d/m/Y')}}@endif</td>
                    <td>@foreach($act->paroisse->villages as $village){{ $village->village }} @endforeach</td>
                    <td>{{$act->paroisse->commune->commune}}</td>
                    <td>{{$act->paroisse->paroisse}}</td>
                    <td>{{$act->paroisse->commune->province->region->nom}}</td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
