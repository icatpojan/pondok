 <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Invoice info</h6>
            </div>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 140px" id="basic-addon1">Invoice
                                    No:</span>
                            </div>
                            <input disabled type="text" name="invoice_no" id="nomer_invoice" value="{{ $Invoice->invoice_no }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-2">
                            <div class="input-group mb-2">
                                <select disabled id="stempel" name="type" class="form-control">
                                    @foreach ($Category as $key => $value)
                                        <option {{ $Invoice->type == $value->name ? 'selected' : '' }}
                                            value="{{ $value->name }}">
                                            {{ $value->name }}
                                        </option>
                                    @endforeach
                                    <option {{ $Invoice->type == 'VMS dan AIRTIME' ? 'selected' : '' }}
                                        value="VMS dan AIRTIME">VMS dan AIRTIME</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 140px" id="basic-addon1">Invoice
                                    Date:</span>
                            </div>
                            <input type="date"
                                value="{{ $Invoice->invoice_date ? $Invoice->invoice_date->format('Y-m-d') : '---' }}"
                                name="invoice_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 140px" id="basic-addon1">Invoice
                                    Type:</span>
                            </div>
                            <select name="category" class="form-control">
                                <option {{ $Invoice->category == 'Renewal' ? 'selected' : '' }} value="Renewal">Renewal
                                </option>
                                <option {{ $Invoice->category == 'New Unit' ? 'selected' : '' }} value="New Unit">New
                                    Unit
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 140px" id="basic-addon1">Description
                                    :</span>
                            </div>
                            <textarea placeholder="tambahkan keterangnjika ada.." required name="deskripsi"
                                class="form-control" style="height: 90px">{{ $Invoice->deskripsi }}</textarea>
                        </div>
                    </div>
                </div>
        </div>
    </div>
