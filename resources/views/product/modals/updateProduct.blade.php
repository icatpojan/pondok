@foreach ($Product as $product)
    <div class="modal fade" id="updateModal-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('product.update', $product->id) }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="13">SN</label>
                            <input value="{{ $product->sn }}" required type="text" class="form-control" id="13"
                                name="sn">
                        </div>
                         <div class="form-group">
                            <label for="13">id</label>
                            <input value="{{ $product->product_id }}" required type="text" class="form-control" id="13"
                                name="sn">
                        </div>
                        <div class="form-group">
                            <label for="14">Imei</label>
                            <input value="{{ $product->imei }}" required type="text" class="form-control" id="14"
                                name="imei">
                        </div>
                        <div class="form-group">
                            <label for="15">Keterangan</label>
                            <input value="{{ $product->keterangan }}" required type="text" class="form-control"
                                id="15" name="keterangan">
                        </div>
                        <div class="form-group">
                            <label for="17">Type</label>
                            <select name="type_id" id="17" class="form-control">
                                @foreach ($Type as $type)
                                    {{ $selected = '' }}
                                    @if ($product->type_id == $type->id)
                                        {{ $selected = 'selected="selected"' }}
                                    @endif
                                    <option value="{{ $type->id }}" {{ $selected }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="18">warehouse</label>
                            <select name="warehouse_id" id="18" class="form-control">
                                @foreach ($Warehouse as $warehouse)
                                    {{ $selected = '' }}
                                    @if ($product->warehouse_id == $warehouse->id)
                                        {{ $selected = 'selected="selected"' }}
                                    @endif
                                    <option value="{{ $warehouse->id }}" {{ $selected }}>
                                        {{ $warehouse->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="20">Status</label>
                            <select name="status_id" id="6" class="form-control">
                                @foreach ($Status as $status)
                                    {{ $selected = '' }}
                                    @if ($product->status_id == $status->id)
                                        {{ $selected = 'selected="selected"' }}
                                    @endif
                                    <option value="{{ $status->id }}" {{ $selected }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
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
