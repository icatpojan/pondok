@extends('layouts.app')
@section('breadcrumb')
    <p class="mb-0 text-gray-800">
        <a href="{{ route('invoice.index') }}">Detail Info</a>/
        <a href="{{ route('create.invoice') }}">Invoice Info</a>/
        <a href="{{ route('customerinfo') }}"> Customer Info</a>/
        <a href="{{ route('transferinfo') }}">Transfer Info</a>/
        <a href="{{ route('airtimeinfo') }}">Airtime Info</a>/
        <a href="{{ route('userinfo') }}"> User Info</a>
    </p>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Invoice info</h6>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('invoiceInfo.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 140px" id="basic-addon1">Invoice
                                    No:</span>
                            </div>
                            <input type="text" name="invoice_no" id="nomer_invoice" value="{{ $Nomer }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-2">
                            <div class="input-group mb-2">
                                <select name="stempel" id="stempel" name="type" class="form-control">
                                    <option value="AIRTIME">AIRTIME</option>
                                    <option value="CCTV">CCTV</option>
                                    <option value="VMS" selected>VMS</option>
                                    <option value="VMS dan AIRTIME" selected>VMS dan AIRTIME</option>
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
                            <input type="date" name="invoice_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 140px" id="basic-addon1">Invoice
                                    Type:</span>
                            </div>
                            <select name="jenis" class="form-control">
                                <option value="Renewal">Renewal</option>
                                <option value="New Unit">New Unit</option>
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
                                class="form-control" style="height: 90px"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
