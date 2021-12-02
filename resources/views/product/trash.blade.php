@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Trash Configuration</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm" id="dataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>SN</th>
                            <th>Imei</th>
                            <th>Keterangan</th>
                            <th>Tanggal Masuk</th>
                            <th>Harga</th>
                            <th>Tipe</th>
                            <th>Gudang</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Product as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->sn }}</td>
                                <td>{{ $product->imei }}</td>
                                <td>{{ $product->keterangan }}</td>
                                <td>{{ $product->tgl_masuk }}</td>
                                <td>{{ $product->type->price }}</td>
                                <td>{{ $product->type->name }}</td>
                                <td>{{ $product->warehouse->name }}</td>
                                <td>{{ $product->status->name }}</td>
                                <td class="row">
                                    <div class="col-md-3 mr-4">
                                        <form action="{{ route('trash.restore', $product->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-outline-success btn-sm" type="submit">restore</button>
                                        </form>
                                    </div>
                                    <div class="col-md-1">

                                        <form action="{{ route('trash.hapus', $product->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm" type="submit"
                                                onclick="return confirm ('Yakin hapus product ?')">hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection
