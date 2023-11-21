
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
            @error('debut')
                <span class="alert-message text-danger">{{ $message }}</span>
            @enderror
        </div>
        <span id="debutError" class="alert-message text-danger"></span>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="fin" class="">Date Fin <span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control" autocomplete="off" name="fin" id="fin">
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                @error('fin')
                    <span class="alert-message text-danger" >{{ $message }}</span>
                @enderror
            </div>
            <span id="finError" class="alert-message text-danger"></span>
        </div>
    </div>
</div>
