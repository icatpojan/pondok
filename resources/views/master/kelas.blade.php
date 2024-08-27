@extends('layouts.app')

@section('content')
    <div class="card shadow mb-4" id="ListKelas">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Kelas</h6>
                <!-- Button trigger modal for adding kelas -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createKelasModal">
                    Tambah Kelas
                </button>
            </div>
        </div>

        <!-- Create Kelas Modal -->
        <div class="modal fade" id="createKelasModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="createKelasModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('kelas.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Kelas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered dataTable" id="TableKelas">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama kelas</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelas as $kelasItem)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kelasItem->name }}</td>
                                <td>
                                    <form action="{{ route('kelas.destroy', $kelasItem->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this class?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editKelasModal-{{ $kelasItem->id }}">
                                        <i class="fa fa-pen"></i>
                                    </button>

                                    <!-- Edit Kelas Modal -->
                                    <div class="modal fade" id="editKelasModal-{{ $kelasItem->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editKelasModalLabel-{{ $kelasItem->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('kelas.update', $kelasItem->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $kelasItem->name }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="d-flex justify-content-center" id="Pagination">
                        {{ $kelas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
