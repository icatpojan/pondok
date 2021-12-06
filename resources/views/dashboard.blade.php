@extends('layouts.app')
{{-- @section('breadcrumb')
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
@endsection --}}
@section('content')
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('customer.index') }}" style="text-decoration:none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Customer</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $Customer }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('product.index') }}" style="text-decoration:none">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Jumlah Produk tersedia</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $Product }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-boxes fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('ship.index') }}" style="text-decoration:none">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Kapal
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $Ship }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-ship fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('type.index') }}" style="text-decoration:none">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Jumlah Tipe Produk</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $Type }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-boxes fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @foreach ($Tipe as $tipe)
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('stock.index') }}" style="text-decoration:none">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Jumlah {{ $tipe->name }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tipe->stock ?? 0 }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-tv fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('report.index') }}" style="text-decoration:none">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Performa kadaluarsa minggu ini</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $Week }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('report.index') }}" style="text-decoration:none">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Performa kadaluarsa bulan ini</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $Month }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

@endsection
@section('script')

@endsection
