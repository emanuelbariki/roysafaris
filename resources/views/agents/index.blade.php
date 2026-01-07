@extends('layouts.app')

@push('action-buttons')
    <div class="col-auto align-self-center">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                data-target="#createAgentModal">
            <i class="mdi mdi-plus mr-1 icon-xl"></i>
            Add Agent
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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($agents as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone ?? '-' }}</td>
                                <td>{{ $item->address ?? '-' }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-icon-square-sm edit-agent-btn"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}"
                                            data-email="{{ $item->email }}"
                                            data-phone="{{ $item->phone ?? '' }}"
                                            data-address="{{ $item->address ?? '' }}"
                                            title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    <form action="{{ route('agents.destroy', $item->id) }}" method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-icon-square-sm"
                                                onclick="return confirm('Are you sure you want to delete this agent?')"
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
    <!-- Create Agent Modal -->
    <div class="modal fade" id="createAgentModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="createAgentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{{ route('agents.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="createAgentModalLabel">Add Agent</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
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
                                <label for="email">Email</label>
                                <input type="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       id="email" name="email" value="{{ old('email') }}" required/>
                                @error('email')
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

                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea
                                    class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                    id="address" name="address" rows="3">{{ old('address') }}</textarea>
                                @error('address')
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

    <!-- Edit Agent Modal -->
    <div class="modal fade" id="editAgentModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="editAgentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" id="editAgentForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editAgentModalLabel">Edit Agent</h6>
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
                                       id="edit_name" name="name" required/>
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_email">Email</label>
                                <input type="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       id="edit_email" name="email" required/>
                                @error('email')
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

                            <div class="form-group">
                                <label for="edit_address">Address</label>
                                <textarea
                                    class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                    id="edit_address" name="address" rows="3"></textarea>
                                @error('address')
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

            // Edit agent button click handler
            $('.edit-agent-btn').on('click', function () {
                var agentId = $(this).data('id');
                var name = $(this).data('name');
                var email = $(this).data('email');
                var phone = $(this).data('phone');
                var address = $(this).data('address');

                // Populate form fields directly from button data attributes
                $('#edit_id').val(agentId);
                $('#edit_name').val(name);
                $('#edit_email').val(email);
                $('#edit_phone').val(phone);
                $('#edit_address').val(address);

                // Clear any previous validation errors
                $('#editAgentForm input, #editAgentForm textarea').removeClass('is-invalid');
                $('#editAgentForm .invalid-feedback').text('');

                // Update form action
                var updateUrl = '{{ route('agents.update', ':id') }}'.replace(':id', agentId);
                $('#editAgentForm').attr('action', updateUrl);

                // Show the modal
                $('#editAgentModal').modal('show');
            });

            // Auto-open edit modal if there are validation errors
            @if($errors->any() && old('id'))
            $(document).ready(function () {
                var agentId = {{ old('id') }};

                // Populate form with old input data
                $('#edit_id').val(agentId);
                $('#edit_name').val('{{ old('name') }}');
                $('#edit_email').val('{{ old('email') }}');
                $('#edit_phone').val('{{ old('phone') }}');
                $('#edit_address').val('{{ old('address') }}');

                // Update form action
                var updateUrl = '{{ route('agents.update', ':id') }}'.replace(':id', agentId);
                $('#editAgentForm').attr('action', updateUrl);

                // Show the modal
                $('#editAgentModal').modal('show');
            });
            @endif

            // Clear validation errors on input for edit form
            $('#editAgentForm input, #editAgentForm textarea').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });

            // Clear validation errors on input for create form
            $('#createAgentModal input, #createAgentModal textarea').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>
@endpush
