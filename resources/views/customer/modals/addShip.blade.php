<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ship.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="1">Name</label>
                        <input required type="text" class="form-control" id="1" name="name">
                    </div>
                    <div class="form-group">
                        <label for="2">SN</label>
                        <input required type="number" class="form-control" id="2" name="sn">
                    </div>
                    <div class="form-group">
                        <label for="3">Imei</label>
                        <input required type="number" class="form-control" id="3" name="imei">
                    </div>
                    <div class="form-group">
                        <label for="5">Type</label>
                        <select name="type" id="5 " class="form-control">
                            <option value="Chopper">Chopper</option>
                            <option value="Personal">Personal</option>
                            <option value="Vehicle">Vehicle</option>
                            <option value="Vessel">Vessel</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="6">Customer</label>
                        <select name="customer_id" id="6" class="form-control">
                            @foreach ($Customer as $customer)
                                <option value="{{ $customer->id }}">
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="7">Keterangan tambahan</label>
                        <textarea class="form-control" id="7" name="deskripsi" id="" placeholder="Tambahkan bila ada.." rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="9">Airtime Start</label>
                        <input required type="date" class="form-control" id="9" name="airtime_start">
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
<!-- Modal -->
