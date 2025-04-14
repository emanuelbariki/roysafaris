@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow rounded">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Permissions</h5>
                    <a href="{{ route('permissions.create') }}" class="btn btn-light btn-sm">
                        + Add Permission
                    </a>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permissions as $perm)
                                    <tr>
                                        <td>{{ ucfirst($perm->name) }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('permissions.edit', $perm) }}" class="btn btn-sm btn-warning me-1">
                                                Edit
                                            </a>
                                            <form action="{{ route('permissions.destroy', $perm) }}" method="POST" class="d-inline-block">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this permission?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted py-3">
                                            No permissions found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
