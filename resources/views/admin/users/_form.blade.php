<div class="row">
    <div class="col-md-4">
      <div class="form-group">
            <label for="name">Nom <span class="text-danger">*</span></label>
            <input id="name" type="text"  class="form-control @error('name') is-invalid @enderror" name="name" wire:model='name' value="{{ old('name') }}" autocomplete="off">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>
    </div>
    <div class="col-md-5">
      <!-- /.form-group -->
      <div class="form-group">
            <label for="forname">Prénom(s) <span class="text-danger">*</span></label>
            <input id="forname" type="text" wire:model='forname' class="form-control @error('forname') is-invalid @enderror" name="forname" value="{{ old('forname') }}"  autocomplete="off">
            @error('forname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>
    </div>
      <!-- /.form-group -->
      <!-- form-group -->
    <div class="col-md-3">
        <div class="form-group">
            <label for="forname">Login <span class="text-danger">*</span></label>
            <input id="username" type="text" wire:model='username' class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  autocomplete="off">
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
  <!-- /.form-group -->
    </div>

    <div class="row">
        <!-- /.form-group -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="code_dir">Direction <span class="text-danger">*</span></label>
                <select class="form-control select2" style="width: 100%;" wire:model.lazy='code_dir' name="code_dir">
                <option selected="selected" value="{{ old('code_dir') }}">Choisir...</option>
                @foreach ($directions as $direction)
                        <option value="{{ $direction['id'] }}">{{ $direction['nom_dir'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <!-- /.form-group -->
            <label for="roles">Attribuer Les Roles <span class="text-danger">*</span></label>
            <div class="row ml-3 mt-3">
                <div class="form-group form-check">
                    @foreach ($roles_t as $role)
                        @can('admin')
                            <div class="d-inline col-md-4 ml-2 mr-3 mt-4">
                                <input type="checkbox" class="form-check-input" wire:model='roles' name="roles[]" value="{{ $role->id}}" id="{{ $role->id}}">
                                <label for=" {{ $role->id}}" class="">{{ $role->name}}</label>
                            </div>
                        @endcan
                        @cannot('admin')
                            @if ($role->name!="admin")
                            <div class="d-inline col-md-4 ml-2 mr-3 mt-4">
                                <input type="checkbox" class="form-check-input" wire:model='roles' name="roles[]" value="{{ $role->id}}" id="{{ $role->id}}">
                                <label for=" {{ $role->id}}" class="">{{ $role->name}}</label>
                            </div>
                        @endif
                        @endcannot


                    @endforeach
                </div>

            </div>
        </div>
    </div>
