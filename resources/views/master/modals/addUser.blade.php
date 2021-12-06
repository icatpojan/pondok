<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputusername">Username</label>
                        <input required type="text" class="form-control" id="exampleInputusername" autofocus name="username">
                    </div>
                      <div class="form-group">
                        <label for="exampleInputemail">Email</label>
                        <input required type="text" class="form-control" id="exampleInputemail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input required type="password" class="form-control" id="exampleInputPassword"
                            name="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputRole">Role</label>
                        <select required id="role" name="role" class="form-control">
                            @foreach ($Role as $role)
                                <option value="{{ $role->id }}">
                                    {{ ucwords($role->name) }}
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
