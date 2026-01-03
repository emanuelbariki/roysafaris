@extends('layouts.app')

@push('action-buttons')
    <div class="col-auto align-self-center">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                data-target="#createFleetModal">
            <i class="mdi mdi-plus mr-1 icon-xl"></i>
            Add Fleet
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
                            <th>Make & Model</th>
                            <th>Reg No</th>
                            <th>Type</th>
                            <th>Class</th>
                            <th>Seats</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fleets as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->make_model }}</td>
                                <td>{{ $item->reg_no }}</td>
                                <td>{{ $item->fleetType->name ?? '-' }}</td>
                                <td>{{ $item->fleetClass->name ?? '-' }}</td>
                                <td>{{ $item->seats }}</td>
                                <td>
                                    @if($item->status === 'active')
                                        <span class="badge badge-success">{{ ucfirst($item->status) }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-icon-square-sm edit-fleet-btn"
                                            data-id="{{ $item->id }}"
                                            data-make_model="{{ $item->make_model }}"
                                            data-reg_no="{{ $item->reg_no }}"
                                            data-fleet_type_id="{{ $item->fleet_type_id }}"
                                            data-fleet_class_id="{{ $item->fleet_class_id }}"
                                            data-seats="{{ $item->seats }}"
                                            data-purchase_date="{{ $item->purchase_date }}"
                                            data-mileage="{{ $item->mileage }}"
                                            data-status="{{ $item->status }}"
                                            title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    <form action="{{ route('fleets.destroy', $item->id) }}" method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-icon-square-sm"
                                                onclick="return confirm('Are you sure you want to delete this fleet?')"
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
    <div class="modal fade" id="createFleetModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="createFleetModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{{ route('fleets.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="createFleetModalLabel">Add Fleet</h6>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class="form-group">
                                <label for="makeModel">Make & Model</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('make_model') ? 'is-invalid' : '' }}"
                                       id="makeModel" name="make_model" value="{{ old('make_model') }}"
                                       placeholder="Toyota LandCrusier, Toyota Alphard, etc" required/>
                                @error('make_model')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="reg_no">Registration No</label>
                                <input type="text" class="form-control {{ $errors->has('reg_no') ? 'is-invalid' : '' }}"
                                       id="reg_no" name="reg_no" value="{{ old('reg_no') }}" placeholder="T750 CYM"
                                       required/>
                                @error('reg_no')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="fleet_type_id">Fleet Type</label>
                                <select
                                    class="select2 form-control mb-3 custom-select {{ $errors->has('fleet_type_id') ? 'is-invalid' : '' }}"
                                    name="fleet_type_id" id="fleet_type_id"
                                    style="width: 100%; height:36px;">
                                    <option selected disabled>Choose</option>
                                    @foreach ($fleetTypes as $f)
                                        <option value="{{ $f->id }}">{{ $f->name }}</option>
                                    @endforeach
                                </select>
                                @error('fleet_type_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="fleet_class_id">Fleet Class</label>
                                <select
                                    class="select2 form-control mb-3 custom-select {{ $errors->has('fleet_class_id') ? 'is-invalid' : '' }}"
                                    name="fleet_class_id" id="fleet_class_id"
                                    style="width: 100%; height:36px;">
                                    <option selected disabled>Choose</option>
                                    @foreach ($fleetClasses as $f)
                                        <option value="{{ $f->id }}">{{ $f->name }}</option>
                                    @endforeach
                                </select>
                                @error('fleet_class_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="seats">No. Of Seats</label>
                                <input type="number"
                                       class="form-control {{ $errors->has('seats') ? 'is-invalid' : '' }}"
                                       id="seats" name="seats" value="{{ old('seats') }}" placeholder="1,2,3 etc..."
                                       required/>
                                @error('seats')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="purchase_date">Purchase Date</label>
                                <input type="date"
                                       class="form-control {{ $errors->has('purchase_date') ? 'is-invalid' : '' }}"
                                       id="purchase_date" name="purchase_date" value="{{ old('purchase_date') }}"
                                       placeholder="T750 CYM"
                                       required/>
                                @error('purchase_date')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="mileage">Mileage</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('mileage') ? 'is-invalid' : '' }}"
                                       id="mileage" name="mileage" value="{{ old('mileage') }}"
                                       placeholder="5000,56000, etc..." required/>
                                @error('mileage')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select
                                    class="form-control mb-3 custom-select {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                    name="status" id="status"
                                    style="width: 100%; height:36px;">
                                    <option selected disabled>Choose</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">In Active</option>
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

    <!-- Edit Fleet Modal -->
    <div class="modal fade" id="editFleetModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="editFleetModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" id="editFleetForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_fleet_id" name="fleet_id">

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editFleetModalLabel">Edit Fleet</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="edit_make_model">Make & Model</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('make_model') ? 'is-invalid' : '' }}"
                                       id="edit_make_model" name="make_model"
                                       placeholder="Toyota LandCrusier, Toyota Alphard, etc" required/>
                                @error('make_model')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_reg_no">Registration No</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('reg_no') ? 'is-invalid' : '' }}"
                                       id="edit_reg_no" name="reg_no" placeholder="T750 CYM" required/>
                                @error('reg_no')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_fleet_type_id">Fleet Type</label>
                                <select
                                    class="select2 form-control mb-3 custom-select {{ $errors->has('fleet_type_id') ? 'is-invalid' : '' }}"
                                    name="fleet_type_id" id="edit_fleet_type_id"
                                    style="width: 100%; height:36px;">
                                    <option value="">Choose</option>
                                    @foreach ($fleetTypes as $f)
                                        <option value="{{ $f->id }}">{{ $f->name }}</option>
                                    @endforeach
                                </select>
                                @error('fleet_type_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_fleet_class_id">Fleet Class</label>
                                <select
                                    class="select2 form-control mb-3 custom-select {{ $errors->has('fleet_class_id') ? 'is-invalid' : '' }}"
                                    name="fleet_class_id" id="edit_fleet_class_id"
                                    style="width: 100%; height:36px;">
                                    <option value="">Choose</option>
                                    @foreach ($fleetClasses as $f)
                                        <option value="{{ $f->id }}">{{ $f->name }}</option>
                                    @endforeach
                                </select>
                                @error('fleet_class_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_seats">No. Of Seats</label>
                                <input type="number"
                                       class="form-control {{ $errors->has('seats') ? 'is-invalid' : '' }}"
                                       id="edit_seats" name="seats" placeholder="1,2,3 etc..." required/>
                                @error('seats')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_purchase_date">Purchase Date</label>
                                <input type="date"
                                       class="form-control {{ $errors->has('purchase_date') ? 'is-invalid' : '' }}"
                                       id="edit_purchase_date" name="purchase_date" required/>
                                @error('purchase_date')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_mileage">Mileage</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('mileage') ? 'is-invalid' : '' }}"
                                       id="edit_mileage" name="mileage" placeholder="5000,56000, etc..." required/>
                                @error('mileage')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_status">Status</label>
                                <select
                                    class="form-control mb-3 custom-select {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                    name="status" id="edit_status"
                                    style="width: 100%; height:36px;">
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
            $('.edit-fleet-btn').on('click', function () {
                var fleetId = $(this).data('id');
                var makeModel = $(this).data('make_model');
                var regNo = $(this).data('reg_no');
                var fleetTypeId = $(this).data('fleet_type_id');
                var fleetClassId = $(this).data('fleet_class_id');
                var seats = $(this).data('seats');
                var purchaseDate = $(this).data('purchase_date');
                var mileage = $(this).data('mileage');
                var status = $(this).data('status');

                // Populate form fields directly from button data attributes
                $('#edit_fleet_id').val(fleetId);
                $('#edit_make_model').val(makeModel);
                $('#edit_reg_no').val(regNo);
                $('#edit_fleet_type_id').val(fleetTypeId).trigger('change');
                $('#edit_fleet_class_id').val(fleetClassId).trigger('change');
                $('#edit_seats').val(seats);
                $('#edit_purchase_date').val(purchaseDate);
                $('#edit_mileage').val(mileage);
                $('#edit_status').val(status).trigger('change');

                // Clear any previous validation errors
                $('#editFleetForm input, #editFleetForm select').removeClass('is-invalid');
                $('#editFleetForm .invalid-feedback').text('');

                // Update form action
                var updateUrl = '{{ route('fleets.update', ':id') }}'.replace(':id', fleetId);
                $('#editFleetForm').attr('action', updateUrl);

                // Show the modal
                $('#editFleetModal').modal('show');
            });

            // Auto-open edit modal if there are validation errors
            @if($errors->any() && old('fleet_id'))
            $(document).ready(function () {
                var fleetId = {{ old('fleet_id') }};

                // Populate form with old input data
                $('#edit_fleet_id').val(fleetId);
                $('#edit_make_model').val('{{ old('make_model') }}');
                $('#edit_reg_no').val('{{ old('reg_no') }}');
                $('#edit_fleet_type_id').val('{{ old('fleet_type_id') }}').trigger('change');
                $('#edit_fleet_class_id').val('{{ old('fleet_class_id') }}').trigger('change');
                $('#edit_seats').val('{{ old('seats') }}');
                $('#edit_purchase_date').val('{{ old('purchase_date') }}');
                $('#edit_mileage').val('{{ old('mileage') }}');
                $('#edit_status').val('{{ old('status') }}').trigger('change');

                // Update form action
                var updateUrl = '{{ route('fleets.update', ':id') }}'.replace(':id', fleetId);
                $('#editFleetForm').attr('action', updateUrl);

                // Show the modal
                $('#editFleetModal').modal('show');
            });
            @endif

            // Clear validation errors on input
            $('#editFleetForm input, #editFleetForm select').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });

            // Clear validation errors on input for create form
            $('#createFleetModal input, #createFleetModal select').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>
@endpush

