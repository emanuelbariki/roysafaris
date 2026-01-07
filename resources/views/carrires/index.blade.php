@extends('layouts.app')

@push('action-buttons')
    <div class="col-auto align-self-center">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createServiceItemModal">
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
                            <th>S/N</th>
                            <th>Name</th>
                            <th>code</th>
                            <th>City</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($serviceItems as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category }}</td>
                                <td>
                                    @if($item->status === 'active')
                                        <span class="badge badge-success">{{ ucfirst($item->status) }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </td>
                                <td>

                                    <button type="button"
                                            class="btn btn-primary btn-icon-square-sm edit-service-item-btn"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}"
                                            data-category="{{ $item->category }}"
                                            data-status="{{ $item->status }}"
                                            title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    <form action="{{ route('serviceitems.destroy', $item->id) }}" method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-icon-square-sm"
                                                onclick="return confirm('Are you sure you want to delete this service item?')"
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
    <!-- Create Service Item Modal -->
    <div class="modal fade" id="createServiceItemModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="createServiceItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{{ route('serviceitems.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="createServiceItemModalLabel">Add Service Item</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Carriers Name -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Carrier Name</label>
                                    <input type="text"
                                           {{-- onkeyup="generateCode(this)"  --}}
                                           class="form-control" id="name" name="carrier[name]"
                                           placeholder="e.g., Azam Ferries, Air Tanzania" required
                                           value="{{ isset($carrier) ? $carrier->name : old('name') }}">
                                </div>
                            </div>

                            <!-- Carriers Type -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="carrier_type">Carriers Type</label>
                                    <select name="carrier[carrier_type]" class="form-control" required>
                                        <option selected disabled>Choose</option>
                                        <option value="air">Air</option>
                                        <option value="water">Water</option>
                                        <option value="land">Land</option>
                                    </select>
                                </div>
                            </div>


                            <!-- Country -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select onchange="loadcities(this)" name="carrier[country_id]" id=""
                                            class="form-control">
                                        <option disabled selected>Choose</option>
                                        @foreach ($countries as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <!-- City -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <select name="carrier[city_id]" class="form-control" id="city">
                                        <option selected disabled>Choose</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="carrier[phone]"
                                           placeholder="e.g., +255729898652" required
                                           value="{{ isset($carrier) ? $carrier->phone : old('phone') }}">
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="carrier[email]"
                                           placeholder="e.g., info@example.com" required
                                           value="{{ isset($carrier) ? $carrier->email : old('email') }}">
                                </div>
                            </div>

                            <!-- Website -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="url" class="form-control" id="website" name="carrier[website]"
                                           placeholder="e.g., https://example.com" required
                                           value="{{ isset($carrier) ? $carrier->website : old('website') }}">
                                </div>
                            </div>

                            <!-- Bank Details -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name</label>
                                    <select name="bank_name" class="form-control">
                                        <option selected>Choose</option>
                                        @foreach ($banks as $b)
                                            <option value="{{ $b['full_name'] }}">{{ $b['full_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Voucher Copies -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_no">Account No</label>
                                    <input type="text" class="form-control" id="bank_no" name="bank_no"
                                           placeholder="Account No"
                                           value="{{ isset($bank_no) ? $carrier->bank_no : old('bank_no') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="create_status">Status</label>
                                <select
                                    class="form-control custom-select {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                    name="status" id="create_status"
                                    style="width: 100%; height:36px;">
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
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Service Item Modal -->
    <div class="modal fade" id="editServiceItemModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="editServiceItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" id="editServiceItemForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editServiceItemModalLabel">Edit Service Item</h6>
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
                                       id="edit_name" name="name"
                                       value="{{ old('name') }}"
                                       placeholder="Lunch Boxes, Bottled Water, etc.">
                                @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_category">Category</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}"
                                       id="edit_category" name="category"
                                       value="{{ old('category') }}"
                                       placeholder="Food & Beverage, Equipment, etc.">
                                @error('category')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_status">Status</label>
                                <select
                                    class="form-control custom-select {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                    name="status" id="edit_status"
                                    style="width: 100%; height:36px;">
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
            $('.edit-service-item-btn').on('click', function () {
                var serviceItemId = $(this).data('id');
                var name = $(this).data('name');
                var category = $(this).data('category');
                var status = $(this).data('status');

                // Populate form fields directly from button data attributes
                $('#edit_id').val(serviceItemId);
                $('#edit_name').val(name);
                $('#edit_category').val(category);
                $('#edit_status').val(status);

                // Clear any previous validation errors
                $('#edit_name').removeClass('is-invalid');
                $('#edit_category').removeClass('is-invalid');
                $('#edit_status').removeClass('is-invalid');
                $('.invalid-feedback').text('');

                // Update form action
                var updateUrl = '{{ route('serviceitems.update', ':id') }}'.replace(':id', serviceItemId);
                $('#editServiceItemForm').attr('action', updateUrl);

                // Show the modal
                $('#editServiceItemModal').modal('show');
            });

            // Auto-open edit modal if there are validation errors
            @if($errors->any() && old('id'))
            $(document).ready(function () {
                var serviceItemId = {{ old('id') }};

                // Populate form with old input data
                $('#edit_id').val(serviceItemId);
                $('#edit_name').val('{{ old('name') }}');
                $('#edit_category').val('{{ old('category') }}');
                $('#edit_status').val('{{ old('status') }}');

                // Update form action
                var updateUrl = '{{ route('serviceitems.update', ':id') }}'.replace(':id', serviceItemId);
                $('#editServiceItemForm').attr('action', updateUrl);

                // Show the modal
                $('#editServiceItemModal').modal('show');
            });
            @endif

            // Clear validation errors on input
            $('#edit_name, #edit_category, #edit_status').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>
@endpush
