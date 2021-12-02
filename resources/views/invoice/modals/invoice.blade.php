<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('invoice.index') }}" method="GET">
                {{-- @csrf --}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <select id="warehouse" name="warehouse" class="form-control" id="">
                                    <option value="">Warehouse</option>
                                    @foreach ($Warehouse as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group mb-3">
                                <button type="submit" class="btn btn-primary btn-sm btn-block btn-search" size="sm">
                                    CARI
                                </button>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <select id="type" name="type" class="form-control" id="">
                                    <option value="">Type</option>
                                    @foreach ($Type as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <small class="text-success">Pencarian automatis akan dicari produk dengan status
                                tersedia</small>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
