@extends('layouts.app')

@push('action-buttons')
    <div class="col-auto align-self-center">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createServiceProviderModal">
            <i class="mdi mdi-plus mr-1 icon-xl"></i>
            Add Service Provider
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
                            <th>Code</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($serviceproviders as $item)
                            <tr>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->email ?? '-' }}</td>
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
                                            class="btn btn-primary btn-icon-square-sm edit-service-provider-btn"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}"
                                            data-type="{{ $item->type }}"
                                            data-email="{{ $item->email ?? '' }}"
                                            data-phone="{{ $item->phone ?? '' }}"
                                            data-website="{{ $item->website ?? '' }}"
                                            data-address="{{ $item->address ?? '' }}"
                                            data-city_id="{{ $item->city_id ?? '' }}"
                                            data-country_id="{{ $item->country_id ?? '' }}"
                                            data-bill_to="{{ $item->bill_to ?? '' }}"
                                            data-status="{{ $item->status }}"
                                            title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    <form action="{{ route('serviceproviders.destroy', $item->id) }}" method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-icon-square-sm"
                                                onclick="return confirm('Are you sure you want to delete this service provider?')"
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
    <!-- Create Service Provider Modal -->
    <div class="modal fade" id="createServiceProviderModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="createServiceProviderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" action="{{ route('serviceproviders.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="createServiceProviderModalLabel">Add Service Provider</h6>
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
                                <label for="create_type">Type</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}"
                                       id="create_type" name="type"
                                       value="{{ old('type') }}"
                                       placeholder="e.g. Tour Operator, Hotel, Transport Company"
                                       required>
                                @error('type')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="create_email">Email</label>
                                <input type="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       id="create_email" name="email"
                                       value="{{ old('email') }}">
                                @error('email')
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
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="create_website">Website</label>
                                <input type="url"
                                       class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}"
                                       id="create_website" name="website"
                                       value="{{ old('website') }}">
                                @error('website')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="create_address">Address</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                       id="create_address" name="address"
                                       value="{{ old('address') }}">
                                @error('address')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="create_country_id">Country</label>
                                <select class="form-control custom-select {{ $errors->has('country_id') ? 'is-invalid' : '' }}"
                                        name="country_id" id="create_country_id"
                                        style="width: 100%; height:36px;">
                                    <option value="">Choose</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="create_status">Status</label>
                                <select class="form-control custom-select {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                        name="status" id="create_status"
                                        style="width: 100%; height:36px;" required>
                                    <option value="">Choose</option>
                                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h6>Bank Information (Optional)</h6>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="create_bank_name">Bank Name</label>
                                <select class="form-control custom-select"
                                        name="bank_name" id="create_bank_name"
                                        style="width: 100%; height:36px;">
                                    <option value="">Choose</option>
                                    @foreach($banks as $bank)
                                        <option value="{{ $bank->value }}">{{ $bank->getFullName() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="create_bank_no">Account Number</label>
                                <input type="text"
                                       class="form-control"
                                       id="create_bank_no" name="bank_no"
                                       placeholder="Enter account number">
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

    <!-- Edit Service Provider Modal -->
    <div class="modal fade" id="editServiceProviderModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="editServiceProviderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" id="editServiceProviderForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editServiceProviderModalLabel">Edit Service Provider</h6>
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
                                       id="edit_name" name="name"
                                       required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_type">Type</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}"
                                       id="edit_type" name="type"
                                       placeholder="e.g. Tour Operator, Hotel, Transport Company"
                                       required>
                                @error('type')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_email">Email</label>
                                <input type="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       id="edit_email" name="email">
                                @error('email')
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
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_website">Website</label>
                                <input type="url"
                                       class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}"
                                       id="edit_website" name="website">
                                @error('website')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_address">Address</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                       id="edit_address" name="address">
                                @error('address')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_country_id">Country</label>
                                <select class="form-control custom-select {{ $errors->has('country_id') ? 'is-invalid' : '' }}"
                                        name="country_id" id="edit_country_id"
                                        style="width: 100%; height:36px;">
                                    <option value="">Choose</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
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

            // Edit button click handler
            $('.edit-service-provider-btn').on('click', function () {
                var providerId = $(this).data('id');
                var name = $(this).data('name');
                var type = $(this).data('type');
                var email = $(this).data('email');
                var phone = $(this).data('phone');
                var website = $(this).data('website');
                var address = $(this).data('address');
                var countryId = $(this).data('country_id');
                var status = $(this).data('status');

                // Populate form fields directly from button data attributes
                $('#edit_id').val(providerId);
                $('#edit_name').val(name);
                $('#edit_type').val(type);
                $('#edit_email').val(email);
                $('#edit_phone').val(phone);
                $('#edit_website').val(website);
                $('#edit_address').val(address);
                $('#edit_country_id').val(countryId);
                $('#edit_status').val(status);

                // Clear any previous validation errors
                $('#editServiceProviderForm input, #editServiceProviderForm select').removeClass('is-invalid');
                $('#editServiceProviderForm .invalid-feedback').text('');

                // Update form action
                var updateUrl = '{{ route('serviceproviders.update', ':id') }}'.replace(':id', providerId);
                $('#editServiceProviderForm').attr('action', updateUrl);

                // Show the modal
                $('#editServiceProviderModal').modal('show');
            });

            // Auto-open edit modal if there are validation errors
            @if($errors->any() && old('id'))
            $(document).ready(function () {
                var providerId = {{ old('id') }};

                // Populate form with old input data
                $('#edit_id').val(providerId);
                $('#edit_name').val('{{ old('name') }}');
                $('#edit_type').val('{{ old('type') }}');
                $('#edit_email').val('{{ old('email') }}');
                $('#edit_phone').val('{{ old('phone') }}');
                $('#edit_website').val('{{ old('website') }}');
                $('#edit_address').val('{{ old('address') }}');
                $('#edit_country_id').val('{{ old('country_id') }}');
                $('#edit_status').val('{{ old('status') }}');

                // Update form action
                var updateUrl = '{{ route('serviceproviders.update', ':id') }}'.replace(':id', providerId);
                $('#editServiceProviderForm').attr('action', updateUrl);

                // Show the modal
                $('#editServiceProviderModal').modal('show');
            });
            @endif

            // Clear validation errors on input
            $('#editServiceProviderForm input, #editServiceProviderForm select').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });

            $('#createServiceProviderModal input, #createServiceProviderModal select').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>
@endpush
