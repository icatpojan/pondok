@extends('layouts.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
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
            </div>
        </div>
        <form action="{{ route('customerInfostore') }}" method="post">
            @csrf
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ url('public/vendor/jquery/inputmask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            $('#npwp').inputmask({
                mask: '99.999.999.9-999.999'
            })
        });
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
