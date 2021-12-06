<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 140px" id="basic-addon1">Sign :</span>
                    </div>
                    <select name="user_id" id="user" class="form-control">
                        <option value="">== Select User ==</option>
                        @foreach ($User as $user)
                            <option {{ $Invoice->user_id == $user->id ? 'selected' : '' }}
                                value="{{ $user->id }}">{{ $user->username }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success btn-lg btn-block">Buat Invoice</button>
            </div>
        </div>
    </div>
</div>
