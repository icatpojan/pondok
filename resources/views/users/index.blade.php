@extends('layouts.app')

@section('content')
    <form action="{{ route('user') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <select class="form-control" name="role">
                    <option value="">Pilih Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control" name="kelas">
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelas as $kls)
                        <option value="{{ $kls->id }}" {{ request('kelas') == $kls->id ? 'selected' : '' }}>
                            {{ $kls->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="search" placeholder="Cari username atau nama"
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('user') }}" class="btn btn-secondary">Reset</a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">
                    Tambah User
                </button>
            </div>
        </div>
    </form>
    <div class="card shadow mb-4" id="ListUser">
        <!-- Create User Modal -->
        <div class="modal fade" id="createUserModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="createUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ old('username') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-control" id="role" name="role" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3" id="kelas-container" style="display: none;">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select class="form-control" id="kelas" name="kelas">
                                    @foreach ($kelas as $kls)
                                        <option value="{{ $kls->id }}">{{ $kls->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <script>
                                const roleSelect = document.getElementById('role');
                                const kelasContainer = document.getElementById('kelas-container');

                                roleSelect.addEventListener('change', function() {
                                    if (roleSelect.value === 'murid') {
                                        kelasContainer.style.display = 'block';
                                    } else {
                                        kelasContainer.style.display = 'none';
                                    }
                                });
                            </script>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Kelas</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->kelasnya->name ?? 'tidak memiliki kelas' }}</td>
                                <td>{{ $user->roles->isNotEmpty() ? $user->roles->first()->name : '' }}</td>
                                <td>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#editUserModal-{{ $user->id }}">
                                        <i class="fa fa-pen"></i>
                                    </button>

                                    <!-- Edit User Modal -->
                                    <div class="modal fade" id="editUserModal-{{ $user->id }}"
                                        data-backdrop="static" data-keyboard="false" tabindex="-1"
                                        aria-labelledby="editUserModalLabel-{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('user.update', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Username</label>
                                                            <input type="text" class="form-control" name="username"
                                                                value="{{ $user->username }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="role" class="form-label">Role</label>
                                                            <select class="form-control" name="role" required
                                                                id="role-update-{{ $user->id }}">
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role->name }}"
                                                                        {{ $user->roles->isNotEmpty() && $user->roles->first()->name == $role->name ? 'selected' : '' }}>
                                                                        {{ $role->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="mb-3"
                                                            id="kelas-container-update-{{ $user->id }}"
                                                            style="display: none;">
                                                            <label for="kelas" class="form-label">Kelas</label>
                                                            <select class="form-control"
                                                                id="kelas-update-{{ $user->id }}" name="kelas">
                                                                @foreach ($kelas as $kls)
                                                                    <option value="{{ $kls->id }}"
                                                                        {{ ($user->kelas_id ?? '') == $kls->id ? 'selected' : '' }}>
                                                                        {{ $kls->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Password</label>
                                                            <input type="password" class="form-control" name="password">
                                                            <small class="form-text text-muted">Leave blank if you don't
                                                                want to change the password.</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="d-flex justify-content-center" id="Pagination">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('[id^="role-update-"]').forEach(roleSelect => {

            const userId = roleSelect.id.split('-').pop();
            const kelasContainer = document.getElementById('kelas-container-update-' + userId);

            // Show/hide kelas dropdown based on the selected role on page load
            if (roleSelect.value === 'murid') {
                kelasContainer.style.display = 'block';
            } else {
                kelasContainer.style.display = 'none';
            }

            roleSelect.addEventListener('change', function() {
                if (roleSelect.value === 'murid') {
                    kelasContainer.style.display = 'block';
                } else {
                    kelasContainer.style.display = 'none';
                }
            });
        });
    </script>
@endsection
@section('scripts')
@endsection
