@foreach ($Ship as $ship)
    <div class="modal fade" id="updateModal-{{ $ship->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perbarui Kapal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('ship.update', $ship->id) }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="13">Nama</label>
                            <input value="{{ $ship->name }}" required type="text" class="form-control" id="13"
                                name="name">
                        </div>
                        <div class="form-group">
                            <label for="14">SN</label>
                            <input value="{{ $ship->sn }}" required type="text" class="form-control" id="14"
                                name="sn">
                        </div>
                        <div class="form-group">
                            <label for="16">Imei</label>
                            <input value="{{ $ship->imei }}" required type="text" class="form-control" id="16"
                                name="imei">
                        </div>
                        <div class="form-group">
                            <label for="15">Tipe</label>
                            <select name="type" id="5 " class="form-control">
                                <option {{ $ship->type == 'Chopper' ? 'selected' : '' }} value="Chopper">Chopper
                                </option>
                                <option {{ $ship->type == 'Personal' ? 'selected' : '' }} value="Personal">Personal
                                </option>
                                <option {{ $ship->type == 'Vehicle' ? 'selected' : '' }} value="Vehicle">Vehicle
                                </option>
                                <option {{ $ship->type == 'Vessel' ? 'selected' : '' }} value="Vessel">Vessel</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="18">Nama Customer</label>
                            <select name="customer_id" id="6" class="form-control">
                                @foreach ($Customer as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ $ship->customer_id == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="19">Keterangan tambahan</label>
                            <input value="{{ $ship->deskripsi }}" required type="text" class="form-control" id="19"
                                name="deskripsi">
                        </div>
                        <div class="form-group">
                            <label for="21">Airtime Start</label>
                            <input value="{{ $ship->airtime_start->format('Y-m-d') }}" required type="date" class="form-control"
                                id="21" name="airtime_start">
                        </div>
                         <div class="form-group">
                            <label for="21">Airtime End</label>
                            <input value="{{ $ship->airtime_end->format('Y-m-d') }}" required type="date" class="form-control"
                                id="21" name="airtime_end">
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
@endforeach
