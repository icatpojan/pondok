@extends('layouts.app')
@section('breadcrumb')
    <p class="mb-0 text-gray-800">
        <a href="{{ route('invoice.index') }}">Detail Info</a>/
        <a href="{{ route('create.invoice') }}">Invoice Info</a>/
        <a href="{{ route('customerinfo') }}"> Customer Info</a>/
        @if ($Invoice->status == 'invoice')
            <a href="{{ route('transferinfo') }}">Transfer Info</a>/
        @endif
        Airtime Info/
        <a href="{{ route('userinfo') }}"> User Info</a>
    </p>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Airtime info</h6>
                <button data-toggle="modal" data-target="#tambahModal" class="btn btn-outline-primary btn-sm">Search
                    Ship</button>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('airtimeinfo.store') }}" method="POST">
                @csrf
                <div class="row mb-2">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Id Transmiter</label>
                                    <input type="number" name="ship_id" id="ship" required class="form-control"
                                        placeholder="Id Kapal">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Ship Name</label>
                                    <select name="ship_name" id="ship_name" class="form-control haha">
                                        @foreach ($Ship as $ship)
                                            <option {{ $ship->name == $ship->name ? ' selected="selected"' : '' }}
                                                value="{{ $ship->name }}">{{ $ship->name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input disabled type="text" id="ship_name" class="form-control" nama"
                                    placeholder="Nama Kapal"> --}}
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Start Period</label>
                                    <input type="date" name="airtime_start" id="airtime_start" class="form-control"
                                        placeholder="Mulai Periode">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Airtime Price</label>
                                    <input type="number" required name="airtime_price" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Id Airtime</label>
                                    <input type="number" required name="airtime" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">NEXT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
