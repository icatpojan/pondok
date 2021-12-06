@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Performa</h6>
                <a href="/invoice/export_excel" class="btn btn-success" target="_blank">EXPORT EXCEL</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm" id="dataTable">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>nomer inv</th>
                            <th>Jenis</th>
                            <th>Deskripsi</th>
                            <th>Address</th>
                            <th>Customer</th>
                            <th>Ship</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Invoice as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->invoice_no }}</td>
                                <td>{{ $invoice->jenis }}</td>
                                <td>{{ $invoice->deskripsi }}</td>
                                <td>{{ $invoice->address }}</td>
                                <td>{{ $invoice->customer->name ?? $invoice->customer_id }}</td>
                                <td>{{ $invoice->ship->name ?? $invoice->ship_id }}</td>
                                <td>{{ $invoice->tanggal }}</td>
                                <td>
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="p-1 bd-highlight">
                                            <form action="{{ route('report.cetak', $invoice->id) }}" method="GET"
                                                target="_blank">
                                                @csrf
                                                <button class="btn btn-outline-primary btn-sm" type="submit"><i
                                                        class="fa fa-eye"></i></button>
                                            </form>
                                        </div>
                                        <div class="p-1 bd-highlight">
                                            <form action="{{ route('report.cetak', $invoice->id) }}" method="GET"
                                                target="_blank">
                                                @csrf
                                                <button class="btn btn-outline-warning btn-sm" type="submit"><i
                                                        class="fa fa-print"></i></button>
                                            </form>
                                        </div>
                                        <div class="p-1 bd-highlight">
                                            <form action="{{ route('report.delete', $invoice->id) }}" method="post">
                                                @csrf
                                                <button class="btn btn-outline-danger btn-sm" type="submit"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Pencarian Performa Berdasar Waktu</h6>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('report.index') }}" method="get">
                <div class="row">
                    <div class="col">
                        <input type="date" name="awal" required class="form-control mb-2">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-lg btn-block btn-sm mb-2">Tampilkan</button>
                    </div>
                    <div class="col">
                        <input type="date" name="akhir" class="form-control mb-2">
                    </div>
                </div>
            </form>
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
