@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow rounded">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit User Roles</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" class="form-control" value="{{ $user->name }}" disabled>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" value="{{ $user->email }}" disabled>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Assign Roles</label>
                                <div class="row">
                                    @foreach($roles as $role)
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" name="roles[]"
                                                       value="{{ $role->name }}"
                                                       id="role_{{ $role->id }}"
                                                       class="form-check-input"
                                                       {{ $user->roles->contains('name', $role->name) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="role_{{ $role->id }}">
                                                    {{ ucfirst($role->name) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('roles')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <div class="col-sm-12 text-end">
                                <button type="submit" class="btn btn-primary px-4">Update Roles</button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary px-4">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
