@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit Customer</h6>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('customer.update', $Customer->id) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="13">Nama</label>
                        <input value="{{ old('name') ?? $Customer->name }}" required type="text" class="form-control"
                            id="13" name="name">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="19">NPWP</label>
                        <input value="{{ $Customer->npwp }}" required type="number" class="form-control" id="19"
                            name="npwp">
                        @if ($errors->has('npwp'))
                            <span class="text-danger">{{ $errors->first('npwp') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="14">Alamat</label>
                        <textarea id="14" rows="3" name="address"
                            class="form-control">{{ $Customer->address }}</textarea>
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="15">Kategori</label>
                        <select name="type" class="form-control" id="3">
                            <option {{ $Customer->type == 'fishing' ? 'selected' : '' }} value="fishing">fishing
                            </option>
                            <option {{ $Customer->type == 'oil and gas' ? 'selected' : '' }} value="oil and gas">
                                oil and gas</option>
                            <option {{ $Customer->type == 'mining' ? 'selected' : '' }} value="mining">mining
                            </option>
                            <option {{ $Customer->type == 'cemercial transportation' ? 'selected' : '' }}
                                value="cemercial transportation">cemercial transportation</option>
                            <option {{ $Customer->type == 'cargo' ? 'selected' : '' }} value="cargo">cargo
                            </option>
                            <option {{ $Customer->type == 'goverment' ? 'selected' : '' }} value="goverment">
                                goverment</option>
                        </select>
                        @if ($errors->has('type'))
                            <span class="text-danger">{{ $errors->first('type') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="16">Kontak</label>
                        <input value="{{ $Customer->contact }}" required type="number" class="form-control" id="16"
                            name="contact">
                        @if ($errors->has('contact'))
                            <span class="text-danger">{{ $errors->first('contact') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="17">Fax</label>
                        <input value="{{ $Customer->fax }}" required type="number" class="form-control" id="17"
                            name="fax">
                        @if ($errors->has('fax'))
                            <span class="text-danger">{{ $errors->first('fax') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="18">Telp</label>
                        <input value="{{ $Customer->phone }}" required type="number" class="form-control" id="18"
                            name="phone">
                        @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="20">Email</label>
                        <input value="{{ $Customer->email }}" required type="text" class="form-control" id="20"
                            name="email">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="province">Provinsi</label>
                        <select name="province_id" id="province" class="form-control">
                            <option value="">== Select Province ==</option>
                            @foreach ($Province as $province)
                                <option {{ $Customer->province_id == $province->province_id ? 'selected' : '' }}
                                    value="{{ $province->province_id }}">{{ $province->province_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city">Kota</label>
                        <select name="city_id" id="city" class="form-control">
                            <option value="">== Select City ==</option>
                            @foreach ($City as $city)
                                <option {{ $Customer->city_id == $city->city_id ? 'selected' : '' }}
                                    value="{{ $city->city_id }}">{{ $city->city_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="region_id">Kabupaten</label>
                        <select name="region" id="region" class="form-control">
                            <option value="">== Select Region ==</option>
                            @foreach ($Region as $region)
                                <option {{ $Customer->region_id == $region->region_id ? 'selected' : '' }}
                                    value="{{ $region->region_id }}">{{ $region->region_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="24">Kode pos</label>
                        <input value="{{ $Customer->kode_pos }}" required type="text" class="form-control" id="24"
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
    <script src="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <script>
        $(function() {
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
