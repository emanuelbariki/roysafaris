@extends('layouts.app')

@push('action-buttons')
    <div class="col-auto align-self-center">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createCarrierModal">
            <i class="mdi mdi-plus mr-1 icon-xl"></i>
            Add Carrier
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
                        @foreach($carriers as $item)
                            <tr>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->carrier_type }}</td>
                                <td>{{ $item->email ?? '-' }}</td>
                                <td>{{ $item->phone ?? '-' }}</td>
                                <td>
                                    @if($item->stauts === 'active')
                                        <span class="badge badge-success">{{ ucfirst($item->stauts) }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ ucfirst($item->stauts) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button"
                                            class="btn btn-primary btn-icon-square-sm edit-carrier-btn"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}"
                                            data-carrier_type="{{ $item->carrier_type }}"
                                            data-email="{{ $item->email ?? '' }}"
                                            data-phone="{{ $item->phone ?? '' }}"
                                            data-website="{{ $item->website ?? '' }}"
                                            data-city_id="{{ $item->city_id ?? '' }}"
                                            data-country_id="{{ $item->country_id ?? '' }}"
                                            data-stauts="{{ $item->stauts }}"
                                            title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    <form action="{{ route('carriers.destroy', $item->id) }}" method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-icon-square-sm"
                                                onclick="return confirm('Are you sure you want to delete this carrier?')"
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
    <!-- Create Carrier Modal -->
    <div class="modal fade" id="createCarrierModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="createCarrierModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" action="{{ route('carriers.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="createCarrierModalLabel">Add Carrier</h6>
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
                                <label for="create_carrier_type">Carrier Type</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('carrier_type') ? 'is-invalid' : '' }}"
                                       id="create_carrier_type" name="carrier_type"
                                       value="{{ old('carrier_type') }}"
                                       placeholder="Tour Operator, Travel Agency, etc."
                                       required>
                                @error('carrier_type')
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
                                <label for="create_stauts">Status</label>
                                <select class="form-control custom-select {{ $errors->has('stauts') ? 'is-invalid' : '' }}"
                                        name="stauts" id="create_stauts"
                                        style="width: 100%; height:36px;" required>
                                    <option value="">Choose</option>
                                    <option value="active" {{ old('stauts') === 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ old('stauts') === 'inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                                @error('stauts')
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

    <!-- Edit Carrier Modal -->
    <div class="modal fade" id="editCarrierModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="editCarrierModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" id="editCarrierForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editCarrierModalLabel">Edit Carrier</h6>
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
                                <label for="edit_carrier_type">Carrier Type</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('carrier_type') ? 'is-invalid' : '' }}"
                                       id="edit_carrier_type" name="carrier_type"
                                       placeholder="Tour Operator, Travel Agency, etc."
                                       required>
                                @error('carrier_type')
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
                                <label for="edit_stauts">Status</label>
                                <select class="form-control custom-select {{ $errors->has('stauts') ? 'is-invalid' : '' }}"
                                        name="stauts" id="edit_stauts"
                                        style="width: 100%; height:36px;" required>
                                    <option value="">Choose</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('stauts')
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
            $('.edit-carrier-btn').on('click', function () {
                var carrierId = $(this).data('id');
                var name = $(this).data('name');
                var carrierType = $(this).data('carrier_type');
                var email = $(this).data('email');
                var phone = $(this).data('phone');
                var website = $(this).data('website');
                var countryId = $(this).data('country_id');
                var stauts = $(this).data('stauts');

                // Populate form fields directly from button data attributes
                $('#edit_id').val(carrierId);
                $('#edit_name').val(name);
                $('#edit_carrier_type').val(carrierType);
                $('#edit_email').val(email);
                $('#edit_phone').val(phone);
                $('#edit_website').val(website);
                $('#edit_country_id').val(countryId);
                $('#edit_stauts').val(stauts);

                // Clear any previous validation errors
                $('#editCarrierForm input, #editCarrierForm select').removeClass('is-invalid');
                $('#editCarrierForm .invalid-feedback').text('');

                // Update form action
                var updateUrl = '{{ route('carriers.update', ':id') }}'.replace(':id', carrierId);
                $('#editCarrierForm').attr('action', updateUrl);

                // Show the modal
                $('#editCarrierModal').modal('show');
            });

            // Auto-open edit modal if there are validation errors
            @if($errors->any() && old('id'))
            $(document).ready(function () {
                var carrierId = {{ old('id') }};

                // Populate form with old input data
                $('#edit_id').val(carrierId);
                $('#edit_name').val('{{ old('name') }}');
                $('#edit_carrier_type').val('{{ old('carrier_type') }}');
                $('#edit_email').val('{{ old('email') }}');
                $('#edit_phone').val('{{ old('phone') }}');
                $('#edit_website').val('{{ old('website') }}');
                $('#edit_country_id').val('{{ old('country_id') }}');
                $('#edit_stauts').val('{{ old('stauts') }}');

                // Update form action
                var updateUrl = '{{ route('carriers.update', ':id') }}'.replace(':id', carrierId);
                $('#editCarrierForm').attr('action', updateUrl);

                // Show the modal
                $('#editCarrierModal').modal('show');
            });
            @endif

            // Clear validation errors on input
            $('#editCarrierForm input, #editCarrierForm select').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });

            $('#createCarrierModal input, #createCarrierModal select').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>
@endpush
