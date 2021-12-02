@foreach ($Type as $type)
    <div class="modal fade" id="updateModal-{{ $type->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('type.update', $type->id) }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="13">Name</label>
                            <input value="{{ $type->name }}" required type="text" class="form-control" id="13"
                                name="name">
                        </div>
                        <div class="form-group">
                            <label for="14">Category</label>
                            <select name="category_id" id="14" class="form-control">
                                @foreach ($Category as $category)
                                    <option {{ $type->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="15">Price</label>
                            <input value="{{ $type->price }}" required type="number" class="form-control" id="15"
                                name="price">
                        </div>
                        <div class="form-group">
                            <label for="16">Stock</label>
                            <input value="{{ $type->stock }}" required type="number" class="form-control" id="16"
                                name="stock">
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
