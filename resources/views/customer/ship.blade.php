@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Ship Configuration</h6>
                <!-- Button trigger modal -->
                <button data-toggle="modal" data-target="#tambahModal" class="btn btn-outline-primary btn-sm">Add
                    Ship</button>
                @include('customer.modals.addShip')
                @include('customer.modals.updateShip')
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm" id="dataTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>SN</th>
                            <th>Imei</th>
                            <th>Type</th>
                            <th>Customer</th>
                            <th>Keterangan</th>
                            <th>Airtime start</th>
                            <th>Airtime End</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Ship as $ship)
                            <tr>
                                <td>{{ $ship->name }}</td>
                                <td>{{ $ship->sn }}</td>
                                <td>{{ $ship->imei }}</td>
                                <td>{{ $ship->type }}</td>
                                <td>{{ $ship->customer_id ?? 'tidak diketahui'}}</td>
                                <td>{{ $ship->deskripsi }}</td>
                                <td>{{ $ship->airtime_start->format('d F Y') }}</td>
                                <td>{{ $ship->airtime_end->format('d F Y') }}</td>
                                <td class="row">
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                            data-target="#updateModal-{{ $ship->id }}">
                                            Edit
                                        </button>
                                    </div>
                                    <div class="col-md-1 ml-4">
                                        <form action="{{ route('ship.destroy', $ship->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm" type="submit"
                                                onclick="return confirm ('Yakin hapus ship ?')">Remove</button>
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
