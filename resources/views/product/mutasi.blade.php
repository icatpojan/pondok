@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Mutasi Configuration</h6>
                <!-- Button trigger modal -->
            </div>
        </div>
        @include('product.modals.searchmutasi')
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('mutasi.add') }}" method="post">
                        @csrf
                        <input type="number" placeholder="silakan masukan sn produk.." name="sn" class="form-control">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success btn-block">add</button>
                    </form>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#exampleModal">
                        Filter
                    </button>
                </div>
                <div class="col-md-2">
                    <button data-toggle="modal" data-target="#tambahModal" class="btn btn-primary btn-block">Mutasi
                        Product</button>
                    @include('product.modals.mutasi')
                </div>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-sm ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>SN</th>
                            <th>Imei</th>
                            <th>Keterangan</th>
                            <th>Harga</th>
                            <th>Tipe</th>
                            <th>Gudang</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        @foreach ($Mutasi as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->sn }}</td>
                                <td>{{ $product->imei }}</td>
                                <td>{{ $product->keterangan }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->type->name }}</td>
                                <td>{{ $product->warehouse_f->name ?? $product->warehouse_from }}</td>
                                <td>{{ $product->status->name ?? 'tanpa status'}}</td>
                                <td class="row">
                                    <div class="col-md-1 ml-4">
                                        <form action="{{ route('mutasi.destroy', $product->sn) }}" method="post">
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm" type="submit"
                                                onclick="return confirm ('Yakin hapus product dari daftar mutasi?')">Remove</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @include('product.cards.mutasi')
@endsection
@section('script')
@endsection
