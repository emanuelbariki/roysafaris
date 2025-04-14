@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow rounded">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ isset($role) ? 'Edit Role' : 'Create Role' }}</h5>
                </div>

                <div class="card-body">
                    <form action="{{ isset($role) ? route('roles.update', $role) : route('roles.store') }}" method="POST">
                        @csrf
                        @if(isset($role)) @method('PUT') @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">Role Name</label>
                            <input type="text" name="name" id="name"
                                   class="form-control"
                                   value="{{ old('name', $role->name ?? '') }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Assign Permissions</label>
                            <div class="row">
                                @foreach($permissions as $perm)
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input type="checkbox"
                                                   class="form-check-input"
                                                   id="perm_{{ $perm->id }}"
                                                   name="permissions[]"
                                                   value="{{ $perm->name }}"
                                                   {{ isset($role) && $role->permissions->contains($perm) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perm_{{ $perm->id }}">
                                                {{ ucfirst($perm->name) }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('permissions')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-success px-4">Save Role</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
