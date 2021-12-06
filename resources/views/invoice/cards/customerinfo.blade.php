<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Customer info</h6>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 140px; height: 30px" id="basic-addon1">Customer
                            :</span>
                    </div>
                    <select name="customer_id" id="customer" class="js-example-basic-single form-control">
                        <option value="">== pilih user ==</option>
                        @foreach ($Customer as $customer)
                            <option {{ $Invoice->customer_id == $customer->id ? 'selected' : '' }}
                                value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">NPWP Number:</span>
                    </div>
                    <input type="number" value="{{ $Invoice->npwp }}" name="npwp" id="npwp" required
                        class="form-control" placeholder="Masukkan Nomer NPWP">
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 140px; height: 30px" id="basic-addon1">Ship
                            name Number:</span>
                    </div>
                    <select class="js-example-basic-single form-control haha" name="ship_id" id="ship_name">
                        @foreach ($Ship as $ship)
                            <option value="">== pilih kapal ==</option>
                            <option {{ $Invoice->ship_id == $ship->id ? ' selected="selected"' : '' }}
                                value="{{ $ship->id }}">{{ $ship->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 140px" id="basic-addon1">Address
                            :</span>
                    </div>
                    <textarea name="address" class="form-control" id="address" required
                        style="height: 90px">{{ $Invoice->address }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
