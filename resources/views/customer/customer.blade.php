@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Konfigurasi Customer</h6>
                <a href="{{ route('customer.add') }}" class="btn btn-outline-primary btn-sm">Tambah
                    Customer</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Alamat</th>
                            <th>Provinsi</th>
                            <th>Fax</th>
                            <th>Telp</th>
                            <th>NPWP</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Customer as $customer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->province->province_name ?? 'tidak terdaftar' }}</td>
                                <td>{{ $customer->fax }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->npwp }}</td>
                                <td>{{ $customer->email }}</td>
                                <td class="row">
                                    <div class="col-md-1">
                                        <a href="{{ route('customer.showing', $customer->id) }}"
                                            class="btn btn-outline-primary btn-sm">
                                            Edit
                                        </a>
                                    </div>
                                    <div class="col-md-1 ml-4">
                                        <form action="{{ route('customer.destroy', $customer->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm" type="submit"
                                                onclick="return confirm ('Yakin hapus User ?')">Hapus</button>
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
