@extends('layouts.app')

@section('content')
    <div class="card shadow mb-4" id="ListTugasMurid">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">List Tugas @role('admin')
                        Murid
                    @endrole
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
                            <th>Mapel</th>
                            @role('admin')
                                <th>Kelas</th>
                            @endrole
                            <th>Guru</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mapelkelass as $mapel)
                            @if (!$mapel->status)
                                <tr class="table-primary">
                                @else
                                <tr class="table-danger ">
                            @endif
                            <td>{{ $mapel->mapel->name }}</td>
                            @role('admin')
                                <td>{{ $mapel->kelas->name }}</td>
                            @endrole
                            <td>{{ $mapel->user->username }}</td>
                            <td>
                                <a href="{{ route('tugasmurid.show', $mapel->id) }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-eye"></i></a>
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
