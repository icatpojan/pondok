@extends('layouts.app')
@section('css')

@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Warehouse Configuration</h6>
                <!-- Button trigger modal -->
                <button data-toggle="modal" data-target="#tambahModal" class="btn btn-outline-primary btn-sm">Add
                    Warehouse</button>
                @include('master.modals.addWarehouse')
                @include('master.modals.updateWarehouse')
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Area</th>
                            <th>Category</th>
                            <th>Contact</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Warehouse as $warehouse)
                            <tr>
                                <td>{{ $warehouse->name }}</td>
                                <td>{{ $warehouse->address }}</td>
                                <td>{{ $warehouse->email }}</td>
                                <td>{{ $warehouse->province->province_name ?? 'kosong' }}</td>
                                <td>{{ $warehouse->category }}</td>
                                <td>{{ $warehouse->contact }}</td>
                                <td class="row">
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                            data-target="#updateModal-{{ $warehouse->id }}">
                                            Edit
                                        </button>
                                    </div>
                                    <div class="col-md-3 ml-2">
                                        <form action="{{ route('warehouse.destroy', $warehouse->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm" type="submit"
                                                onclick="return confirm ('Yakin hapus Warehouse ?')">Remove</button>
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
