@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css" />
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Mutasi</h6>
                {{-- <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                    filter
                </button> --}}
                {{-- @include('product.modals.filtermutasi') --}}
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Sn produk</th>
                            <th>Tipe</th>
                            <th>Asal gudang</th>
                            <th>Gudang</th>
                            <th>Pemutasi</th>
                            <th>Alasan mutasi</th>
                            <th>Tanggal mutasi</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Mutasi as $mutasi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mutasi->sn }}</td>
                                <td>{{ $mutasi->type->name ?? '---' }}</td>
                                <td>{{ $mutasi->warehouse_f->name ?? '---' }}</td>
                                <td>{{ $mutasi->warehouse_t->name ?? '---' }}</td>
                                <td>{{ $mutasi->user->username ?? '---' }}</td>
                                <td>{{ $mutasi->reason }}</td>
                                <td>{{ $mutasi->date ? $mutasi->date->format('d F Y') : '---' }}</td>
                                {{-- <td>
                                    <div class="row">
                                        <div class="col-md-1">
                                            <form action="{{ route('mutasi.destroy', $mutasi->id) }}" method="post">
                                                @csrf
                                                <button class="btn btn-outline-danger btn-sm" type="submit"
                                                    onclick="return confirm ('Yakin hapus mutasi ?')">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </td> --}}
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
                    [7, 'desc']
                ],
                bSort: true,
            });
        });
    </script>
@endsection
