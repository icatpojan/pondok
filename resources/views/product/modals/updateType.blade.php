@foreach ($Type as $type)
    <div class="modal fade" id="updateModal-{{ $type->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perbarui Tipe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('type.update', $type->id) }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="13">Nama</label>
                            <input value="{{ $type->name }}" required type="text" class="form-control" id="13"
                                name="name">
                        </div>
                        <div class="form-group">
                            <label for="14">Kategori</label>
                            <select name="category_id" id="14" class="form-control">
                                @foreach ($Category as $category)
                                    <option {{ $type->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="15">Harga</label>
                            <input value="{{ $type->price }}" required type="number" class="form-control" id="15"
                                name="price">
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
@endforeach
