@extends('layouts.app')
@section('breadcrumb')
    <p class="mb-0 text-gray-800">
        <a href="{{ route('invoice.index') }}">Detail Info</a>/
        Invoice Info/
        <a href="{{ route('customerinfo') }}"> Customer Info</a>/
        @if ($Invoice->status == 'invoice')
            <a href="{{ route('transferinfo') }}">Transfer Info</a>/
        @endif
        @if ($Invoice->type == 'AIRTIME' || $Invoice->type == 'VMS dan AIRTIME')
            <a href="{{ route('airtimeinfo') }}">Airtime Info</a>/
        @endif
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
                            <input type="text" name="invoice_no" id="nomer_invoice" value="{{ $Invoice->invoice_no }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-2">
                            <div class="input-group mb-2">
                                <select id="stempel" name="type" class="form-control">
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
                    @if ($Invoice->status == 'performa')
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="basic-addon1">Due
                                        Date:</span>
                                </div>
                                <input type="date"
                                    value="{{ $Invoice->due_date ? $Invoice->due_date->format('Y-m-d') : '---' }}"
                                    name="due_date" class="form-control" required>
                            </div>
                        </div>
                    @endif
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
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ url('public/vendor/jquery/inputmask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#nomer_invoice').inputmask({
                mask: '9999/*{3,5}/PIM/*{3}/9999'
            })
        });
    </script>
@endsection
