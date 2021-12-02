@extends('layouts.app')
@section('breadcrumb')
   <p class="mb-0 text-gray-800">
        <a href="{{ route('invoice.index') }}">Detail Info</a>/
        <a href="{{ route('create.invoice') }}">Invoice Info</a>/
        <a href="{{ route('customerinfo') }}"> Customer Info</a>/
        <a href="{{ route('transferinfo') }}">Transfer Info</a>/
        <a href="{{ route('airtimeinfo') }}">Airtime Info</a>/
        <a href="{{ route('userinfo') }}"> User Info</a>
    </p>@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Customer info</h6>
            </div>
        </div>
        <form action="{{ route('transferInfoStore') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 140px" id="basic-addon1">Transfer date
                                    :</span>
                            </div>
                            <input type="date" name="transfer_date" class="form-control" placeholder="geosat">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <select name="bank" id="bank" class="form-control">
                                <option value="BCA">BCA</option>
                                <option value="BRI" selected>BRI</option>
                                <option value="BNI">BNI</option>
                                <option value="Mandiri">Mandiri</option>
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
                            <input name="transfer_name" type="text" class="form-control"
                                placeholder="nama pentransfer...">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 140px" id="basic-addon1">Contact
                                    :</span>
                            </div>
                            <input type="number" value="{{ old('contact') }}" name="contact" class="form-control  border-success">
                        </div>
                        <small class="text-success">* boleh kosong</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Next</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
