 <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Invoice Configuration</h6>
                <!-- Button trigger modal -->
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive mt-2">
                <table class="table table-sm ">
                    <thead class="thead-light">
                        <tr>
                            <th>SN</th>
                            <th>Imei</th>
                            <th>Id</th>
                            <th>Type</th>
                            <th>Warehouse</th>
                            <th>Price</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        @foreach ($Detail as $detail)
                            <tr>
                                <td>{{ $detail->sn }}</td>
                                <td>{{ $detail->imei }}</td>
                                <td>{{ $detail->id }}</td>
                                <td>{{ $detail->type->name }}</td>
                                <td>{{ $detail->warehouse->name ?? $detail->warehouse_id }}</td>
                                <td>{{ $detail->price }}</td>
                                <td>{{ $detail->status->name ?? $detail->status_id }}</td>
                            </tr>
                        @endforeach
                    </tfoot>
                </table>
                <h1 style="color: rgba(206, 203, 203, 0.404); text-align:center; margin-bottom: 10px">
                    HARGA=Rp.{{ $Price }} + PPN 10% =Rp.{{ $PPN }}
                </h1>
            </div>
        </div>
    </div>
