@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css" />
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
        @if ($Invoice->status == 'invoice')
            <div class="col">
                <a href="{{ route('create.invoice') }}" type="button" class="btn btn-success btn-lg btn-block">Create
                    Invoice</a>
            </div>
        @else
            <div class="col">
                <a href="{{ route('create.performa') }}" type="button" class="btn btn-primary btn-lg btn-block">Create
                    Performa</a>
            </div>
        @endif
    </div>
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                aaSorting: [
                    [5, 'desc']
                ],
                bSort: true,
            });
        });
    </script>
@endsection
