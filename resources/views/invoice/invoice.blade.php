@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Invoice Configuration</h6>
                <!-- Button trigger modal -->
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('invoice.add') }}" method="post">
                        @csrf
                        <input type="number" placeholder="Silakan masukan SN produk" name="sn" class="form-control">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success btn-block">Tambahkan</button>
                    </form>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                        Cari barang
                    </button>
                    @include('invoice.modals.invoice')
                </div>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-sm ">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Imei</th>
                            <th>Id</th>
                            <th>Type</th>
                            <th>Warehouse</th>
                            <th>Price</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        @foreach ($Detail as $detail)
                            <tr>
                                <td>{{ $detail->sn }}</td>
                                <td>{{ $detail->imei }}</td>
                                <td>{{ $detail->id }}</td>
                                <td>{{ $detail->type->name }}</td>
                                <td>{{ $detail->warehouse->name ?? $detail->warehouse_id }}</td>
                                <td>{{ $detail->price }}</td>
                                <td>{{ $detail->status->name ?? $detail->status_id }}</td>
                                <td class="row">
                                    <div class="col-md-1 ml-3">
                                        <form action="{{ route('invoice.destroy', $detail->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm" type="submit">Remove</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tfoot>
                </table>
                <h1 style="color: rgba(206, 203, 203, 0.404); text-align:center; margin-bottom: 10px">
                    HARGA=Rp.{{ $Price }} + PPN 10% =Rp.{{ $PPN }}
                </h1>
            </div>
        </div>
    </div>
    @include('invoice.cards.search')
    <div class="row">
        <div class="col">
            <a href="{{ route('create.invoice') }}" type="button" class="btn btn-success btn-lg btn-block">Create
                Invoice</a>
        </div>
        <div class="col">
            <a href="{{ route('create.performa') }}" type="button" class="btn btn-primary btn-lg btn-block">Create
                Performa</a>
        </div>
    </div>
@endsection
@section('script')
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>

    <script>
        $('#stempel').on('change', function() {
            axios.post('{{ route('invoice.stempel') }}', {
                    id: $(this).val()
                })
                .then(function(response) {
                    let data = response.data.data
                    $('#nomer_invoice').val(data);
                });
        });
        $('#customer').on('change', function() {
            axios.post('{{ route('customer.show') }}', {
                    id: $(this).val()
                })
                .then(function(response) {
                    $('#address').val(response.data.data.address);
                    $('#npwp').val(response.data.data.npwp);
                });
        });
        $('#ship').on('change', function() {
            axios.post('{{ route('ship.show') }}', {
                    id: $(this).val()
                })
                .then(function(response) {
                    $('#ship_name').val(response.data.data.name);
                    $('#ship_name').val(response.data.data.name);
                    $('.haha').val(response.data.data.name);
                    $('#airtime_start').val(response.data.data.airtime_start);
                    $('#airtime_end').val(response.data.data.airtime_end);
                });
        });
        $('#ship_name').on('change', function() {
            axios.post('{{ route('ship.show') }}', {
                    name: $(this).val()
                })
                .then(function(response) {
                    $('#ship').val(response.data.data.id);
                    $('#ship_name').val(response.data.data.name);
                    $('.haha').val(response.data.data.name);
                    $('#airtime_start').val(response.data.data.airtime_start);
                    $('#airtime_end').val(response.data.data.airtime_end);
                });
        });
        // $(document).ready(function() {
        //     $('.btn-search').click(function(e) {
        //         let warehouse = $('select[name=warehouse]').val();
        //         let type = $('select[name=type]').val();;

        //         axios.post('{{ route('invoice.cari') }}', {
        //                 warehouse: warehouse,
        //                 type: type,
        //             })
        //             .then(function(response) {
        //                 console.log(response)
        //                 $('#data').append(
        //                     $.each(response.data, function(id, sn) {
        //                         $('#region').append(new Option(sn, id))
        //                     })
        //                 )
        //             });
        //     });
        // });
    </script>
@endsection
