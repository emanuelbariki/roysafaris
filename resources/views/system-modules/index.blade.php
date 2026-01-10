@extends('layouts.app')

@can('create::module')
    @push('action-buttons')
        <div class="col-auto align-self-center">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#createSystemModuleModal">
                <i class="mdi mdi-plus mr-1 icon-xl"></i>
                Add System Module
            </button>
        </div>
    @endpush
@endcan

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Module Name</th>
                                <th>Permissions Count</th>
                                <th>Status</th>
                                @canany(['edit::module', 'delete::module'])
                                    <th>Action</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($modules as $module)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ Str::title(str_replace('_', ' ', $module->slug)) }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $module->slug }}</small>
                                    </td>
                                    <td>
                                    <span>
                                        {{ $module->permissions_count }}
                                    </span>
                                    </td>
                                    <td>
                                        @if($module->permissions_count > 0)
                                            <span class="badge badge-success">In Use</span>
                                        @else
                                            <span class="badge badge-warning">Unused</span>
                                        @endif
                                    </td>
                                    @canany(['edit::module', 'delete::module'])
                                        <td>
                                            @can('edit::module')
                                                <button type="button"
                                                        class="btn btn-primary btn-icon-square-sm edit-system-module-btn"
                                                        data-id="{{ $module->id }}"
                                                        data-slug="{{ $module->slug }}"
                                                        title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                            @endcan

                                            @can('delete::module')
                                                <form action="{{ route('system-modules.destroy', $module) }}"
                                                      method="POST"
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-icon-square-sm"
                                                            onclick="return confirm('Are you sure you want to delete this system module?');"
                                                            {{ $module->permissions_count > 0 ? 'disabled' : '' }}
                                                            title="Delete">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    @endcanany
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('modal')
    <!-- Create System Module Modal -->
    <div class="modal fade" id="createSystemModuleModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="createSystemModuleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{{ route('system-modules.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="createSystemModuleModalLabel">Add System Module</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="create_slug">Module Name (Slug)</label>
                                <input type="text"
                                       name="slug"
                                       id="create_slug"
                                       class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}"
                                       value="{{ old('slug') }}"
                                       placeholder="e.g., users, bookings, reservations"
                                       pattern="[a-z0-9_-]+"
                                       required>
                                @error('slug')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">
                                    Use lowercase letters, numbers, hyphens, and underscores only (e.g., users,
                                    bookings, fleet_management)
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Create Module</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit System Module Modal -->
    <div class="modal fade" id="editSystemModuleModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="editSystemModuleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" id="editSystemModuleForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_system_module_id" name="system_module_id">

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editSystemModuleModalLabel">Edit System Module</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="edit_slug">Module Name (Slug)</label>
                                <input type="text"
                                       name="slug"
                                       id="edit_slug"
                                       class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}"
                                       placeholder="e.g., users, bookings, reservations"
                                       pattern="[a-z0-9_-]+"
                                       required>
                                @error('slug')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">
                                    Use lowercase letters, numbers, hyphens, and underscores only (e.g., users,
                                    bookings, fleet_management)
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Update Module</button>
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
            dataTable = $('#datatable').DataTable();

            // Edit button click handler
            $('.edit-system-module-btn').on('click', function () {
                var moduleId = $(this).data('id');
                var slug = $(this).data('slug');

                // Populate form fields
                $('#edit_system_module_id').val(moduleId);
                $('#edit_slug').val(slug);

                // Clear any previous validation errors
                $('#edit_slug').removeClass('is-invalid');
                $('.invalid-feedback').text('');

                // Update form action
                var updateUrl = '{{ route('system-modules.update', ':id') }}'.replace(':id', moduleId);
                $('#editSystemModuleForm').attr('action', updateUrl);

                // Show the modal
                $('#editSystemModuleModal').modal('show');
            });

            // Auto-open edit modal if there are validation errors
            @if($errors->any() && old('system_module_id'))
            $(document).ready(function () {
                var moduleId = {{ old('system_module_id') }};

                // Populate form with old input data
                $('#edit_system_module_id').val(moduleId);
                $('#edit_slug').val('{{ old('slug') }}');

                // Update form action
                var updateUrl = '{{ route('system-modules.update', ':id') }}'.replace(':id', moduleId);
                $('#editSystemModuleForm').attr('action', updateUrl);

                // Show the modal
                $('#editSystemModuleModal').modal('show');
            });
            @endif

            // Clear validation errors on input
            $('#edit_slug').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });

            // Auto-convert to slug format on input
            $('#create_slug, #edit_slug').on('input', function () {
                var val = $(this).val();
                var slug = val.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                $(this).val(slug);
            });
        });
    </script>
@endpush
