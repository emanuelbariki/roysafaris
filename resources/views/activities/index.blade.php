@extends('layouts.app')

@push('action-buttons')
    <div class="col-auto align-self-center">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                data-target="#createActivityModal">
            <i class="mdi mdi-plus mr-1 icon-xl"></i>
            Add Activity
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
                            <th>Description</th>
                            <th>Price</th>
                            <th>Location</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($activities as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->location }}</td>
                                <td>{{ $item->start_date }}</td>
                                <td>{{ $item->end_date }}</td>
                                <td>
                                    <button type="button"
                                            class="btn btn-primary btn-icon-square-sm edit-activity-btn"
                                            data-id="{{ $item->id }}"
                                            data-activity_code="{{ $item->activity_code }}"
                                            data-name="{{ $item->name }}"
                                            data-description="{{ $item->description }}"
                                            data-price="{{ $item->price }}"
                                            data-location="{{ $item->location }}"
                                            data-start_date="{{ $item->start_date }}"
                                            data-end_date="{{ $item->end_date }}"
                                            title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    <form action="{{ route('activities.destroy', $item->id) }}" method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-icon-square-sm"
                                                onclick="return confirm('Are you sure you want to delete this activity?')"
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
    <div class="modal fade" id="createActivityModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="createActivityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" id="createActivityForm" action="{{ route('activities.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="createActivityModalLabel">Add Activity</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="create_activity_code">Code</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('activity_code') ? 'is-invalid' : '' }}"
                                       id="create_activity_code" name="activity_code"
                                       value="{{ old('activity_code') }}"/>
                                @error('activity_code')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="create_name">Name</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       id="create_name" name="name"
                                       value="{{ old('name') }}"/>
                                @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="create_description">Description</label>
                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                          rows="3"
                                          id="create_description" name="description" required>
                                    {{ old('description') }}
                                </textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="create_price">Price</label>
                                <input type="number"
                                       class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                       id="create_price" name="price" min="0"
                                       value="{{ old('price') }}"/>
                                @error('price')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="create_location">Location</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}"
                                       id="create_location" name="location"
                                       value="{{ old('location') }}"/>
                                @error('location')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="create_start_date">Start Date</label>
                                <input type="date"
                                       class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                                       id="create_start_date" name="start_date"
                                       value="{{ old('start_date') }}"/>
                                @error('start_date')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="create_end_date">End Date</label>
                                <input type="date"
                                       class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                                       id="create_end_date" name="end_date"
                                       value="{{ old('end_date') }}"/>
                                @error('end_date')
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

    <!-- Edit Activity Modal -->
    <div class="modal fade" id="editActivityModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="editActivityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" id="editActivityForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_activity_id" name="id">

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editActivityModalLabel">Edit Activity</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="edit_activity_code">Code</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('activity_code') ? 'is-invalid' : '' }}"
                                       id="edit_activity_code" name="activity_code"/>
                                @error('activity_code')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_name">Name</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       id="edit_name" name="name"/>
                                @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_description">Description</label>
                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                          rows="3"
                                          id="edit_description" name="description"></textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_price">Price</label>
                                <input type="number"
                                       class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                       id="edit_price" name="price" min="0"/>
                                @error('price')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_location">Location</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}"
                                       id="edit_location" name="location"/>
                                @error('location')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_start_date">Start Date</label>
                                <input type="date"
                                       class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                                       id="edit_start_date" name="start_date"/>
                                @error('start_date')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_end_date">End Date</label>
                                <input type="date"
                                       class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                                       id="edit_end_date" name="end_date"/>
                                @error('end_date')
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

            // Create button click handler - clear previous data
            $('#createActivityModal').on('show.bs.modal', function () {
                // Reset form
                $('#createActivityModal form')[0].reset();
                // Clear validation errors
                $('#createActivityModal .is-invalid').removeClass('is-invalid');
                $('#createActivityModal .invalid-feedback').text('');
            });

            // Edit button click handler
            $('.edit-activity-btn').on('click', function () {
                var activityId = $(this).data('id');
                var activityCode = $(this).data('activity_code');
                var name = $(this).data('name');
                var description = $(this).data('description');
                var price = $(this).data('price');
                var location = $(this).data('location');
                var startDate = $(this).data('start_date');
                var endDate = $(this).data('end_date');

                // Populate form fields directly from button data attributes
                $('#edit_activity_id').val(activityId);
                $('#edit_activity_code').val(activityCode);
                $('#edit_name').val(name);
                $('#edit_description').val(description);
                $('#edit_price').val(price);
                $('#edit_location').val(location);
                $('#edit_start_date').val(startDate);
                $('#edit_end_date').val(endDate);

                // Clear any previous validation errors
                $('#editActivityForm .is-invalid').removeClass('is-invalid');
                $('#editActivityForm .invalid-feedback').text('');

                // Update form action
                var updateUrl = '{{ route('activities.update', ':id') }}'.replace(':id', activityId);
                $('#editActivityForm').attr('action', updateUrl);

                // Show the modal
                $('#editActivityModal').modal('show');
            });

            // Auto-open create modal if there are validation errors
            @if($errors->any() && !old('id'))
            $(document).ready(function () {
                // Populate form with old input data
                @if(old('activity_code'))
                $('#create_activity_code').val('{{ old('activity_code') }}');
                @endif
                @if(old('name'))
                $('#create_name').val('{{ old('name') }}');
                @endif
                @if(old('description'))
                $('#create_description').val('{{ old('description') }}');
                @endif
                @if(old('price'))
                $('#create_price').val('{{ old('price') }}');
                @endif
                @if(old('location'))
                $('#create_location').val('{{ old('location') }}');
                @endif
                @if(old('start_date'))
                $('#create_start_date').val('{{ old('start_date') }}');
                @endif
                @if(old('end_date'))
                $('#create_end_date').val('{{ old('end_date') }}');
                @endif

                // Show the modal
                $('#createActivityModal').modal('show');
            });
            @endif

            // Auto-open edit modal if there are validation errors
            @if($errors->any() && old('id'))
            $(document).ready(function () {
                var activityId = {{ old('id') }};

                // Populate form with old input data
                $('#edit_activity_id').val(activityId);
                @if(old('activity_code'))
                $('#edit_activity_code').val('{{ old('activity_code') }}');
                @endif
                @if(old('name'))
                $('#edit_name').val('{{ old('name') }}');
                @endif
                @if(old('description'))
                $('#edit_description').val('{{ old('description') }}');
                @endif
                @if(old('price'))
                $('#edit_price').val('{{ old('price') }}');
                @endif
                @if(old('location'))
                $('#edit_location').val('{{ old('location') }}');
                @endif
                @if(old('start_date'))
                $('#edit_start_date').val('{{ old('start_date') }}');
                @endif
                @if(old('end_date'))
                $('#edit_end_date').val('{{ old('end_date') }}');
                @endif

                // Update form action
                var updateUrl = '{{ route('activities.update', ':id') }}'.replace(':id', activityId);
                $('#editActivityForm').attr('action', updateUrl);

                // Show the modal
                $('#editActivityModal').modal('show');
            });
            @endif

            // Clear validation errors on input for create form
            $('#createActivityForm input, #createActivityForm textarea').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });

            // Clear validation errors on input for edit form
            $('#editActivityForm input, #editActivityForm textarea').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>
@endpush
