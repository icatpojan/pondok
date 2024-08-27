@extends('layouts.app')

@section('content')
    <div class="card shadow mb-4" id="ListTugasMurid">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <a class="btn btn-primary btn-sm" href="{{ route('tugasmurid') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <span class="ml-3">Tugas Murid</span>
                </h6>
            </div>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered dataTable" id="TableTugasMurid">
                    <thead>
                        <tr>
                            <th>judul</th>
                            <th>deskripsi</th>
                            <th>Batas Waktu</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tugasguru as $tugasguruItem)
                            @if ($tugasguruItem->status)
                                <tr class="table-primary">
                                @else
                                <tr class="table-danger ">
                            @endif
                            <td>{{ $tugasguruItem->name }}</td>
                            <td>{{ $tugasguruItem->deskripsi }}</td>
                            <td>{{ $tugasguruItem->batas_waktu ?? 'belum mengerjakan' }}</td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="{{ asset('storage/' . $tugasguruItem->file) }}"
                                    target="_blank"><i class="fa fa-print"></i></a>
                                @if (!$tugasguruItem->status)
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#editTugasGuruModal-{{ $tugasguruItem->id }}">
                                        <i class="fa fa-pen"></i>
                                    </button>

                                    <div class="modal fade" id="editTugasGuruModal-{{ $tugasguruItem->id }}"
                                        data-backdrop="static" data-keyboard="false" tabindex="-1"
                                        aria-labelledby="editTugasGuruModalLabel-{{ $tugasguruItem->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('tugasmurid.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Judul</label>
                                                            <input type="hidden" class="form-control" name="tugas_id"
                                                                value="{{ $tugasguruItem->id }}" required>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="file" class="form-label">Upload File</label>
                                                            <input type="file" class="form-control" id="file"
                                                                name="file">
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
                                @else
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#showTugasGuruModal-{{ $tugasguruItem->id }}">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <div class="modal fade" id="showTugasGuruModal-{{ $tugasguruItem->id }}"
                                        data-backdrop="static" data-keyboard="false" tabindex="-1"
                                        aria-labelledby="showTugasGuruModalLabel-{{ $tugasguruItem->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Judul</label>
                                                        <input type="text" class="form-control" id="name"
                                                            value="{{ $tugasguruItem->tugas->name }}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" disabled>{{ $tugasguruItem->tugas->name }}</textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">nilai</label>
                                                        <input type="number" class="form-control" id="name"
                                                            value="{{ $tugasguruItem->tugas->nilai }}" disabled>
                                                    </div>
                                                    @if ($tugasguruItem->file)
                                                        <div class="mb-3">
                                                            <label for="file" class="form-label">
                                                                File Saat ini</label>
                                                            <a class="btn btn-sm btn-primary w-100 mt-2"
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
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="d-flex justify-content-center" id="Pagination">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
