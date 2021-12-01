@foreach ($Warehouse as $warehouse)
    <div class="modal fade" id="updateModal-{{ $warehouse->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Warehouse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('warehouse.update', $warehouse->id) }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputname">Name</label>
                            <input value="{{ $warehouse->name }}" required type="text" class="form-control"
                                id="exampleInputname" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputAddress">Address</label>
                            <input value="{{ $warehouse->address }}" required type="text" class="form-control"
                                id="exampleInputAddress" name="address">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputContact">Contact</label>
                            <input value="{{ $warehouse->contact }}" required type="number" class="form-control"
                                id="exampleInputContact" name="contact">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCategory">Category</label>
                            <select name="category" id="" class="form-control" required>
                                <option {{ $warehouse->category == 'kantor cawang' ? ' selected="selected"' : '' }}
                                    value="kantor cawang">kantor cawang</option>
                                <option {{ $warehouse->category == 'koperasi' ? ' selected="selected"' : '' }}
                                    value="koperasi">koperasi</option>
                                <option {{ $warehouse->category == 'agen' ? ' selected="selected"' : '' }}
                                    value="agen">agen</option>
                                <option {{ $warehouse->category == 'satker' ? ' selected="selected"' : '' }}
                                    value="satker">satker</option>
                                <option {{ $warehouse->category == 'partner' ? ' selected="selected"' : '' }}
                                    value="partner">partner</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Email</label>
                            <input value="{{ $warehouse->email }}" required type="email" class="form-control"
                                id="exampleInputEmail" name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputArea">Area</label>
                            <select name="area" class="form-control" id="exampleInputEmail" required>
                                @foreach ($Province as $province)
                                    {{ $selected = '' }}
                                    @if ($province->province_id == $warehouse->area)
                                        {{ $selected = 'selected="selected"' }}
                                    @endif
                                    <option value="{{ $province->province_id }}" {{ $selected }}>
                                        {{ $province->province_name }}
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
