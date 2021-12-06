    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
                <!-- Button trigger modal -->
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm ">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>SN</th>
                            <th>Imei</th>
                            <th>Keterangan</th>
                            <th>Tanggal Masuk</th>
                            <th>Harga</th>
                            <th>Tipe</th>
                            <th>Gudang</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Product as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->sn }}</td>
                                <td>{{ $product->imei }}</td>
                                <td>{{ $product->keterangan }}</td>
                                <td>{{ $product->tgl_masuk->format('d F Y') }}</td>
                                <td>{{ $product->type->price }}</td>
                                <td>{{ $product->type->name ?? $product->type_id }}</td>
                                <td>{{ $product->warehouse->name ?? $product->warehouse_id }}</td>
                                <td>{{ $product->status->name ?? $product->status_id }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-1 ml-4">
                                            <form action="{{ route('mutasi.add') }}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $product->sn }}" name="sn">
                                                <button class="btn btn-outline-success btn-sm"
                                                    type="submit">Tambahkan</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
