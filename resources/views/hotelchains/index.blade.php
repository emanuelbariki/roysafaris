@extends('layouts.app')

@can('create::hotelchain')
    @push('action-buttons')
        <div class="col-auto align-self-center">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#createHotelChainModal">
                <i class="mdi mdi-plus mr-1 icon-xl"></i>
                Add Hotel Chain
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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Bank Name</th>
                            <th>Bank Account</th>
                            <th>Status</th>
                            @canany(['edit::hotelchain', 'delete::hotelchain'])
                                <th>Actions</th>
                            @endcanany
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hotelchains as $hotelchain)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $hotelchain->name }}</td>
                                <td>{{ $hotelchain->code }}</td>
                                <td>{{ $hotelchain->email ?? '-' }}</td>
                                <td>{{ $hotelchain->phone ?? '-' }}</td>
                                <td>{{ $hotelchain->bank_name ?? '-' }}</td>
                                <td>{{ $hotelchain->bank_no ?? '-' }}</td>
                                <td>
                                    <span class="badge badge-{{ $hotelchain->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ $hotelchain->status ?? 'N/A' }}
                                    </span>
                                </td>
                                @canany(['edit::hotelchain', 'delete::hotelchain'])
                                    <td>
                                        @can('edit::hotelchain')
                                            <button type="button"
                                                    class="btn btn-primary btn-icon-square-sm edit-hotelchain-btn"
                                                    data-id="{{ $hotelchain->id }}"
                                                    data-name="{{ $hotelchain->name }}"
                                                    data-code="{{ $hotelchain->code }}"
                                                    data-email="{{ $hotelchain->email ?? '' }}"
                                                    data-phone="{{ $hotelchain->phone ?? '' }}"
                                                    data-bank_name="{{ $hotelchain->bank_name ?? '' }}"
                                                    data-bank_no="{{ $hotelchain->bank_no ?? '' }}"
                                                    data-status="{{ $hotelchain->status ?? '' }}"
                                                    title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endcan

                                        @can('delete::hotelchain')
                                            <form action="{{ route('hotelchains.destroy', $hotelchain) }}" method="POST"
                                                  style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger btn-icon-square-sm ml-1"
                                                        onclick="return confirm('Are you sure you want to delete this hotel chain?')"
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
    <!-- Create Hotel Chain Modal -->
    <div class="modal fade" id="createHotelChainModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="createHotelChainModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" action="{{ route('hotelchains.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="createHotelChainModalLabel">Add Hotel Chain</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="create_name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="create_name" name="name"
                                       placeholder="Elewana, Marriott, etc."
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
                                <label for="create_email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="create_email" name="email"
                                       placeholder="Email Address"
                                       value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="create_phone">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                       id="create_phone" name="phone"
                                       placeholder="Phone Number"
                                       value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="create_bank_name">Bank Name</label>
                                <input type="text" class="form-control @error('bank_name') is-invalid @enderror"
                                       id="create_bank_name" name="bank_name"
                                       placeholder="Bank Name"
                                       value="{{ old('bank_name') }}">
                                @error('bank_name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="create_bank_no">Bank Account Number</label>
                                <input type="text" class="form-control @error('bank_no') is-invalid @enderror"
                                       id="create_bank_no" name="bank_no"
                                       placeholder="Account Number"
                                       value="{{ old('bank_no') }}">
                                @error('bank_no')
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

    <!-- Edit Hotel Chain Modal -->
    <div class="modal fade" id="editHotelChainModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="editHotelChainModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" id="editHotelChainForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editHotelChainModalLabel">Edit Hotel Chain</h6>
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
                                       placeholder="Elewana, Marriott, etc."
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
                                       placeholder="Hotel Chain Code"
                                       value="{{ old('code') }}">
                                @error('code')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="edit_email" name="email"
                                       placeholder="Email Address"
                                       value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_phone">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                       id="edit_phone" name="phone"
                                       placeholder="Phone Number"
                                       value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_bank_name">Bank Name</label>
                                <input type="text" class="form-control @error('bank_name') is-invalid @enderror"
                                       id="edit_bank_name" name="bank_name"
                                       placeholder="Bank Name"
                                       value="{{ old('bank_name') }}">
                                @error('bank_name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_bank_no">Bank Account Number</label>
                                <input type="text" class="form-control @error('bank_no') is-invalid @enderror"
                                       id="edit_bank_no" name="bank_no"
                                       placeholder="Account Number"
                                       value="{{ old('bank_no') }}">
                                @error('bank_no')
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

            // Edit hotel chain button click handler
            $('.edit-hotelchain-btn').on('click', function () {
                var hotelchainId = $(this).data('id');
                var name = $(this).data('name');
                var code = $(this).data('code');
                var email = $(this).data('email');
                var phone = $(this).data('phone');
                var bank_name = $(this).data('bank_name');
                var bank_no = $(this).data('bank_no');
                var status = $(this).data('status');

                // Populate form fields
                $('#edit_id').val(hotelchainId);
                $('#edit_name').val(name);
                $('#edit_code').val(code);
                $('#edit_email').val(email);
                $('#edit_phone').val(phone);
                $('#edit_bank_name').val(bank_name);
                $('#edit_bank_no').val(bank_no);
                $('#edit_status').val(status);

                // Clear any previous validation errors
                $('#editHotelChainForm input, #editHotelChainForm select').removeClass('is-invalid');
                $('#editHotelChainForm .invalid-feedback').text('');

                // Update form action
                var updateUrl = '{{ route('hotelchains.update', ':id') }}'.replace(':id', hotelchainId);
                $('#editHotelChainForm').attr('action', updateUrl);

                // Show the modal
                $('#editHotelChainModal').modal('show');
            });

            // Auto-open edit modal if there are validation errors
            @if($errors->any() && old('id'))
            $(document).ready(function () {
                var hotelchainId = {{ old('id') }};

                // Populate form with old input data
                $('#edit_id').val(hotelchainId);
                $('#edit_name').val('{{ old('name') }}');
                $('#edit_code').val('{{ old('code') }}');
                $('#edit_email').val('{{ old('email') }}');
                $('#edit_phone').val('{{ old('phone') }}');
                $('#edit_bank_name').val('{{ old('bank_name') }}');
                $('#edit_bank_no').val('{{ old('bank_no') }}');
                $('#edit_status').val('{{ old('status') }}');

                // Update form action
                var updateUrl = '{{ route('hotelchains.update', ':id') }}'.replace(':id', hotelchainId);
                $('#editHotelChainForm').attr('action', updateUrl);

                // Show the modal
                $('#editHotelChainModal').modal('show');
            });
            @endif

            // Clear validation errors on input
            $('#editHotelChainForm input, #editHotelChainForm select').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });

            $('#createHotelChainModal input, #createHotelChainModal select').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>
@endpush
