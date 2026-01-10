@extends('layouts.app')

@can('create::mountain')
    @push('action-buttons')
        <div class="col-auto align-self-center">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#createMountainModal">
                <i class="mdi mdi-plus mr-1 icon-xl"></i>
                Add Mountain
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
                            <th>Country</th>
                            <th>City</th>
                            <th>Status</th>
                            @canany(['edit::mountain', 'delete::mountain'])
                                <th>Actions</th>
                            @endcanany
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mountains as $mountain)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mountain->name }}</td>
                                <td>{{ $mountain->code }}</td>
                                <td>{{ $mountain->country_id ?? '-' }}</td>
                                <td>{{ $mountain->city_id ?? '-' }}</td>
                                <td>
                                    <span class="badge badge-{{ $mountain->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ $mountain->status ?? 'N/A' }}
                                    </span>
                                </td>
                                @canany(['edit::mountain', 'delete::mountain'])
                                    <td>
                                        @can('edit::mountain')
                                            <button type="button"
                                                    class="btn btn-primary btn-icon-square-sm edit-mountain-btn"
                                                    data-id="{{ $mountain->id }}"
                                                    data-name="{{ $mountain->name }}"
                                                    data-code="{{ $mountain->code }}"
                                                    data-country_id="{{ $mountain->country_id ?? '' }}"
                                                    data-city_id="{{ $mountain->city_id ?? '' }}"
                                                    data-status="{{ $mountain->status ?? '' }}"
                                                    title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endcan

                                        @can('delete::mountain')
                                            <form action="{{ route('mountains.destroy', $mountain) }}" method="POST"
                                                  style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger btn-icon-square-sm ml-1"
                                                        onclick="return confirm('Are you sure you want to delete this mountain?')"
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
    <!-- Create Mountain Modal -->
    <div class="modal fade" id="createMountainModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="createMountainModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{{ route('mountains.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="createMountainModalLabel">Add Mountain</h6>
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
                                       placeholder="Mountain Name" required
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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="create_country_id">Country ID</label>
                                <input type="text" class="form-control @error('country_id') is-invalid @enderror"
                                       id="create_country_id" name="country_id"
                                       placeholder="Country Code (e.g., TZ)"
                                       value="{{ old('country_id') }}">
                                @error('country_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="create_city_id">City ID</label>
                                <input type="text" class="form-control @error('city_id') is-invalid @enderror"
                                       id="create_city_id" name="city_id"
                                       placeholder="City Code (e.g., ARU)"
                                       value="{{ old('city_id') }}">
                                @error('city_id')
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
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Mountain Modal -->
    <div class="modal fade" id="editMountainModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="editMountainModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" id="editMountainForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editMountainModalLabel">Edit Mountain</h6>
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
                                       placeholder="Mountain Name" required
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
                                       placeholder="Mountain Code"
                                       value="{{ old('code') }}">
                                @error('code')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_country_id">Country ID</label>
                                <input type="text" class="form-control @error('country_id') is-invalid @enderror"
                                       id="edit_country_id" name="country_id"
                                       placeholder="Country Code (e.g., TZ)"
                                       value="{{ old('country_id') }}">
                                @error('country_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_city_id">City ID</label>
                                <input type="text" class="form-control @error('city_id') is-invalid @enderror"
                                       id="edit_city_id" name="city_id"
                                       placeholder="City Code (e.g., ARU)"
                                       value="{{ old('city_id') }}">
                                @error('city_id')
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

            $('.edit-mountain-btn').on('click', function () {
                var mountainId = $(this).data('id');
                var name = $(this).data('name');
                var code = $(this).data('code');
                var country_id = $(this).data('country_id');
                var city_id = $(this).data('city_id');
                var status = $(this).data('status');

                $('#edit_id').val(mountainId);
                $('#edit_name').val(name);
                $('#edit_code').val(code);
                $('#edit_country_id').val(country_id);
                $('#edit_city_id').val(city_id);
                $('#edit_status').val(status);

                $('#editMountainForm input, #editMountainForm select').removeClass('is-invalid');
                $('#editMountainForm .invalid-feedback').text('');

                var updateUrl = '{{ route('mountains.update', ':id') }}'.replace(':id', mountainId);
                $('#editMountainForm').attr('action', updateUrl);

                $('#editMountainModal').modal('show');
            });

            @if($errors->any() && old('id'))
            $(document).ready(function () {
                var mountainId = {{ old('id') }};
                $('#edit_id').val(mountainId);
                $('#edit_name').val('{{ old('name') }}');
                $('#edit_code').val('{{ old('code') }}');
                $('#edit_country_id').val('{{ old('country_id') }}');
                $('#edit_city_id').val('{{ old('city_id') }}');
                $('#edit_status').val('{{ old('status') }}');

                var updateUrl = '{{ route('mountains.update', ':id') }}'.replace(':id', mountainId);
                $('#editMountainForm').attr('action', updateUrl);
                $('#editMountainModal').modal('show');
            });
            @endif

            $('#editMountainForm input, #editMountainForm select').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });

            $('#createMountainModal input, #createMountainModal select').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>
@endpush
