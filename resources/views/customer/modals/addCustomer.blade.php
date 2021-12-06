@extends('layouts.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Customer</h6>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('customer.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="1">Name</label>
                        <input required value="{{ old('name') }}" type="text" class="form-control" id="1" name="name">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="3">Kategori</label>
                        <select name="type" class="form-control" id="3">
                            <option value="fishing">fishing</option>
                            <option value="oil and gas">oil and gas</option>
                            <option value="mining">mining</option>
                            <option value="comercial transportation">comercial transportation</option>
                            <option value="cargo">cargo</option>
                            <option value="goverment">goverment</option>
                        </select>
                        @if ($errors->has('type'))
                            <span class="text-danger">{{ $errors->first('type') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="7">NPWP</label>
                        <input required type="number" value="{{ old('npwp') }}" class="form-control" id="7" name="npwp">
                        @if ($errors->has('npwp'))
                            <span class="text-danger">{{ $errors->first('npwp') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="2">Address</label>
                        <textarea required value="{{ old('address') }}" class="form-control" id="2" name="address"
                            rows="3"></textarea>
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="4">Kontak</label>
                        <input required type="number" value="{{ old('contact') }}" class="form-control" id="4"
                            name="contact">
                        @if ($errors->has('contact'))
                            <span class="text-danger">{{ $errors->first('contact') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="5">Fax</label>
                        <input required type="number" class="form-control" id="5" name="fax">
                        @if ($errors->has('fax'))
                            <span class="text-danger">{{ $errors->first('fax') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="6">No.telp</label>
                        <input required type="number" value="{{ old('phone') }}" class="form-control" id="6"
                            name="phone">
                        @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="7">NPWP</label>
                        <input required type="text" value="{{ old('npwp') }}" class="npwp form-control" id="7"
                            name="npwp" placeholder="xx.xxx.xxx.x-xxx.xxx">
                        @if ($errors->has('npwp'))
                            <span class="text-danger">{{ $errors->first('npwp') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="8">Email</label>
                        <input required type="email" value="{{ old('email') }}" class="form-control" id="8"
                            name="email">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="province">Provinsi</label>
                        <select name="province_id" id="province" class="js-example-basic-single form-control">
                            <option value="">== Select Provinsi ==</option>
                            @foreach ($Province as $province)
                                <option value="{{ $province->province_id }}">{{ $province->province_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('province_id'))
                            <span class="text-danger">{{ $errors->first('province_id') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="city">Kota</label>
                        <select name="city_id" id="city" class="form-control js-example-basic-single">
                            <option value="">== Select Kota ==</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="region_id">Kabupaten</label>
                        <select name="region" id="region" class="form-control js-example-basic-single">
                            <option value="">== Select Kabupaten ==</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="12">Kode Pos</label>
                        <input required type="number" value="{{ old('kode_pos') }}" class="form-control" id="12"
                            name="kode_pos">
                        @if ($errors->has('kode_pos'))
                            <span class="text-danger">{{ $errors->first('kode_pos') }}</span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" href="{{ route('customer.index') }}">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(function() {
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
            $('#province').on('change', function() {
                axios.post('{{ route('province.store') }}', {
                        id: $(this).val()
                    })
                    .then(function(response) {
                        $('#city').empty();

                        $.each(response.data, function(city_id, city_name) {
                            $('#city').append(new Option(city_name, city_id))
                        })
                    });
            });
            $('#city').on('change', function() {
                axios.post('{{ route('region.store') }}', {
                        id: $(this).val()
                    })
                    .then(function(response) {
                        $('#region').empty();

                        $.each(response.data, function(region_id, region_name) {
                            $('#region').append(new Option(region_name, region_id))
                        })
                    });
            });

        });
    </script>
@endsection
