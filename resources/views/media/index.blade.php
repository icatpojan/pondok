@extends('layouts.app')

@section('content')
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#createMediaModal">
        Tambah media
    </button>
    <div class="card shadow mb-4" id="ListMedia">
        <!-- Create Media Modal -->
        <div class="modal fade" id="createMediaModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="createMediaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload File</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="kegiatan">kegiatan</option>
                                    <option value="sekolah">sekolah</option>
                                    <option value="lomba">lomba</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">deskripsi</label>
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                            <th>Gambar</th>
                            <th>tipe</th>
                            <th>deskripsi</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medias as $media)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('storage/' . $media->image) }}" width="200" alt=""></td>
                                <td>{{ $media->type }}</td>
                                <td>{{ $media->deskripsi }}</td>
                                <td>
                                    <form action="{{ route('media.destroy', $media->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this media?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="d-flex justify-content-center" id="Pagination">
                        {{ $medias->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
