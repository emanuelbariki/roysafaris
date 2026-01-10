@extends('layouts.app')

@can('create::agent')
    @push('action-buttons')
        <div class="col-auto align-self-center">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#createAgentModal">
                <i class="mdi mdi-plus mr-1 icon-xl"></i>
                Add Agent
            </button>
        </div>
    @endpush
@endcan

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped dt-responsive table-hover nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>description</th>
                            <th>mountain</th>
                            <th>Min days</th>
                            <th>Max days</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mountainsRoutes as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone ?? '-' }}</td>
                                <td>{{ $item->address ?? '-' }}</td>
                                <td>
                                    @canany(['edit::agent', 'delete::agent'])
                                        @can('edit::agent')
                                            <button type="button"
                                                    class="btn btn-primary btn-icon-square-sm edit-agent-btn"
                                                    data-id="{{ $item->id }}"
                                                    data-name="{{ $item->name }}"
                                                    data-email="{{ $item->email }}"
                                                    data-phone="{{ $item->phone ?? '' }}"
                                                    data-address="{{ $item->address ?? '' }}"
                                                    title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endcan

                                        @can('delete::agent')
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
    <!-- Create Agent Modal -->
    <div class="modal fade" id="createAgentModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="createAgentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{{ route('mountainroutes.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="createAgentModalLabel">Add Agent</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input style="text-transform: uppercase;" type="text" class="form-control" id="name"
                                       name="mountainroute[name]" placeholder="MACHAME,SHIRA,RONGAI , etc" required=""
                                       value="{{ isset($mountainroute) ? $mountainroute->name : old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Description</label>
                                <input type="text" class="form-control" id="name" name="mountainroute[description]"
                                       placeholder="Machame Route , etc" required=""
                                       value="{{ isset($mountainroute) ? $mountainroute->description : old('description') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mountainroute">Moutain</label>
                                <select class="form-control" name="mountainroute[mountain_id]" id="mountainroute">
                                    <option selected disabled>Choose</option>
                                    @foreach ($mountains as $m)
                                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Min Days</label>
                                <input type="number" class="form-control" id="mindays" name="mountainroute[min_days]"
                                       min="1" max="100" placeholder="min days" required=""
                                       value="{{ isset($mountainroute) ? $mountainroute->name : old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Max Days</label>
                                <input type="number" class="form-control" id="maxdays" name="mountainroute[max_days]"
                                       min="1" max="100" placeholder="max days" required=""
                                       value="{{ isset($mountainroute) ? $mountainroute->description : old('description') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="useremail">Status</label>
                                <select name="mountainroute[status]" class="form-control">
                                    <option selected disabled>Choose</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">In Active</option>
                                </select>
                                {{-- <input type="email" class="form-control" id="useremail" required=""> --}}
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input style="text-transform: uppercase;" type="text" class="form-control" id="name"
                                       name="mountainroute[name]" placeholder="MACHAME,SHIRA,RONGAI , etc" required=""
                                       value="{{ isset($mountainroute) ? $mountainroute->name : old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Description</label>
                                <input type="text" class="form-control" id="name" name="mountainroute[description]"
                                       placeholder="Machame Route , etc" required=""
                                       value="{{ isset($mountainroute) ? $mountainroute->description : old('description') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mountainroute">Moutain</label>
                                <select class="form-control" name="mountainroute[mountain_id]" id="mountainroute">
                                    <option selected disabled>Choose</option>
                                    @foreach ($mountains as $m)
                                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Min Days</label>
                                <input type="number" class="form-control" id="mindays" name="mountainroute[min_days]"
                                       min="1" max="100" placeholder="min days" required=""
                                       value="{{ isset($mountainroute) ? $mountainroute->name : old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Max Days</label>
                                <input type="number" class="form-control" id="maxdays" name="mountainroute[max_days]"
                                       min="1" max="100" placeholder="max days" required=""
                                       value="{{ isset($mountainroute) ? $mountainroute->description : old('description') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="useremail">Status</label>
                                <select name="mountainroute[status]" class="form-control">
                                    <option selected disabled>Choose</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">In Active</option>
                                </select>
                                {{-- <input type="email" class="form-control" id="useremail" required=""> --}}
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
                var updateUrl = '{{ route('mountainroutes.update', ':id') }}'.replace(':id', agentId);
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
