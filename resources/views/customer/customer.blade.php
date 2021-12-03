@extends('layouts.app')
@section('breadcrumb')
    <h1 class="h3 mb-0 text-gray-800">Customer</h1>
@endsection
@section('css')
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
    ::-webkit-input-placeholder,
    :-ms-input-placeholder,
    :-moz-placeholder,
    ::-moz-placeholder {
        text-align: center;
    }
</style>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Customer Configuration</h6>
                <!-- Button trigger modal -->
                <button data-toggle="modal" data-target="#tambahModal" class="btn btn-outline-primary btn-sm">Add
                    Customer</button>
                @include('customer.modals.addCustomer')
                @include('customer.modals.updateCustomer')
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm"  id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Fax</th>
                            <th>Phone</th>
                            <th>NPWP</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Customer as $customer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->fax }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->npwp }}</td>
                                <td>{{ $customer->email }}</td>
                                <td class="row">
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                            data-target="#updateModal-{{ $customer->id }}">
                                            Edit
                                        </button>
                                    </div>
                                    <div class="col-md-1 ml-4">
                                        <form action="{{ route('customer.destroy', $customer->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm" type="submit"
                                                onclick="return confirm ('Yakin hapus User ?')">Remove</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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

            $('.npwp').keyup(function() {
                const val = $(this).val();
                const id = $(this).attr('id');

                if(id == 'npwp_1' && val.length > 2) $(this).val(val.substring(0, 2));
                if(id == 'npwp_2' && val.length > 3) $(this).val(val.substring(0, 3));
                if(id == 'npwp_3' && val.length > 3) $(this).val(val.substring(0, 3));
                if(id == 'npwp_4' && val.length > 1) $(this).val(val.substring(0, 1));
                if(id == 'npwp_5' && val.length > 3) $(this).val(val.substring(0, 3));
                if(id == 'npwp_6' && val.length > 3) $(this).val(val.substring(0, 3));

                console.log(id == '1' && val.length > 2, id, val.length);
            });

            $('#npwp_6').blur(function() {
                var ek = $('.npwp').map((_,el) => el.value).get()

                $('[name="npwp"]').val(ek.join(''));
            });

            $('.npwp_edit').keyup(function() {
                const val = $(this).val();
                const id = $(this).attr('id');

                if(id == 'npwp_edit_1' && val.length > 2) $(this).val(val.substring(0, 2));
                if(id == 'npwp_edit_2' && val.length > 3) $(this).val(val.substring(0, 3));
                if(id == 'npwp_edit_3' && val.length > 3) $(this).val(val.substring(0, 3));
                if(id == 'npwp_edit_4' && val.length > 1) $(this).val(val.substring(0, 1));
                if(id == 'npwp_edit_5' && val.length > 3) $(this).val(val.substring(0, 3));
                if(id == 'npwp_edit_6' && val.length > 3) $(this).val(val.substring(0, 3));

                console.log(id == '1' && val.length > 2, id, val.length);
            }).blur(function() {
                var ek = $('.npwp_edit').map((_,el) => el.value).get()

                $('[name="npwp"]').val(ek.join(''));
            });
        });
    </script>
@endsection
