@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Type Configuration</h6>
                <!-- Button trigger modal -->
                <button data-toggle="modal" data-target="#tambahModal" class="btn btn-outline-primary btn-sm">Add
                    Type</button>
                @include('product.modals.addType')
                @include('product.modals.updateType')
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm ">
                    <thead class="thead-light">
                        <tr>
                            <th>name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        @foreach ($Type as $type)
                            <tr>
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->category->name }}</td>
                                <td>Rp.{{ number_format($type->price) }}</td>
                                <td>{{ number_format($type->stock) }}</td>
                                <td class="row">
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                            data-target="#updateModal-{{ $type->id }}">
                                            Edit
                                        </button>
                                    </div>
                                    <div class="col-md-1 ml-4">
                                        <form action="{{ route('type.destroy', $type->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm" type="submit"
                                                onclick="return confirm ('Yakin hapus Type ?')">Remove</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tfoot>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Stok Produk tersedia</h6>
                <!-- Button trigger modal -->
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tfoot>
                        @foreach ($Product as $key => $reports)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $reports->count() }}</td>
                            </tr>
                        @endforeach
                    </tfoot>
                </table>
            </div>
        </div>
    </div> --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Stok Produk tersedia</h6>
                <!-- Button trigger modal -->
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
                                    aria-controls="collapse{{ $value->id }}">
                                    <h5>{{ $value->name }}</h5>
                                </button>
                            </h2>
                        </div>

                        <div id="collapse{{ $value->id }}" class="collapse" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                Jumlah stok: {{ $value->product->where('status_id', 1)->count() }}
                                <br>
                                <?php $haha = $value->product->where('status_id', 1)->groupBy(function ($item) {
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
            {{-- <div class="table-responsive">
                <table class="table table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>Stok</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tfoot>
                        @foreach ($Warehouse as $value)
                            <tr>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->product->where('status_id', 1)->count() }}</td>
                                <td>
                                    <?php $haha = $value->product->where('status_id', 1)->groupBy(function ($item) {
                                        return $item->type->name;
                                    }); ?>
                                    @foreach ($haha as $key => $value)
                                        {{ $key }} : {{ $value->count() }}
                                        <br>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tfoot>
                </table>
            </div> --}}
        </div>
    </div>

@endsection
@section('script')
@endsection
