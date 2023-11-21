<div class="row">
    <div class="col-md-4" wire:ignore>
        <div class="form-group">
            <label for="region">Région </label>
            <select class="form-control  @error('region') is-invalid @enderror" id="select-region">
                <option value="">Choisir...</option>
                @foreach ($regions as $reg)
                    <option value="{{ $reg['id'] }}">{{ $reg['nom'] }}</option>
                @endforeach
            </select>
            @error('region')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-4" wire:ignore>
        <div class="form-group">
            <label for="province">Province </label>
            <select class="form-control  @error('province') is-invalid @enderror" id="select-province">
                <option value="">Choisir...</option>
                @foreach ($provinces as $prov)
                    <option value="{{ $prov['id'] }}">{{ $prov['province'] }}</option>
                @endforeach
            </select>
            @error('province')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-4" wire:ignore>
        <div class="form-group">
            <label for="commune">Commune </label>
            <select class="form-control  @error('commune') is-invalid @enderror" id="select-commune">
                <option value="">Choisir...</option>
                @foreach ($communes as $comne)
                    <option value="{{ $comne['id'] }}">{{ $comne['commune'] }}</option>
                @endforeach
            </select>
            @error('commune')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

</div>
<div class="row">

    <div class="col-md-4" wire:ignore>
        <!-- /.form-group -->
        <div class="form-group">
            <label for="secteur">Secteur </label><select class="form-control " style="width: 100%;"
                id="select-secteur">
                <option selected="selected" value="">Choisir...</option>
                @foreach ($secteurs as $sect)
                    <option value="{{ $sect['id'] }}">{{ $sect['nom'] }}</option>
                @endforeach
            </select>
            @error('secteur')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4" wire:ignore>
        <div class="form-group">
            <label for="domaine">Domaines </label>
            <select class="form-control  @error('domaine') is-invalid @enderror" id="select-domaine">
                <option value="">Choisir...</option>
                @foreach ($domaines as $dom)
                    <option value="{{ $dom['id'] }}">{{ $dom['domaine'] }} </option>
                @endforeach
            </select>
            @error('domaine')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-4" wire:ignore>
        <div class="form-group">
            <label for="paroisse">Paroisse </label>
            <select class="form-control  @error('paroisse') is-invalid @enderror" id="select-paroisse">
                <option value="">Choisir...</option>
                @foreach ($paroisses as $parois)
                    <option value="{{ $parois['id'] }}">{{ $parois['paroisse'] }}</option>
                @endforeach
            </select>
            @error('paroisse')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>



</div>

<div class="row">

    <div class="col-md-4" wire:ignore>
        <div class="form-group ">
            <label for="type">Type Partenaire </label>
            <select class=" form-control form-select @error('type') is-invalid @enderror" id='select-type'>
                <option value="">Choisir...</option>
                @foreach ($types as $typ)
                    <option value="{{ $typ['id'] }}">{{ $typ['libelle'] }}</option>
                @endforeach
            </select>
            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4" wire:ignore>
        <!-- /.form-group -->
        <div class="form-group">
            <label for="partenaire">Partenaire </label><select class="form-control " style="width: 100%;"
                id="select-partenaire">
                <option selected="selected" value="">Choisir...</option>
                @foreach ($partenaires as $part)
                    <option value="{{ $part['id'] }}">{{ $part['nom'] }}</option>
                @endforeach
            </select>
            @error('partenaire')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="debut">Date Début </label>
            <input type="date" wire:model='debut' class="form-control @error('debut') is-invalid @enderror"
                value="{{ old('debut') }}" />
            @error('debut')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="fin">Date Fin </label>
            <input type="date" wire:model='fin' class="form-control @error('fin') is-invalid @enderror"
                value="{{ old('fin') }}" />
            @error('fin')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-12">
        <label for="indice">Titre du projet</label>
        <input type="text" class="form-control @error('indice') is-invalid @enderror" id="indice" name="indice"
            wire:model='indice' autocomplete="off">
        @error('indice')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

</div>


@push('select2')

    <script>
        $(document).ready(function() {
            $('#select-commune').select2();
            $('#select-commune').on('change', function(e) {
                var data = $('#select-commune').select2("val");
                @this.set('commune', data);
            });

            $('#select-region').select2();
            $('#select-region').on('change', function(e) {
                var data = $('#select-region').select2("val");
                @this.set('region', data);
            });

            $('#select-type').select2();
            $('#select-type').on('change', function(e) {
                var data = $('#select-type').select2("val");
                @this.set('type', data);
            });

            $('#select-paroisse').select2();
            $('#select-paroisse').on('change', function(e) {
                var data = $('#select-paroisse').select2("val");
                @this.set('paroisse', data);
            });

            $('#select-secteur').select2();
            $('#select-secteur').on('change', function(e) {
                var data = $('#select-secteur').select2("val");
                @this.set('secteur', data);
            });

            $('#select-province').select2();
            $('#select-province').on('change', function(e) {
                var data = $('#select-province').select2("val");
                @this.set('province', data);
            });

            $('#select-domaine').select2();
            $('#select-domaine').on('change', function(e) {
                var data = $('#select-domaine').select2("val");
                @this.set('domaine', data);
            });

            $('#select-partenaire').select2();
            $('#select-partenaire').on('change', function(e) {
                var data = $('#select-partenaire').select2("val");
                @this.set('partenaire', data);
            });
        });
    </script>

@endpush
