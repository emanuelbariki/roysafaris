@extends('layouts.app')

@can('create::lodge')
    @push('action-buttons')
        <div class="col-auto align-self-center">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#createLodgeModal">
                <i class="mdi mdi-plus mr-1 icon-xl"></i>
                Add Lodge
            </button>
        </div>
    @endpush
@endcan

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
                            <th>Location</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lodges as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->location ?? '-' }}</td>
                                <td>{{ $item->phone ?? '-' }}</td>
                                <td>{{ $item->email ?? '-' }}</td>
                                <td>
                                    @canany(['edit::lodge', 'delete::lodge'])
                                        @can('edit::lodge')
                                            <button type="button" class="btn btn-primary btn-icon-square-sm edit-lodge-btn"
                                                    data-id="{{ $item->id }}"
                                                    data-name="{{ $item->name }}"
                                                    data-location="{{ $item->location ?? '' }}"
                                                    data-phone="{{ $item->phone ?? '' }}"
                                                    data-email="{{ $item->email ?? '' }}"
                                                    data-description="{{ $item->description ?? '' }}"
                                                    title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        @endcan

                                        @can('delete::lodge')
                                            <form action="{{ route('lodges.destroy', $item->id) }}" method="POST"
                                                  style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger btn-icon-square-sm"
                                                        onclick="return confirm('Are you sure you want to delete this lodge?')"
                                                        title="Delete">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    @endcanany
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
    <!-- Create Lodge Modal -->
    <div class="modal fade" id="createLodgeModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="createLodgeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" action="{{ route('lodges.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="createLodgeModalLabel">Add Lodge</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       id="name" name="name" value="{{ old('name') }}" required/>
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}"
                                       id="location" name="location" value="{{ old('location') }}"/>
                                @error('location')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                       id="phone" name="phone" value="{{ old('phone') }}"/>
                                @error('phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       id="email" name="email" value="{{ old('email') }}"/>
                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea
                                    class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                    id="description" name="description" rows="6">{{ old('description') }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
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

    <!-- Edit Lodge Modal -->
    <div class="modal fade" id="editLodgeModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="editLodgeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" id="editLodgeForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editLodgeModalLabel">Edit Lodge</h6>
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
                                       id="edit_name" name="name" required/>
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_location">Location</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}"
                                       id="edit_location" name="location"/>
                                @error('location')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_phone">Phone</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                       id="edit_phone" name="phone"/>
                                @error('phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_email">Email</label>
                                <input type="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       id="edit_email" name="email"/>
                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_description">Description</label>
                                <textarea
                                    class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                    id="edit_description" name="description" rows="6"></textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
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

            // Edit lodge button click handler
            $('.edit-lodge-btn').on('click', function () {
                var lodgeId = $(this).data('id');
                var name = $(this).data('name');
                var location = $(this).data('location');
                var phone = $(this).data('phone');
                var email = $(this).data('email');
                var description = $(this).data('description');

                // Populate form fields directly from button data attributes
                $('#edit_id').val(lodgeId);
                $('#edit_name').val(name);
                $('#edit_location').val(location);
                $('#edit_phone').val(phone);
                $('#edit_email').val(email);
                $('#edit_description').val(description);

                // Clear any previous validation errors
                $('#editLodgeForm input, #editLodgeForm textarea').removeClass('is-invalid');
                $('#editLodgeForm .invalid-feedback').text('');

                // Update form action
                var updateUrl = '{{ route('lodges.update', ':id') }}'.replace(':id', lodgeId);
                $('#editLodgeForm').attr('action', updateUrl);

                // Show the modal
                $('#editLodgeModal').modal('show');
            });

            // Auto-open edit modal if there are validation errors
            @if($errors->any() && old('id'))
            $(document).ready(function () {
                var lodgeId = {{ old('id') }};

                // Populate form with old input data
                $('#edit_id').val(lodgeId);
                $('#edit_name').val('{{ old('name') }}');
                $('#edit_location').val('{{ old('location') }}');
                $('#edit_phone').val('{{ old('phone') }}');
                $('#edit_email').val('{{ old('email') }}');
                $('#edit_description').val('{{ old('description') }}');

                // Update form action
                var updateUrl = '{{ route('lodges.update', ':id') }}'.replace(':id', lodgeId);
                $('#editLodgeForm').attr('action', updateUrl);

                // Show the modal
                $('#editLodgeModal').modal('show');
            });
            @endif

            // Clear validation errors on input for edit form
            $('#editLodgeForm input, #editLodgeForm textarea').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });

            // Clear validation errors on input for create form
            $('#createLodgeModal input, #createLodgeModal textarea').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>
@endpush
