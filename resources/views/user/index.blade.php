@extends('layouts.app')

@push('action-buttons')
    <div class="col-auto align-self-center">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                data-target="#exampleModalDefault">
            <i class="mdi mdi-plus mr-1 icon-xl"></i>
            Add User
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
                            <th>email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->role->name) }}</td>
                                <td>
                                    <a href="#" class="mr-2"><i class="las la-pen text-info font-18"></i></a>
                                    <a href="#"><i class="las la-trash-alt text-danger font-18"></i></a>
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
    <div class="modal fade" id="exampleModalDefault" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Add User</h6>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       id="name" name="name" value="{{ old('name') }}" placeholder="Enter name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       id="email" name="email"
                                       value="{{ old('email') }}"
                                       placeholder="Enter email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select
                                    class="select2 form-control mb-3 custom-select {{ $errors->has('role') ? 'is-invalid' : '' }}"
                                    name="role" id="role"
                                    style="width: 100%; height:36px;">
                                    <option value="">Select</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ old('role') == $role->id ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password"
                                       class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                       id="password" name="password"
                                       placeholder="********">
                                @error('password')
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
@endpush

@push('plugin-scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush

@push('scripts')
    <script>
        $('#datatable').DataTable();

        // Auto-open modal if there are validation errors
        @if($errors->any())
        $(document).ready(function () {
            $('#exampleModalDefault').modal('show');
        });
        @endif
    </script>
@endpush
