@extends('layouts.app')

@section('content')
    <div class="card shadow mb-4" id="ListTugasMurid">
        <div class="">
            @if (session('success'))
                <div class="alert alert-success mb-2">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
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
                                <tr class="table-success">
                                @else
                                <tr class="table-danger ">
                            @endif
                            <td>{{ $mapel->mapel->name }}</td>
                            @role('admin')
                                <td>{{ $mapel->kelas->name }}</td>
                            @endrole
                            <td>{{ $mapel->user->username }}</td>
                            <td>
                                <a href="{{ route('tugasmurid.show', $mapel->id) }}" class="btn btn-success btn-sm"><i
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
