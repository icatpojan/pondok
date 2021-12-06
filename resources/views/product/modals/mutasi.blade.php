<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Form mutasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('mutasi.mass') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="warehouse">Gudang Tujuan</label>
                        <select name="warehouse_id" id="warehouse" class="form-control">
                            <option value="">== Select warehouse ==</option>
                            @foreach ($Warehouse as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="time">Tanggal mutasi</label>
                        <input type="date" class="form-control" name="date">
                    </div>
                    <div class="form-group">
                        <label for="reason">Alasan mutasi</label>
                        <textarea name="reason" class="form-control" id="reason" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
