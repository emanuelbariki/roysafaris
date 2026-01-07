@extends('layouts.app')

@push('action-buttons')
    <div class="col-auto align-self-center">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                data-target="#createCurrencyModal">
            <i class="mdi mdi-plus mr-1 icon-xl"></i>
            Add Currency
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
                            <th>Code</th>
                            <th>Base</th>
                            <th>Rate</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($currencies as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ ucfirst($item->base) }}</td>
                                <td>{{ $item->rate }}</td>
                                <td>
                                    @if($item->status === 'active')
                                        <span class="badge badge-success">{{ ucfirst($item->status) }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-icon-square-sm edit-currency-btn"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}"
                                            data-code="{{ $item->code }}"
                                            data-base="{{ $item->base }}"
                                            data-rate="{{ $item->rate }}"
                                            data-status="{{ $item->status }}"
                                            title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    <form action="{{ route('currencies.destroy', $item->id) }}" method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-icon-square-sm"
                                                onclick="return confirm('Are you sure you want to delete this currency?')"
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
    <!-- Create Currency Modal -->
    <div class="modal fade" id="createCurrencyModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="createCurrencyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{{ route('currencies.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="createCurrencyModalLabel">Add Currency</h6>
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
                                       id="name" name="name" value="{{ old('name') }}"
                                       placeholder="Tanzanian Shillings, etc" required/>
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="number"
                                       class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                                       id="code" name="code" value="{{ old('code') }}" min="1"
                                       placeholder="TZS, USD, etc" required/>
                                @error('code')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="base">Base</label>
                                <select
                                    class="select2 form-control mb-3 custom-select {{ $errors->has('base') ? 'is-invalid' : '' }}"
                                    name="base" id="base"
                                    style="width: 100%; height:36px;">
                                    <option value="">Choose</option>
                                    <option value="yes" {{ old('base') === 'yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="no" {{ old('base') === 'no' ? 'selected' : '' }}>No</option>
                                </select>
                                @error('base')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="rate">Rate</label>
                                <input type="number" step="any"
                                       class="form-control {{ $errors->has('rate') ? 'is-invalid' : '' }}"
                                       id="rate" name="rate" value="{{ old('rate') }}" placeholder="2640"
                                       required/>
                                @error('rate')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select
                                    class="form-control mb-3 custom-select {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                    name="status" id="status"
                                    style="width: 100%; height:36px;">
                                    <option value="">Choose</option>
                                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                                @error('status')
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

    <!-- Edit Currency Modal -->
    <div class="modal fade" id="editCurrencyModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="editCurrencyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" id="editCurrencyForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editCurrencyModalLabel">Edit Currency</h6>
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
                                       placeholder="Tanzanian Shillings, etc" required/>
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_code">Code</label>
                                <input type="number"
                                       class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" min="1"
                                       id="edit_code" name="code" placeholder="TZS, USD, etc" required/>
                                @error('code')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_base">Base</label>
                                <select
                                    class="select2 form-control mb-3 custom-select {{ $errors->has('base') ? 'is-invalid' : '' }}"
                                    name="base" id="edit_base"
                                    style="width: 100%; height:36px;">
                                    <option value="">Choose</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                @error('base')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edit_rate">Rate</label>
                                <input type="number" step="any"
                                       class="form-control {{ $errors->has('rate') ? 'is-invalid' : '' }}"
                                       id="edit_rate" name="rate" placeholder="2640" required/>
                                @error('rate')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
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

            // Edit currency button click handler
            $('.edit-currency-btn').on('click', function () {
                var currencyId = $(this).data('id');
                var name = $(this).data('name');
                var code = $(this).data('code');
                var base = $(this).data('base');
                var rate = $(this).data('rate');
                var status = $(this).data('status');

                // Populate form fields directly from button data attributes
                $('#edit_id').val(currencyId);
                $('#edit_name').val(name);
                $('#edit_code').val(code);
                $('#edit_base').val(base).trigger('change');
                $('#edit_rate').val(rate);
                $('#edit_status').val(status).trigger('change');

                // Clear any previous validation errors
                $('#editCurrencyForm input, #editCurrencyForm select').removeClass('is-invalid');
                $('#editCurrencyForm .invalid-feedback').text('');

                // Update form action
                var updateUrl = '{{ route('currencies.update', ':id') }}'.replace(':id', currencyId);
                $('#editCurrencyForm').attr('action', updateUrl);

                // Show the modal
                $('#editCurrencyModal').modal('show');
            });

            // Auto-open edit modal if there are validation errors
            @if($errors->any() && old('id'))
            $(document).ready(function () {
                var currencyId = {{ old('id') }};

                // Populate form with old input data
                $('#edit_id').val(currencyId);
                $('#edit_name').val('{{ old('name') }}');
                $('#edit_code').val('{{ old('code') }}');
                $('#edit_base').val('{{ old('base') }}').trigger('change');
                $('#edit_rate').val('{{ old('rate') }}');
                $('#edit_status').val('{{ old('status') }}').trigger('change');

                // Update form action
                var updateUrl = '{{ route('currencies.update', ':id') }}'.replace(':id', currencyId);
                $('#editCurrencyForm').attr('action', updateUrl);

                // Show the modal
                $('#editCurrencyModal').modal('show');
            });
            @endif

            // Clear validation errors on input for edit form
            $('#editCurrencyForm input, #editCurrencyForm select').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });

            // Clear validation errors on input for create form
            $('#createCurrencyModal input, #createCurrencyModal select').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>
@endpush
