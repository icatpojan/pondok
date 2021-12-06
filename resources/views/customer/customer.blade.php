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
    .npwp,
    .npwp_edit {
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

            // npwp form
            function validateNPWP(arg) {
                const reg = "/^([\d]{2}[.][\d]{3}[.][\d]{3}[.][\d]{1}[-][\d]{3}[.][\d]{3})/g";
                let regexp = new RegExp(reg);

                return regexp.test(arg);
            }

            $('#7, .npwp_edit').blur(function() { // input npwp di addCostumer dan updateCostumer
                let intval = $(this).val().replace(/[^0-9]/g, ''); // remove all except number
                if(intval.length != 15) { // validasi panjang number
                    $(this).addClass('is-invalid').val('').focus();
                }else if( !validateNPWP($(this).val()) ) {
                    let arr = [...intval]; // spread value
                    let data = '';

                    for(let i=0; i<arr.length; i++) {
                        if(i == 2) {
                            data += '.';
                        } else if(i == 5) {
                            data += '.';
                        } else if(i == 8) {
                            data += '.';
                        } else if(i == 9) {
                            data += '-';
                        } else if(i == 12) {
                            data += '.';
                        }

                        data += arr[i].toString(); // masukkan ke dalam string

                        // console.log(i, data); // untuk cek data
                    }

                    $(this).val(data).removeClass('is-invalid').addClass('is-valid');
                }
            }).focus(function() { // focus menghilangkan value yang ada
                $(this).removeClass('is-valid');
                $(this).val('');
            })
        });
    </script>
@endsection
