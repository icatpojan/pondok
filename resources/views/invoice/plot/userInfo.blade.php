@extends('layouts.app')
@section('breadcrumb')
    <p class="mb-0 text-gray-800">
        <a href="{{ route('invoice.index') }}">Detail Info</a>/
        <a href="{{ route('create.invoice') }}">Invoice Info</a>/
        <a href="{{ route('customerinfo') }}"> Customer Info</a>/
        @if ($Invoice->status == 'invoice')
            <a href="{{ route('transferinfo') }}">Transfer Info</a>/
        @endif
        @if ($Invoice->type == 'AIRTIME' || $Invoice->type == 'VMS dan AIRTIME')
            <a href="{{ route('airtimeinfo') }}">Airtime Info</a>/
        @endif
        User Info
</p>@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive mt-2">
                <table class="table table-sm ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Merek</th>
                            <th>Gudang</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        @foreach ($Detail as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->type->name }}</td>
                                <td>{{ $detail->warehouse->name ?? $detail->warehouse_id }}</td>
                                <form action="{{ route('update.price', $detail->id) }}" method="post">
                                    @csrf
                                    <td><input type="number" name="price" class="form-control"
                                            value="{{ $detail->price }}"></td>
                                    <td class="row">
                                        <div class="col-md-2">
                                            @csrf
                                            <button class="btn btn-outline-primary btn-sm" type="submit">update</button>
                                        </div>
                                </form>
                                <div class="col-md-1 ml-3">
                                    <form action="{{ route('invoice.destroy', $detail->id) }}" method="post">
                                        @csrf
                                        <button class="btn btn-outline-danger btn-sm" type="submit">Remove</button>
                                    </form>
                                </div>
                                </td>
                            </tr>
                        @endforeach
                    </tfoot>
                </table>

                <div class="row">
                    <div class="col">
                        <form action="{{ route('update.sign') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="basic-addon1">Sign :</span>
                                </div>
                                <select name="user_id" id="user" class="form-control">
                                    <option value="">== Select User ==</option>
                                    @foreach ($User as $user)
                                        <option {{ $Invoice->user_id == $user->id ? 'selected' : '' }}
                                            value="{{ $user->id }}">{{ $user->username }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-outline-success">pilih</button>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <form action="{{ route('update.discount') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="basic-addon1">Discount
                                        :</span>
                                </div>
                                <input type="number" name="discount" id="discount" required class="form-control"
                                    placeholder="discount" required value="{{ $Invoice->discount }}">
                                <select name="persen" class="form-control" id="">
                                    <option {{ $Invoice->persen == 'rupiah' ? 'selected' : '' }} value="rupiah">rupiah
                                    </option>
                                    <option {{ $Invoice->persen == 'persen' ? 'selected' : '' }} value="persen">persen
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="region_id">Total</label>
                            <input type="text" class="form-control" disabled value="Rp.{{ number_format($Price) }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="region_id">Diskon</label>
                            @if ($Invoice->persen == 'rupiah')
                                <input type="text" class="form-control" disabled value="Rp.{{ $Invoice->discount }}">
                            @else
                                <input type="text" class="form-control" disabled value="{{ $Invoice->discount }}%">
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="region_id">PPN</label>
                            <input type="text" class="form-control" disabled value="10%">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="region_id">Harga akhir</label>
                            <input type="text" class="form-control" disabled
                                value="Rp.{{ number_format($Invoice->harga_akhir) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    @if ($Invoice->status == 'invoice')
                        <form action="{{ route('checkout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg btn-block">Buat Invoice</button>
                        </form>
                    @else
                        <form action="{{ route('checkout.performa') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg btn-block">Buat Performa</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
