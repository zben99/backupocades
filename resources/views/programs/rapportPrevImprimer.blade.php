
        <table class="table table-bordered" width="100%"  cellspacing="0">
            <thead>
                <tr>
                    <th colspan="18" align="center">Canevas de planification annuelle des activités (se référer au canevas de programmation annuelle selon RAC)</th>
                </tr>
                <tr>
                    <th>Activités</th>
                    <th>Programme</th>
                    <th>Secteur de l’activité</th>
                    <th>Unité de mésure</th>
                    <th>Quantité prévue</th>
                    <th>Montant total prévu</th>
                    <th>Partenaire Financier</th>
                    <th>Contribution des bénéficiaires</th>
                    <th>Contribution des partenaires financier</th>
                    <th>Bénéficiaires H</th>
                    <th>Bénéficiaires F</th>
                    <th>Bénéficiaires T</th>
                    <th>Bénéficiaires désagrégées atteints en fonction du contexte</th>
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
                    <td colspan="18">{{ $key }}</td>
                </tr>
                @foreach($activite as $act)
                <tr>
                    <td>{{ $act->libelle }}</td>
                    <td>{{ $act->projetPrevisionnel->program->nom }}</td>
                    <td>{{ $act->domaine->secteur->nom }}</td>
                    <td>{{ $act->unite_physique }}</td>
                    <td>{{ $act->quantite }}</td>
                    <td>{{ $act->cout }}</td>

                    <td>{{ implode(',',$act->partenaires->pluck('nom')->toArray())}}</td>
                    <td>{{ $act->contrib_beneficiaire }}</td>
                    <td><?php $ct = 0; ?> @foreach($act->partenaires as $partenaire) <?php $ct = $ct + $partenaire->pivot->montant ?> @endforeach {{ $ct}}</td>

                    <td>{{ $act->bene_d_homme }}</td>
                    <td>{{ $act->bene_d_femme }}</td>
                    <td>@if(isset($act->bene_d_homme) & isset($act->bene_d_femme) ){{ $act->bene_d_homme+$act->bene_d_femme }}@else 0 @endif</td>
                    <td>Quoi??</td>


                    <td>@if(isset($act->date_realisation)){{$act->date_realisation}}@endif</td>
                    <td>{{ implode(',',$act->villages->pluck('village')->toArray())}}</td>
                    <td>{{ implode(',',$act->communes->pluck('commune')->toArray())}}</td>
                    <td>{{ implode(',',$act->paroisses->pluck('paroisse')->toArray())}}</td>
                    <td>{{$act->region->nom}}</td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
