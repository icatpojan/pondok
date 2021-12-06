<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Transfer info</h6>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 140px" id="basic-addon1">Transfer date
                            :</span>
                    </div>
                    <input type="date" value="{{ $Invoice->transfer_date }}" name="transfer_date"
                        class="form-control" placeholder="geosat">
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <select name="bank" id="bank" class="form-control">
                        @foreach ($Bank as $bank)
                            <option {{ $Invoice->bank == $bank->id ? 'selected' : '' }} value="{{ $bank->id }}">
                                {{ $bank->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 140px" id="basic-addon1">Transfer
                            name:</span>
                    </div>
                    <input value="{{ $Invoice->transfer_name }}" name="transfer_name" type="text"
                        class="form-control" placeholder="nama pentransfer...">
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 140px" id="basic-addon1">Contact
                            :</span>
                    </div>
                    <input type="number" value="{{ $Invoice->contact }}" name="contact"
                        class="form-control  border-success">
                </div>
                <small class="text-success">* boleh kosong</small>
            </div>
        </div>
    </div>
</div>
