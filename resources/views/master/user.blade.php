@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('content')
    @include('master.modals.addUser')
    @include('master.modals.updateUser')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Konfigurasi User</h6>
                <!-- Button trigger modal -->
                <button data-toggle="modal" data-target="#tambahModal" class="btn btn-outline-primary btn-sm">Tambah
                    User
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($User as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->getRoleNames()->first() }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                                data-target="#updateModal-{{ $user->id }}">
                                                {{-- <i class="fa fa-gears"></i> --}}
                                                Edit
                                            </button>
                                        </div>
                                        <div class="col-md-1">
                                            <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                                @csrf
                                                <button class="btn btn-outline-danger btn-sm" type="submit"
                                                    onclick="return confirm ('Yakin hapus User ?')">
                                                    {{-- <i class="fas fa-trash"></i> --}}
                                                    Hapus
                                                </button>
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
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection
