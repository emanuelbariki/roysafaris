@extends('layouts.app')

@can('create::mountainroute')
    @push('action-buttons')
        <div class="col-auto align-self-center">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#createMountainRouteModal">
                <i class="mdi mdi-plus mr-1 icon-xl"></i>
                Add Mountain Route
            </button>
        </div>
    @endpush
@endcan

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <table id="datatable" class="table table-bordered table-striped dt-responsive table-hover nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Mountain</th>
                            <th>Min Days</th>
                            <th>Max Days</th>
                            <th>Status</th>
                            @canany(['edit::mountainroute', 'delete::mountainroute'])
                                <th>Actions</th>
                            @endcanany
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mountainroutes as $route)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $route->name }}</td>
                                <td>{{ $route->code }}</td>
                                <td>{{ $route->mountain?->name ?? '-' }}</td>
                                <td>{{ $route->min_days ?? '-' }}</td>
                                <td>{{ $route->max_days ?? '-' }}</td>
                                <td>
                                    <span class="badge badge-{{ $route->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ $route->status ?? 'N/A' }}
                                    </span>
                                </td>
                                @canany(['edit::mountainroute', 'delete::mountainroute'])
                                    <td>
                                        @can('edit::mountainroute')
                                            <button type="button"
                                                    class="btn btn-primary btn-icon-square-sm edit-route-btn"
                                                    data-id="{{ $route->id }}"
                                                    data-name="{{ $route->name }}"
                                                    data-code="{{ $route->code }}"
                                                    data-description="{{ $route->description ?? '' }}"
                                                    data-mountain_id="{{ $route->mountain_id ?? '' }}"
                                                    data-min_days="{{ $route->min_days ?? '' }}"
                                                    data-max_days="{{ $route->max_days ?? '' }}"
                                                    data-status="{{ $route->status ?? '' }}"
                                                    title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endcan

                                        @can('delete::mountainroute')
                                            <form action="{{ route('mountainroutes.destroy', $route) }}" method="POST"
                                                  style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger btn-icon-square-sm ml-1"
                                                        onclick="return confirm('Are you sure you want to delete this mountain route?')"
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
@endsection

@push('modal')
    <!-- Create Mountain Route Modal -->
    <div class="modal fade" id="createMountainRouteModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="createMountainRouteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" action="{{ route('mountainroutes.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="createMountainRouteModalLabel">Add Mountain Route</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="create_name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="create_name" name="name"
                                       placeholder="MACHAME, SHIRA, RONGAI, etc." required
                                       value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="create_code">Code</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                       id="create_code" name="code"
                                       placeholder="Auto-generated if empty"
                                       value="{{ old('code') }}">
                                @error('code')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="create_description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="create_description" name="description"
                                          rows="3"
                                          placeholder="Route description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="create_mountain_id">Mountain</label>
                                <select name="mountain_id" class="form-control @error('mountain_id') is-invalid @enderror"
                                        id="create_mountain_id">
                                    <option value="">Select Mountain</option>
                                    @foreach($mountains as $mountain)
                                        <option value="{{ $mountain->id }}" {{ old('mountain_id') == $mountain->id ? 'selected' : '' }}>
                                            {{ $mountain->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mountain_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="create_status">Status</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror"
                                        id="create_status">
                                    <option value="">Select Status</option>
                                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="create_min_days">Min Days</label>
                                <input type="number" class="form-control @error('min_days') is-invalid @enderror"
                                       id="create_min_days" name="min_days"
                                       min="1" max="100"
                                       placeholder="Minimum days"
                                       value="{{ old('min_days') }}">
                                @error('min_days')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="create_max_days">Max Days</label>
                                <input type="number" class="form-control @error('max_days') is-invalid @enderror"
                                       id="create_max_days" name="max_days"
                                       min="1" max="100"
                                       placeholder="Maximum days"
                                       value="{{ old('max_days') }}">
                                @error('max_days')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
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

    <!-- Edit Mountain Route Modal -->
    <div class="modal fade" id="editMountainRouteModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="editMountainRouteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" id="editMountainRouteForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editMountainRouteModalLabel">Edit Mountain Route</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="edit_name" name="name"
                                       placeholder="MACHAME, SHIRA, RONGAI, etc." required
                                       value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_code">Code</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                       id="edit_code" name="code"
                                       placeholder="Route Code"
                                       value="{{ old('code') }}">
                                @error('code')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="edit_description" name="description"
                                          rows="3"
                                          placeholder="Route description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_mountain_id">Mountain</label>
                                <select name="mountain_id" class="form-control @error('mountain_id') is-invalid @enderror"
                                        id="edit_mountain_id">
                                    <option value="">Select Mountain</option>
                                    @foreach($mountains as $mountain)
                                        <option value="{{ $mountain->id }}">{{ $mountain->name }}</option>
                                    @endforeach
                                </select>
                                @error('mountain_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_status">Status</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror"
                                        id="edit_status">
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_min_days">Min Days</label>
                                <input type="number" class="form-control @error('min_days') is-invalid @enderror"
                                       id="edit_min_days" name="min_days"
                                       min="1" max="100"
                                       placeholder="Minimum days"
                                       value="{{ old('min_days') }}">
                                @error('min_days')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_max_days">Max Days</label>
                                <input type="number" class="form-control @error('max_days') is-invalid @enderror"
                                       id="edit_max_days" name="max_days"
                                       min="1" max="100"
                                       placeholder="Maximum days"
                                       value="{{ old('max_days') }}">
                                @error('max_days')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
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

            $('.edit-route-btn').on('click', function () {
                var routeId = $(this).data('id');
                var name = $(this).data('name');
                var code = $(this).data('code');
                var description = $(this).data('description');
                var mountain_id = $(this).data('mountain_id');
                var min_days = $(this).data('min_days');
                var max_days = $(this).data('max_days');
                var status = $(this).data('status');

                $('#edit_id').val(routeId);
                $('#edit_name').val(name);
                $('#edit_code').val(code);
                $('#edit_description').val(description);
                $('#edit_mountain_id').val(mountain_id);
                $('#edit_min_days').val(min_days);
                $('#edit_max_days').val(max_days);
                $('#edit_status').val(status);

                $('#editMountainRouteForm input, #editMountainRouteForm select, #editMountainRouteForm textarea').removeClass('is-invalid');
                $('#editMountainRouteForm .invalid-feedback').text('');

                var updateUrl = '{{ route('mountainroutes.update', ':id') }}'.replace(':id', routeId);
                $('#editMountainRouteForm').attr('action', updateUrl);

                $('#editMountainRouteModal').modal('show');
            });

            @if($errors->any() && old('id'))
            $(document).ready(function () {
                var routeId = {{ old('id') }};
                $('#edit_id').val(routeId);
                $('#edit_name').val('{{ old('name') }}');
                $('#edit_code').val('{{ old('code') }}');
                $('#edit_description').val('{{ old('description') }}');
                $('#edit_mountain_id').val('{{ old('mountain_id') }}');
                $('#edit_min_days').val('{{ old('min_days') }}');
                $('#edit_max_days').val('{{ old('max_days') }}');
                $('#edit_status').val('{{ old('status') }}');

                var updateUrl = '{{ route('mountainroutes.update', ':id') }}'.replace(':id', routeId);
                $('#editMountainRouteForm').attr('action', updateUrl);
                $('#editMountainRouteModal').modal('show');
            });
            @endif

            $('#editMountainRouteForm input, #editMountainRouteForm select, #editMountainRouteForm textarea').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });

            $('#createMountainRouteModal input, #createMountainRouteModal select, #createMountainRouteModal textarea').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>
@endpush
