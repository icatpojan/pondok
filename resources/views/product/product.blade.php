@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css" />
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Konfigurasi Produk</h6>
                <div>
                    <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal"
                        data-target="#exampleModal">
                        Filter
                    </button>
                    <a href="{{ route('mutasi.index') }}" class="btn btn-outline-success btn-sm">Mutasi
                        Produk</a>
                    <button data-toggle="modal" data-target="#tambahModal" class="btn btn-outline-primary btn-sm">Tambahkan
                        Produk</button>
                </div>
                @include('product.modals.addProduct')
                @include('product.modals.updateProduct')
                @include('product.modals.searchProduct')
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm" id="dataTable">
                    <button class="btn btn-danger btn-sm delete_all" data-url="{{ url('product-delete-all') }}">selected
                        &nbsp;<i class="fa fa-trash"></i></button>
                    <thead class="thead-light">
                        <tr>
                            <th width="50px"><input type="checkbox" id="master"></th>
                            <th>ID</th>
                            <th>SN</th>
                            <th>Imei</th>
                            <th>Keterangan</th>
                            <th>Masuk</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Warehouse</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Product as $product)
                            <tr>
                                <td><input type="checkbox" class="sub_chk" data-id="{{ $product->id }}"></td>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->sn }}</td>
                                <td>{{ $product->imei }}</td>
                                <td>{{ $product->keterangan }}</td>
                                <td>{{ $product->tgl_masuk->format('d M Y') }}</td>
                                <td>{{ number_format($product->type->price) }}</td>
                                <td>{{ $product->type->name ?? 'tanpa keterangan' }}</td>
                                <td>{{ $product->warehouse->name ?? 'tanpa keterangan' }}</td>
                                <td>{{ $product->status->name ?? 'tanpa keterangan' }}</td>
                                <td class="row">
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                            data-target="#updateModal-{{ $product->id }}">
                                            Edit
                                        </button>
                                    </div>
                                    <div class="col-md-1 ml-4">
                                        <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm" type="submit"
                                                onclick="return confirm ('Yakin hapus product ?')">Remove</button>
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
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                aaSorting: [
                    [5, 'desc']
                ],
                bSort: true,
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#master').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });


            $('.delete_all').on('click', function(e) {


                var allVals = [];
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });


                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {


                    var check = confirm("Are you sure you want to delete this row?");
                    if (check == true) {


                        var join_selected_values = allVals.join(",");


                        $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: 'ids=' + join_selected_values,
                            success: function(data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['success']);
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function(data) {
                                alert(data.responseText);
                            }
                        });


                        $.each(allVals, function(index, value) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });
        });
    </script>

@endsection
