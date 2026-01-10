@extends('layouts.app')

@can('create::user')
    @push('action-buttons')
        <div class="col-auto align-self-center">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#exampleModalDefault">
                <i class="mdi mdi-plus mr-1 icon-xl"></i>
                Add User
            </button>
        </div>
    @endpush
@endcan

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->role->name ?? '-') }}</td>
                                <td>
                                    @canany(['edit::user', 'delete::user'])
                                        @can('edit::user')
                                            <button type="button" class="btn btn-primary btn-icon-square-sm edit-user-btn"
                                                    data-id="{{ $user->id }}"
                                                    data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}"
                                                    data-role="{{ $user->role_id }}"
                                                    title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        @endcan

                                        @can('delete::user')
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                  style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger btn-icon-square-sm"
                                                        onclick="return confirm('Are you sure you want to delete this user?')"
                                                        title="Delete">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    @endcanany
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('modal')
    <div class="modal fade" id="exampleModalDefault" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Add User</h6>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       id="name" name="name" value="{{ old('name') }}" placeholder="Enter name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       id="email" name="email"
                                       value="{{ old('email') }}"
                                       placeholder="Enter email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select
                                    class="select2 form-control mb-3 custom-select {{ $errors->has('role') ? 'is-invalid' : '' }}"
                                    name="role" id="role"
                                    style="width: 100%; height:36px;">
                                    <option value="">Select</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ old('role') == $role->id ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password"
                                       class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                       id="password" name="password"
                                       placeholder="********">
                                @error('password')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_user_id" name="user_id">

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editUserModalLabel">Edit User</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="edit_name">Name</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       id="edit_name" name="name" placeholder="Enter name" required/>
                                @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_email">Email</label>
                                <input type="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       id="edit_email" name="email" placeholder="Enter email" required/>
                                @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_role">Role</label>
                                <select
                                    class="select2 form-control mb-3 custom-select {{ $errors->has('role') ? 'is-invalid' : '' }}"
                                    name="role" id="edit_role"
                                    style="width: 100%; height:36px;">
                                    <option value="">Select</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_password">Password <small class="text-muted">(Leave blank to keep current password)</small></label>
                                <input type="password"
                                       class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                       id="edit_password" name="password" placeholder="********">
                                @error('password')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
@endpush

@push('plugin-scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush

@push('scripts')
    <script>
        var dataTable;

        $(document).ready(function () {
            dataTable = $('#datatable').DataTable();

            // Edit button click handler
            $('.edit-user-btn').on('click', function () {
                var userId = $(this).data('id');
                var userName = $(this).data('name');
                var userEmail = $(this).data('email');
                var userRole = $(this).data('role');

                // Populate form fields directly from button data attributes
                $('#edit_user_id').val(userId);
                $('#edit_name').val(userName);
                $('#edit_email').val(userEmail);
                $('#edit_role').val(userRole).trigger('change');
                $('#edit_password').val(''); // Clear password field

                // Clear any previous validation errors
                $('#editUserForm input, #editUserForm select').removeClass('is-invalid');
                $('#editUserForm .invalid-feedback').text('');

                // Update form action
                var updateUrl = '{{ route('users.update', ':id') }}'.replace(':id', userId);
                $('#editUserForm').attr('action', updateUrl);

                // Show the modal
                $('#editUserModal').modal('show');
            });

            // Auto-open edit modal if there are validation errors
            @if($errors->any() && old('user_id'))
            $(document).ready(function () {
                var userId = {{ old('user_id') }};

                // Populate form with old input data
                $('#edit_user_id').val(userId);
                $('#edit_name').val('{{ old('name') }}');
                $('#edit_email').val('{{ old('email') }}');
                $('#edit_role').val('{{ old('role') }}').trigger('change');
                $('#edit_password').val(''); // Don't populate password on validation error

                // Update form action
                var updateUrl = '{{ route('users.update', ':id') }}'.replace(':id', userId);
                $('#editUserForm').attr('action', updateUrl);

                // Show the modal
                $('#editUserModal').modal('show');
            });
            @endif

            // Auto-open create modal if there are validation errors (but not from edit)
            @if($errors->any() && !old('user_id'))
            $(document).ready(function () {
                $('#exampleModalDefault').modal('show');
            });
            @endif

            // Clear validation errors on input
            $('#editUserForm input, #editUserForm select').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });

            // Clear validation errors on input for create form
            $('#exampleModalDefault input, #exampleModalDefault select').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>
@endpush
