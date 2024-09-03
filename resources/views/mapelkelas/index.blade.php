@extends('layouts.app')

@section('content')
    <form action="{{ route('mapelkelas') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <select class="form-control" name="user">
                    <option value="">Pilih Guru</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>
                            {{ $user->username }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control" name="kelas">
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelass as $kls)
                        <option value="{{ $kls->id }}" {{ request('kelas') == $kls->id ? 'selected' : '' }}>
                            {{ $kls->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control" name="mapel">
                    <option value="">Pilih Mapel</option>
                    @foreach ($mapels as $mapel)
                        <option value="{{ $mapel->id }}" {{ request('mapel') == $mapel->id ? 'selected' : '' }}>
                            {{ $mapel->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success">Filter</button>
                <a href="{{ route('mapelkelas') }}" class="btn btn-secondary">Reset</a>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createMapelModal">
                    + Mapel
                </button>
            </div>
        </div>
    </form>
    <div class="card shadow mb-4" id="ListMapel">

        <!-- Create Mapel Modal -->
        <div class="modal fade" id="createMapelModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="createMapelModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('mapelkelas.store') }}" method="POST">
                        @csrf
                        <div class="container mt-2">
                            <div class="mb-3 mt-3">
                                <label for="kelas" class="form-label">kelas</label>
                                <select class="form-control" id="kelas" name="kelas_id" required>
                                    <option value="">pilih kelas</option>
                                    @foreach ($kelass as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="mapel" class="form-label">mapel</label>
                                <select class="form-control" id="mapel" name="mapel_id" required>
                                    <option value="">pilih mapel</option>
                                    @foreach ($mapels as $mapel)
                                        <option value="{{ $mapel->id }}">{{ $mapel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="user" class="form-label">user</label>
                                <select class="form-control" id="user" name="guru_id" required>
                                    <option value="">pilih guru</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                                    @endforeach
                                </select>
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
                            <th>No</th>
                            <th>Mapel</th>
                            <th>Kelas</th>
                            <th>Guru</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mapelkelas as $mapelkelasItem)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mapelkelasItem->mapel->name }}</td>
                                <td>{{ $mapelkelasItem->kelas->name }}</td>
                                <td>{{ $mapelkelasItem->user->username }}</td>
                                <td>
                                    <form action="{{ route('mapelkelas.destroy', $mapelkelasItem->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this class?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#editMapelModal-{{ $mapelkelasItem->id }}">
                                        <i class="fa fa-pen"></i>
                                    </button>

                                    <!-- Edit Mapel Modal -->
                                    <div class="modal fade" id="editMapelModal-{{ $mapelkelasItem->id }}"
                                        data-backdrop="static" data-keyboard="false" tabindex="-1"
                                        aria-labelledby="editMapelModalLabel-{{ $mapelkelasItem->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('mapelkelas.update', $mapelkelasItem->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="container mt-2">
                                                            <div class="mb-3 mt-3">
                                                                <label for="kelas" class="form-label">Kelas</label>
                                                                <select class="form-control" id="kelas"
                                                                    name="kelas_id" required>
                                                                    <option value="">Pilih Kelas</option>
                                                                    @foreach ($kelass as $kelas)
                                                                        <option value="{{ $kelas->id }}"
                                                                            {{ $mapelkelasItem->kelas_id == $kelas->id ? 'selected' : '' }}>
                                                                            {{ $kelas->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="mapel" class="form-label">Mapel</label>
                                                                <select class="form-control" id="mapel"
                                                                    name="mapel_id" required>
                                                                    <option value="">Pilih Mapel</option>
                                                                    @foreach ($mapels as $mapel)
                                                                        <option value="{{ $mapel->id }}"
                                                                            {{ $mapelkelasItem->mapel_id == $mapel->id ? 'selected' : '' }}>
                                                                            {{ $mapel->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="user" class="form-label">Guru</label>
                                                                <select class="form-control" id="user"
                                                                    name="guru_id" required>
                                                                    <option value="">Pilih Guru</option>
                                                                    @foreach ($users as $user)
                                                                        <option value="{{ $user->id }}"
                                                                            {{ $mapelkelasItem->guru_id == $user->id ? 'selected' : '' }}>
                                                                            {{ $user->username }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
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
                        {{ $mapelkelas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
