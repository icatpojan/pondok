@extends('layouts.app')

@section('content')
  <form action="{{ route('tugasguru') }}" method="GET" class="mb-4">
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
                        <button type="submit" class="btn btn-success">Filter</button>
                        <a href="{{ route('tugasguru') }}" class="btn btn-secondary">Reset</a>
                        <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#createTugasGuruModal">
                            + Tugas
                        </button>
                    </div>
                </div>
            </form>
    <div class="card shadow mb-4 mt-2" id="ListTugasGuru">

        <!-- Create TugasGuru Modal -->
        <div class="modal fade" id="createTugasGuruModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="createTugasGuruModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('tugasguru.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Judul</label>
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
                                    <option value="">pilih mapel kelas</option>
                                    @foreach ($mapelkelass as $mapelkelas)
                                        <option value="{{ $mapelkelas->id }}">
                                            {{ $mapelkelas->mapel->name . '-' . $mapelkelas->kelas->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="batas_waktu" class="form-label">Batas Waktu</label>
                                <input type="datetime-local" class="form-control" id="batas_waktu" name="batas_waktu"
                                    value="{{ old('batas_waktu') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">Upload File</label>
                                <input type="file" class="form-control" id="file" name="file" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
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
                            <th>ID</th>
                            <th>Judul</th>
                            @role('admin')
                                <th>Guru</th>
                            @endrole
                            <th>Mapel kelas</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tugasguru as $tugasguruItem)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tugasguruItem->name }}</td>
                                @role('admin')
                                    <td>{{ $tugasguruItem->mapelkelas->user->username ?? '' }}</td>
                                @endrole
                                <td>{{ $tugasguruItem->mapelkelas->kelas->name }}{{ $tugasguruItem->mapelkelas->mapel->name }}
                                </td>
                                <td>
                                    <form action="{{ route('tugasguru.destroy', $tugasguruItem->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this class?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#editTugasGuruModal-{{ $tugasguruItem->id }}">
                                        <i class="fa fa-pen"></i>
                                    </button>

                                    <!-- Edit TugasGuru Modal -->
                                    <div class="modal fade" id="editTugasGuruModal-{{ $tugasguruItem->id }}"
                                        data-backdrop="static" data-keyboard="false" tabindex="-1"
                                        aria-labelledby="editTugasGuruModalLabel-{{ $tugasguruItem->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('tugasguru.update', $tugasguruItem->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Judul</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" value="{{ $tugasguruItem->name }}"
                                                                required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $tugasguruItem->deskripsi }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="mapelkelas" class="form-label">Mapel Kelas</label>
                                                            <select class="form-control" id="mapelkelas"
                                                                name="mapel_kelas_id" required>
                                                                <option value="">Pilih Mapel Kelas</option>
                                                                @foreach ($mapelkelass as $mapelkelas)
                                                                    <option value="{{ $mapelkelas->id }}"
                                                                        {{ $tugasguruItem->mapel_kelas_id == $mapelkelas->id ? 'selected' : '' }}>
                                                                        {{ $mapelkelas->mapel->name . ' - ' . $mapelkelas->kelas->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="batas_waktu" class="form-label">Batas
                                                                Waktu</label>
                                                            <input type="datetime-local" class="form-control"
                                                                id="batas_waktu" name="batas_waktu"
                                                                value="{{ old('batas_waktu', $tugasguruItem->batas_waktu ? $tugasguruItem->batas_waktu->format('Y-m-d\TH:i') : '') }}"
                                                                required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="file" class="form-label">Upload File</label>
                                                            <input type="file" class="form-control" id="file"
                                                                name="file">
                                                        </div>
                                                        @if ($tugasguruItem->file)
                                                            <div class="mb-3">
                                                                <label for="file" class="form-label">
                                                                    File Saat ini</label>
                                                                <a class="btn btn-sm btn-success w-100 mt-2"
                                                                    href="{{ asset('storage/' . $tugasguruItem->file) }}"
                                                                    target="_blank">
                                                                    lihat
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Update</button>
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
                        {{ $tugasguru->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
