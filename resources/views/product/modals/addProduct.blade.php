<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambahkan Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('product.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="1">SN</label>
                        <input required type="number" class="form-control" id="1" name="sn">
                    </div>
                     <div class="form-group">
                        <label for="1">Id</label>
                        <input required type="number" class="form-control" id="1" name="product_id">
                    </div>
                    <div class="form-group">
                        <label for="2">Imei</label>
                        <input required type="number" class="form-control" id="2" name="imei">
                    </div>
                    <div class="form-group">
                        <label for="3">Keterangan</label>
                        <input required type="text" class="form-control" id="3" name="keterangan">
                    </div>
                    <div class="form-group">
                        <label for="4">Tanggal Masuk</label>
                        <input required type="date" class="form-control" id="4" name="tgl_masuk">
                    </div>
                    <div class="form-group">
                        <label for="5">Tipe</label>
                        <select name="type_id" id="5" class="form-control">
                            @foreach ($Type as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="6">Gudang</label>
                        <select name="warehouse_id" id="6" class="form-control">
                            @foreach ($Warehouse as $warehouse)
                                <option value="{{ $warehouse->id }}">
                                    {{ $warehouse->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="7">Status</label>
                        <select name="status_id" id="7" class="form-control">
                            @foreach ($Status as $status)
                                <option value="{{ $status->id }}">
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
