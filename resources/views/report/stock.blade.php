@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Stok Produk {{ $Header->name }}</h6>
                <button data-toggle="modal" data-target="#searchModal" class="btn btn-outline-primary btn-sm">Cek
                    stock</button>
                @include('report.modals.searchstock')
            </div>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordionExample">
                @foreach ($Warehouse as $value)
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                    data-target="#collapse{{ $value->id }}" aria-expanded="true"
                                    aria-controls="collapse{{ $value->id }}" style="text-decoration:none">
                                    <h5>{{ $value->name }}</h5>
                                </button>
                            </h2>
                        </div>

                        <div id="collapse{{ $value->id }}" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                Jumlah stok: {{ $value->product->where('status_id', $id)->count() }}
                                <br>
                                <?php $haha = $value->product->where('status_id', $id)->groupBy(function ($item) {
                                    return $item->type->name;
                                }); ?>
                                @foreach ($haha as $key => $value)
                                    {{ $key }} : {{ $value->count() }}
                                    <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
@section('script')
@endsection
