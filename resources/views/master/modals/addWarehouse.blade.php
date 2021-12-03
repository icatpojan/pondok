<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Add Warehouse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('warehouse.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputname">Name</label>
                        <input required type="text" class="form-control" id="exampleInputname" name="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAddress">Address</label>
                        <textarea class="form-control" id="exampleInputAddress" required name="address" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputContact">Contact</label>
                        <input required type="number" class="form-control" id="exampleInputContact" name="contact">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCategory">Category</label>
                        <select name="category" id="" class="form-control">
                            <option value="kantor cawang">kantor cawang</option>
                            <option value="koperasi">koperasi</option>
                            <option value="agen">agen</option>
                            <option value="satker">satker</option>
                            <option value="partner">partner</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Email</label>
                        <input required type="email" class="form-control" id="exampleInputEmail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputArea">Area</label>
                        <select name="area" class="form-control">
                            @foreach ($Province as $province)
                                <option value="{{ $province->province_id }}">{{ $province->province_name }}
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
<!-- Modal -->
