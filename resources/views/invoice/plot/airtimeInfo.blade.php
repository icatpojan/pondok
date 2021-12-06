@extends('layouts.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
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
                                    <label for="exampleFormControlFile1">Id Airtime</label>
                                    <input type="number" value="{{ $Invoice->airtime_id }}" required name="airtime_id"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Start Periode</label>
                                    <input
                                        value="{{ $Invoice->airtime_start ? $Invoice->airtime_start->format('Y-m-d') : '---' }}"
                                        type="date" name="airtime_start" id="airtime_start" class="form-control"
                                        placeholder="Mulai Periode">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">End Periode</label>
                                    <input type="date" name="airtime_end"
                                        value="{{ $Invoice->airtime_end ? $Invoice->airtime_end->format('Y-m-d') : '---' }}"
                                        id="airtime_end" id="airtime_end" class="form-control"
                                        placeholder="Mulai Periode">
                                </div>
                            </div>
                            {{-- <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Airtime Price</label>
                                    <input type="number" value="{{ $Invoice->airtime_price }}" required
                                        name="airtime_price" class="form-control">
                                </div>
                            </div> --}}
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">NEXT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        $('#airtime_start').on('change', function() {
            var oneYearFromNow = new Date(document.getElementById('airtime_start').value);
            oneYearFromNow.setFullYear(oneYearFromNow.getFullYear() + 1);
            let day = oneYearFromNow.getDate();
            let month = oneYearFromNow.getMonth();
            let year = oneYearFromNow.getFullYear();
            if (day < 10) {
                day = `0${day}`;
            }
            console.log(oneYearFromNow)
            console.log(day)
            document.getElementById("airtime_end").defaultValue = `${year}-${month + 1}-${day}`;
        });
    </script>
@endsection
