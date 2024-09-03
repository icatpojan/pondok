@extends('layouts.app')

@section('content')
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#createMapelModal">
        Tambah Mapel
    </button>
    <div class="card shadow mb-4" id="ListMapel">

        <!-- Create Mapel Modal -->
        <div class="modal fade" id="createMapelModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="createMapelModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('mapel.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Mapel</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" required>
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

        <div class="">
            @if (session('success'))
                <div class="alert alert-success mb-2">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mapel as $mapelItem)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mapelItem->name }}</td>
                                <td>
                                    <form action="{{ route('mapel.destroy', $mapelItem->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this class?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#editMapelModal-{{ $mapelItem->id }}">
                                        <i class="fa fa-pen"></i>
                                    </button>

                                    <!-- Edit Mapel Modal -->
                                    <div class="modal fade" id="editMapelModal-{{ $mapelItem->id }}" data-backdrop="static"
                                        data-keyboard="false" tabindex="-1"
                                        aria-labelledby="editMapelModalLabel-{{ $mapelItem->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('mapel.update', $mapelItem->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" value="{{ $mapelItem->name }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
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
                        {{ $mapel->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
