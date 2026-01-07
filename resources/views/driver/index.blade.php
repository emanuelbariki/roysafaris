@extends('layouts.app')

@push('action-buttons')
    <div class="col-auto align-self-center">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createDriverModal">
            <i class="mdi mdi-plus mr-1 icon-xl"></i>
            Add Driver
        </button>
    </div>
@endpush

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
                            <th>License No</th>
                            <th>Driver Type</th>
                            <th>Fleet</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($drivers as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->license_no }}</td>
                                <td>{{ $item->driverType->name ?? '-' }}</td>
                                <td>{{ $item->fleet->make_model ?? '-' }}</td>
                                <td>{{ $item->phone ?? '-' }}</td>
                                <td>
                                    @if($item->status === 'active')
                                        <span class="badge badge-success">{{ ucfirst($item->status) }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button"
                                            class="btn btn-primary btn-icon-square-sm edit-driver-btn"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}"
                                            data-license_no="{{ $item->license_no }}"
                                            data-driver_type_id="{{ $item->driver_type_id }}"
                                            data-fleet_id="{{ $item->fleet_id ?? '' }}"
                                            data-phone="{{ $item->phone ?? '' }}"
                                            data-email="{{ $item->email ?? '' }}"
                                            data-status="{{ $item->status }}"
                                            title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    <form action="{{ route('drivers.destroy', $item->id) }}" method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-icon-square-sm"
                                                onclick="return confirm('Are you sure you want to delete this driver?')"
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
            </div>
        </div>
    </div>
@endsection

@push('modal')
    <!-- Create Driver Modal -->
    <div class="modal fade" id="createDriverModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="createDriverModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" action="{{ route('drivers.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="createDriverModalLabel">Add Driver</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="create_name">Name</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       id="create_name" name="name"
                                       value="{{ old('name') }}"
                                       required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="create_license_no">License No</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('license_no') ? 'is-invalid' : '' }}"
                                       id="create_license_no" name="license_no"
                                       value="{{ old('license_no') }}"
                                       required>
                                @error('license_no')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="create_driver_type_id">Driver Type</label>
                                <select class="form-control custom-select {{ $errors->has('driver_type_id') ? 'is-invalid' : '' }}"
                                        name="driver_type_id" id="create_driver_type_id"
                                        style="width: 100%; height:36px;" required>
                                    <option value="">Choose</option>
                                    @foreach($driverTypes as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('driver_type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('driver_type_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="create_fleet_id">Fleet (Optional)</label>
                                <select class="form-control custom-select {{ $errors->has('fleet_id') ? 'is-invalid' : '' }}"
                                        name="fleet_id" id="create_fleet_id"
                                        style="width: 100%; height:36px;">
                                    <option value="">Choose</option>
                                    @foreach($fleets as $fleet)
                                        <option value="{{ $fleet->id }}"
                                            {{ old('fleet_id') == $fleet->id ? 'selected' : '' }}>
                                            {{ $fleet->make_model }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('fleet_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="create_phone">Phone</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                       id="create_phone" name="phone"
                                       value="{{ old('phone') }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="create_email">Email (Optional)</label>
                                <input type="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       id="create_email" name="email"
                                       value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="create_status">Status</label>
                                <select class="form-control custom-select {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                        name="status" id="create_status"
                                        style="width: 100%; height:36px;" required>
                                    <option value="">Choose</option>
                                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
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

    <!-- Edit Driver Modal -->
    <div class="modal fade" id="editDriverModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="editDriverModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" id="editDriverForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editDriverModalLabel">Edit Driver</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_name">Name</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       id="edit_name" name="name" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_license_no">License No</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('license_no') ? 'is-invalid' : '' }}"
                                       id="edit_license_no" name="license_no" required>
                                @error('license_no')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_driver_type_id">Driver Type</label>
                                <select class="form-control custom-select {{ $errors->has('driver_type_id') ? 'is-invalid' : '' }}"
                                        name="driver_type_id" id="edit_driver_type_id"
                                        style="width: 100%; height:36px;" required>
                                    <option value="">Choose</option>
                                    @foreach($driverTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                @error('driver_type_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_fleet_id">Fleet (Optional)</label>
                                <select class="form-control custom-select {{ $errors->has('fleet_id') ? 'is-invalid' : '' }}"
                                        name="fleet_id" id="edit_fleet_id"
                                        style="width: 100%; height:36px;">
                                    <option value="">Choose</option>
                                    @foreach($fleets as $fleet)
                                        <option value="{{ $fleet->id }}">{{ $fleet->make_model }}</option>
                                    @endforeach
                                </select>
                                @error('fleet_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_phone">Phone</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                       id="edit_phone" name="phone">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_email">Email (Optional)</label>
                                <input type="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       id="edit_email" name="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_status">Status</label>
                                <select class="form-control custom-select {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                        name="status" id="edit_status"
                                        style="width: 100%; height:36px;" required>
                                    <option value="">Choose</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status')
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

            // Edit driver button click handler
            $('.edit-driver-btn').on('click', function () {
                var driverId = $(this).data('id');
                var name = $(this).data('name');
                var licenseNo = $(this).data('license_no');
                var driverTypeId = $(this).data('driver_type_id');
                var fleetId = $(this).data('fleet_id');
                var phone = $(this).data('phone');
                var email = $(this).data('email');
                var status = $(this).data('status');

                // Populate form fields
                $('#edit_id').val(driverId);
                $('#edit_name').val(name);
                $('#edit_license_no').val(licenseNo);
                $('#edit_driver_type_id').val(driverTypeId);
                $('#edit_fleet_id').val(fleetId);
                $('#edit_phone').val(phone);
                $('#edit_email').val(email);
                $('#edit_status').val(status);

                // Clear validation errors
                $('#editDriverForm input, #editDriverForm select').removeClass('is-invalid');
                $('#editDriverForm .invalid-feedback').text('');

                // Update form action
                var updateUrl = '{{ route('drivers.update', ':id') }}'.replace(':id', driverId);
                $('#editDriverForm').attr('action', updateUrl);

                // Show modal
                $('#editDriverModal').modal('show');
            });

            // Auto-open edit modal if validation errors
            @if($errors->any() && old('id'))
            $(document).ready(function () {
                var driverId = {{ old('id') }};

                $('#edit_id').val(driverId);
                $('#edit_name').val('{{ old('name') }}');
                $('#edit_license_no').val('{{ old('license_no') }}');
                $('#edit_driver_type_id').val('{{ old('driver_type_id') }}');
                $('#edit_fleet_id').val('{{ old('fleet_id') }}');
                $('#edit_phone').val('{{ old('phone') }}');
                $('#edit_email').val('{{ old('email') }}');
                $('#edit_status').val('{{ old('status') }}');

                var updateUrl = '{{ route('drivers.update', ':id') }}'.replace(':id', driverId);
                $('#editDriverForm').attr('action', updateUrl);

                $('#editDriverModal').modal('show');
            });
            @endif

            // Clear validation errors
            $('#editDriverForm input, #editDriverForm select').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });

            $('#createDriverModal input, #createDriverModal select').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>
@endpush
