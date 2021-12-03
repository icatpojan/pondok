@extends('layouts.app')
@section('breadcrumb')
    <p class="mb-0 text-gray-800">
        <a href="{{ route('invoice.index') }}">Detail Info</a>/
        <a href="{{ route('create.invoice') }}">Invoice Info</a>/
        Customer Info/
        @if ($Invoice->status == 'invoice')
            <a href="{{ route('transferinfo') }}">Transfer Info</a>/
        @endif
        @if ($Invoice->type == 'AIRTIME' || $Invoice->type == 'VMS dan AIRTIME')
            <a href="{{ route('airtimeinfo') }}">Airtime Info</a>/
        @endif
        <a href="{{ route('userinfo') }}"> User Info</a>
</p>@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Customer info</h6>
                <button data-toggle="modal" data-target="#tambahModal" class="btn btn-outline-primary btn-sm">Cari
                    Customer</button>
            </div>
        </div>
        <form action="{{ route('customerInfostore') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 140px" id="basic-addon1">Customer
                                    :</span>
                            </div>
                            <select name="customer_id" id="customer" class="form-control">
                                <option value="">== Select Customer ==</option>
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
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Next</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script>
        $('#customer').on('change', function() {
            axios.post('{{ route('customer.show') }}', {
                    id: $(this).val()
                })
                .then(function(response) {
                    console.log(response);
                    $('#address').val(response.data.data.address);
                    $('#npwp').val(response.data.data.npwp);
                });
        });
    </script>
@endsection
