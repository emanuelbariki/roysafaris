@extends('layouts.app')

@push('action-buttons')
    <div class="col-auto align-self-center">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                data-target="#createPermissionModal">
            <i class="mdi mdi-plus mr-1 icon-xl"></i>
            Add Permission
        </button>
    </div>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @foreach($modules as $module)
                        <div class="mb-4">
                            <h4 class="module-title">
                                {{ Str::title(str_replace('_', ' ', $module->slug)) }}
                            </h4>

                            @if($module->permissions->count() > 0)
                                <div class="table-responsive">
                                    <table id="datatable-{{ $module->slug }}"
                                           class="table table-striped table-bordered dt-responsive nowrap"
                                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Ability</th>
                                            <th>Description</th>
                                            <th>Roles</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($module->permissions->sortBy('ability') as $permission)
                                            <tr>
                                                <td>
                                                    <strong>{{ $permission->ability }}</strong>
                                                </td>
                                                <td>{{ $permission->description ?? '-' }}</td>
                                                <td>
                                                    @if($permission->roles->count() > 0)
                                                        <span>
                                                            {{ $permission->roles->count() }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">No roles assigned</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button"
                                                            class="btn btn-primary btn-icon-square-sm edit-permission-btn"
                                                            data-id="{{ $permission->id }}"
                                                            data-module-id="{{ $permission->system_module_id }}"
                                                            data-ability="{{ $permission->ability }}"
                                                            data-description="{{ $permission->description }}"
                                                            title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>

                                                    <form action="{{ route('permissions.destroy', $permission) }}"
                                                          method="POST"
                                                          style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-icon-square-sm"
                                                                onclick="return confirm('Are you sure you want to delete this permission?');"
                                                                title="Delete">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">No permissions in this module.</p>
                            @endif
                        </div>
                        <hr>
                    @endforeach

                    @if($modules->count() === 0)
                        <div class="text-center py-5">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No permissions found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


@push('modal')
    <div class="modal fade" id="createPermissionModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="createPermissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{{ route('permissions.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="createPermissionModalLabel">Add Permission</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="create_system_module_id">Module</label>
                                <select name="system_module_id" id="create_system_module_id"
                                        class="select2 form-control custom-select {{ $errors->has('system_module_id') ? 'is-invalid' : '' }}">
                                    <option value="" disabled>Select Module</option>
                                    @foreach($modules as $module)
                                        <option
                                            value="{{ $module->id }}" {{ old('system_module_id') == $module->id ? 'selected' : '' }}>
                                            {{ Str::title(str_replace('_', ' ', $module->slug)) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('system_module_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="create_ability">Ability</label>
                                <input type="text"
                                       name="ability"
                                       id="create_ability"
                                       class="form-control {{ $errors->has('ability') ? 'is-invalid' : '' }}"
                                       value="{{ old('ability') }}"
                                       placeholder="e.g., users.create">
                                @error('ability')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">
                                    Use dot notation (e.g., users::create, permissions::update)
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="create_description">Description</label>
                                <textarea name="description"
                                          id="create_description"
                                          class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                          rows="3"
                                          placeholder="Optional description">{{ old('description') }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Create Permission</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Permission Modal -->
    <div class="modal fade" id="editPermissionModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="editPermissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" id="editPermissionForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_permission_id" name="permission_id">

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editPermissionModalLabel">Edit Permission</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="edit_system_module_id">Module</label>
                                <select name="system_module_id" id="edit_system_module_id"
                                        class="form-control custom-select {{ $errors->has('system_module_id') ? 'is-invalid' : '' }}">
                                    <option value="">Select Module</option>
                                    @foreach($modules as $module)
                                        <option value="{{ $module->id }}">
                                            {{ Str::title(str_replace('_', ' ', $module->slug)) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('system_module_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_ability">Ability</label>
                                <input type="text"
                                       name="ability"
                                       id="edit_ability"
                                       class="form-control {{ $errors->has('ability') ? 'is-invalid' : '' }}"
                                       placeholder="e.g., users.create">
                                @error('ability')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">
                                    Use dot notation (e.g., users::create, permissions::update)
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="edit_description">Description</label>
                                <textarea name="description"
                                          id="edit_description"
                                          class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                          rows="3"
                                          placeholder="Optional description"></textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Update Permission</button>
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
        $(document).ready(function () {
            // Initialize all datatables
            @foreach($modules as $module)
            $('#datatable-{{ $module->slug }}').DataTable();
            @endforeach

            // Edit button click handler
            $('.edit-permission-btn').on('click', function () {
                var permissionId = $(this).data('id');
                var moduleId = $(this).data('module-id');
                var ability = $(this).data('ability');
                var description = $(this).data('description');

                // Populate form fields
                $('#edit_permission_id').val(permissionId);
                $('#edit_system_module_id').val(moduleId);
                $('#edit_ability').val(ability);
                $('#edit_description').val(description);

                // Clear any previous validation errors
                $('#edit_system_module_id, #edit_ability, #edit_description').removeClass('is-invalid');
                $('.invalid-feedback').text('');

                // Update form action
                var updateUrl = '{{ route('permissions.update', ':id') }}'.replace(':id', permissionId);
                $('#editPermissionForm').attr('action', updateUrl);

                // Show the modal
                $('#editPermissionModal').modal('show');
            });

            // Auto-open edit modal if there are validation errors
            @if($errors->any() && old('permission_id'))
            $(document).ready(function () {
                var permissionId = {{ old('permission_id') }};

                // Populate form with old input data
                $('#edit_permission_id').val(permissionId);
                $('#edit_system_module_id').val('{{ old('system_module_id') }}');
                $('#edit_ability').val('{{ old('ability') }}');
                $('#edit_description').val('{{ old('description') }}');

                // Update form action
                var updateUrl = '{{ route('permissions.update', ':id') }}'.replace(':id', permissionId);
                $('#editPermissionForm').attr('action', updateUrl);

                // Show the modal
                $('#editPermissionModal').modal('show');
            });
            @endif

            // Clear validation errors on input
            $('#edit_system_module_id, #edit_ability, #edit_description').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>
@endpush
