@foreach ($User as $user)
    <div class="modal fade" id="updateModal-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perbarui User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputusername">Username</label>
                            <input autofocus value="{{ $user->username }}" required type="text" class="form-control"
                                id="exampleInputusername" name="username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputemail">Email</label>
                            <input autofocus value="{{ $user->email }}" required type="text" class="form-control"
                                id="exampleInputemail" name="email">
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputPassword">Password</label>
                            <input value="{{ $user->password }}" required type="password" disabled class="form-control" id="exampleInputPassword" name="password">
                        </div> --}}
                        <div class="form-group">
                            <label for="exampleInputRole">Role</label>
                            <select required name="role" class="form-control">
                                @foreach ($Role as $role)
                                    <option {{ $role->name == $user->getRoleNames()->first() ? 'selected' : '' }}
                                        value="{{ $role->id }}">
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
@endforeach
