@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow rounded">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ isset($permission) ? 'Edit Permission' : 'Create Permission' }}</h5>
                </div>

                <div class="card-body">
                    <form action="{{ isset($permission) ? route('permissions.update', $permission) : route('permissions.store') }}" method="POST">
                        @csrf
                        @if(isset($permission)) @method('PUT') @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">Permission Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                   value="{{ old('name', $permission->name ?? '') }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('permissions.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-success px-4">
                                {{ isset($permission) ? 'Update' : 'Create' }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
