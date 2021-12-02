@extends('layouts.app')
@section('breadcrumb')
    <p class="mb-0 text-gray-800">
        <a href="{{ route('invoice.index') }}">Detail Info</a>/
        <a href="{{ route('create.invoice') }}">Invoice Info</a>/
        <a href="{{ route('customerinfo') }}"> Customer Info</a>/
        <a href="{{ route('transferinfo') }}">Transfer Info</a>/
        <a href="{{ route('airtimeinfo') }}">Airtime Info</a>/
        <a href="{{ route('userinfo') }}"> User Info</a>
</p>@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">User Info</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width: 140px" id="basic-addon1">Sign :</span>
                        </div>
                        <select name="user_id" id="user" class="form-control">
                            <option value="">== Select User ==</option>
                            @foreach ($User as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width: 140px" id="basic-addon1">Discount
                                :</span>
                        </div>
                        <input type="number" name="discount" id="discount" required class="form-control"
                            placeholder="discount" value="0" required>
                        <select name="persen" class="form-control" id="">
                            <option value="rupiah">rupiah</option>
                            <option value="persen">persen</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-success btn-lg btn-block">Buat Invoice</button>
                </div>
            </div>
        </div>
    </div>
@endsection
