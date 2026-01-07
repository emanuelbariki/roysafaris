@extends('layouts.app')

@push('action-buttons')
    <div class="col-auto align-self-center">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createTripTypeModal">
            <i class="mdi mdi-plus mr-1 icon-xl"></i>
            Add Trip Type
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tripTypes as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if($item->status === 'active')
                                        <span class="badge badge-success">{{ ucfirst($item->status) }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </td>
                                <td>

                                    <button type="button"
                                            class="btn btn-primary btn-icon-square-sm edit-trip-type-btn"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}"
                                            data-status="{{ $item->status }}"
                                            title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    <form action="{{ route('triptypes.destroy', $item->id) }}" method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-icon-square-sm"
                                                onclick="return confirm('Are you sure you want to delete this trip type?')"
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
    <!-- Create Trip Type Modal -->
    <div class="modal fade" id="createTripTypeModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="createTripTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{{ route('triptypes.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="createTripTypeModalLabel">Add Trip Type</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="create_name">Name</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       id="create_name" name="name"
                                       value="{{ old('name') }}"
                                       placeholder="Transfer, Safari, VIP, etc.">
                                @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
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

    <!-- Edit Trip Type Modal -->
    <div class="modal fade" id="editTripTypeModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="editTripTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" id="editTripTypeForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editTripTypeModalLabel">Edit Trip Type</h6>
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
                                       placeholder="Transfer, Safari, VIP, etc.">
                                @error('name')
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
            $('.edit-trip-type-btn').on('click', function () {
                var tripTypeId = $(this).data('id');
                var name = $(this).data('name');
                var status = $(this).data('status');

                // Populate form fields directly from button data attributes
                $('#edit_id').val(tripTypeId);
                $('#edit_name').val(name);
                $('#edit_status').val(status);

                // Clear any previous validation errors
                $('#edit_name').removeClass('is-invalid');
                $('#edit_status').removeClass('is-invalid');
                $('.invalid-feedback').text('');

                // Update form action
                var updateUrl = '{{ route('triptypes.update', ':id') }}'.replace(':id', tripTypeId);
                $('#editTripTypeForm').attr('action', updateUrl);

                // Show the modal
                $('#editTripTypeModal').modal('show');
            });

            // Auto-open edit modal if there are validation errors
            @if($errors->any() && old('id'))
            $(document).ready(function () {
                var tripTypeId = {{ old('id') }};

                // Populate form with old input data
                $('#edit_id').val(tripTypeId);
                $('#edit_name').val('{{ old('name') }}');
                $('#edit_status').val('{{ old('status') }}');

                // Update form action
                var updateUrl = '{{ route('triptypes.update', ':id') }}'.replace(':id', tripTypeId);
                $('#editTripTypeForm').attr('action', updateUrl);

                // Show the modal
                $('#editTripTypeModal').modal('show');
            });
            @endif

            // Clear validation errors on input
            $('#edit_name, #edit_status').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>
@endpush

