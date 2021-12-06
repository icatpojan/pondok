@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Konfigurasi Bank</h6>
                <!-- Button trigger modal -->
                <button data-toggle="modal" data-target="#tambahModal" class="btn btn-outline-primary btn-sm">Tambah Bank</button>
                @include('master.modals.addBank')
                @include('master.modals.updateBank')
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Bank as $bank)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bank->name }}</td>
                                <td class="row">
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                            data-target="#updateModal-{{ $bank->id }}">
                                            Edit
                                        </button>
                                    </div>
                                    <div class="col-md-1">
                                        <form action="{{ route('bank.destroy', $bank->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm" type="submit"
                                                onclick="return confirm ('Yakin hapus bank ?')">Hapus</button>
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
