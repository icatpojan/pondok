@extends('layouts.app')

@section('content')
    <div class="card shadow mb-4" id="ListMateri">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Materi</h6>
                <!-- Button trigger modal for adding materi -->

            </div>
        </div>

        <!-- Create Materi Modal -->
        <div class="modal fade" id="createMateriModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="createMateriModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="mapelkelas" class="form-label">mapel kelas</label>
                                <select class="form-control" id="mapelkelas" name="mapel_kelas_id" required>
                                    <option value="">pilih mapelkelas</option>
                                    @foreach ($mapelkelass as $mapelkelas)
                                        <option value="{{ $mapelkelas->id }}">
                                            {{ $mapelkelas->mapel->name . '-' . $mapelkelas->kelas->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">Upload File</label>
                                <input type="file" class="form-control" id="file" name="file" required>
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
            <form action="{{ route('materi') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-9">
                        <select class="form-control" name="mapelkelas">
                            <option value="">Pilih Mapel Kelas</option>
                            @foreach ($mapelkelass as $mapelkelas)
                                <option value="{{ $mapelkelas->id }}"
                                    {{ request('mapelkelas') == $mapelkelas->id ? 'selected' : '' }}>
                                    {{ $mapelkelas->mapel->name . '-' . $mapelkelas->kelas->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('materi') }}" class="btn btn-secondary">Reset</a>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createMateriModal">
                            + Materi
                        </button>
                    </div>
                </div>
            </form>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered dataTable" id="TableMateri">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            @role('admin')
                                <th>Guru</th>
                            @endrole
                            <th>Mapel kelas</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materi as $materiItem)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $materiItem->name }}</td>
                                @role('admin')
                                    <td>{{ $materiItem->mapelkelas->user->username ?? '' }}</td>
                                @endrole
                                <td>{{ $materiItem->mapelkelas->mapel->name }}-{{ $materiItem->mapelkelas->kelas->name }}
                                </td>
                                <td>
                                    <form action="{{ route('materi.destroy', $materiItem->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this class?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#editMateriModal-{{ $materiItem->id }}">
                                        <i class="fa fa-pen"></i>
                                    </button>

                                    <!-- Edit Materi Modal -->
                                    <div class="modal fade" id="editMateriModal-{{ $materiItem->id }}"
                                        data-backdrop="static" data-keyboard="false" tabindex="-1"
                                        aria-labelledby="editMateriModalLabel-{{ $materiItem->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('materi.update', $materiItem->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" value="{{ $materiItem->name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $materiItem->deskripsi }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="mapelkelas" class="form-label">Mapel Kelas</label>
                                                            <select class="form-control" id="mapelkelas"
                                                                name="mapel_kelas_id" required>
                                                                <option value="">Pilih Mapel Kelas</option>
                                                                @foreach ($mapelkelass as $mapelkelas)
                                                                    <option value="{{ $mapelkelas->id }}"
                                                                        {{ $materiItem->mapel_kelas_id == $mapelkelas->id ? 'selected' : '' }}>
                                                                        {{ $mapelkelas->mapel->name . ' - ' . $mapelkelas->kelas->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="file" class="form-label">Upload File</label>
                                                            <input type="file" class="form-control" id="file"
                                                                name="file">
                                                        </div>
                                                        @if ($materiItem->file)
                                                            <div class="mb-3">
                                                                <label for="file" class="form-label">
                                                                    File Saat ini</label>
                                                                <a class="btn btn-sm btn-primary w-100 mt-2"
                                                                    href="{{ asset('storage/' . $materiItem->file) }}"
                                                                    target="_blank">
                                                                    lihat
                                                                </a>
                                                            </div>
                                                        @endif
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
                        {{ $materi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
