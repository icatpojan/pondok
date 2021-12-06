@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css" />
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Cari Invoice</h6>
                <button data-toggle="modal" data-target="#searchModal" class="btn btn-outline-primary btn-sm">Cari invoice</button>
                @include('report.modals.searchInvoice')
                {{-- <a href="/invoice/export_excel" class="btn btn-success" target="_blank">EXPORT EXCEL</a> --}}
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
                            <th>Alamat</th>
                            <th>Customer</th>
                            <th>Kapal</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Invoice as $invoice)
                            @if ($invoice->status == 'invoice')
                                <tr class="table-success">
                                @else
                                <tr class="table-warning">
                            @endif
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->invoice_no }}</td>
                            <td>{{ $invoice->type }}</td>
                            <td>{{ $invoice->deskripsi }}</td>
                            <td>{{ $invoice->address }}</td>
                            <td>{{ $invoice->customer->name ?? $invoice->customer_id }}</td>
                            <td>{{ $invoice->ship->name ?? $invoice->ship_id }}</td>
                            <td>{{ $invoice->invoice_date->format('d F Y') }}</td>
                            <td>
                                <div class="d-flex flex-row bd-highlight mb-3">
                                    @if ($invoice->status == 'performa')
                                        <div class="p-1 bd-highlight">
                                            <form action="{{ route('invoice.editperforma', $invoice->id) }}" method="GET">
                                                <button class="btn btn-outline-primary btn-sm" type="submit"><i
                                                        class="fa fa-eye"></i></button>
                                            </form>
                                        </div>
                                    @endif
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
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                aaSorting: [
                    [1, 'desc']
                ],
                bSort: true,
            });
        });
    </script>
@endsection
