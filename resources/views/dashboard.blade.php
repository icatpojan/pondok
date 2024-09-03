@extends('layouts.app')
@section('css')
    {{-- <h1 class="h3 mb-0 text-white">Dashboard</h1> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.min.css">
@endsection
@section('content')
    <div class="container-fluid">
        @role('admin')
            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div style="background: #38CC1A" class="w-100 card  shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <i class="fas fa-users fa-2x text-white"></i>
                                </div>
                                <div class="col auto">
                                    <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Jumlah Murid
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-white">{{ $Guru }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div style="background: #38CC1A" class="w-100 card shadow h-100 py-2 text-left text-start">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <i class="fas fa-users fa-2x text-white"></i>
                                </div>
                                <div class="col auto">
                                    <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Jumlah Guru</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-white">{{ $Murid }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div style="background: #38CC1A" class="w-100 card shadow h-100 py-2 text-left text-start">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <i class="fas fa-users fa-2x text-white"></i>
                                </div>
                                <div class="col auto">
                                    <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Jumlah Mapel</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-white">{{ $Mapel }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endrole
        @if (auth()->user()->hasRole(['guru', 'murid']))
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username"
                                        value="{{ old('username', auth()->user()->username) }}" required>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="photo">Profile Photo</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('photo') is-invalid @enderror"
                                            id="photo" name="photo" accept="image/*">
                                        <label class="custom-file-label" for="photo">Choose file</label>
                                        @error('photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if (auth()->user()->photo)
                                        <img src="{{ asset('storage/' . auth()->user()->photo) }}"
                                            class="img-thumbnail mt-3" style="width: 150px;" alt="Profile Photo">
                                    @endif
                                </div>

                                <div class="form-group text-center mt-4">
                                    <button type="submit" class="btn btn-success btn-block">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('script')
@endsection
