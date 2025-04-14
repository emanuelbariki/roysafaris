@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow rounded">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">  
                    <h5 class="mb-0">Roles</h5>
                    <a href="{{ route('roles.create') }}" class="btn btn-light btn-sm">
                        + Add Role
                    </a>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Permissions</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $role)
                                    <tr>
                                        <td>{{ ucfirst($role->name) }}</td>
                                        <td>
                                            @php
                                                $permissions = $role->permissions->pluck('name')->toArray();
                                                $firstFew = array_slice($permissions, 0, 3);
                                                $remaining = array_slice($permissions, 3);
                                            @endphp

                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach($firstFew as $perm)
                                                    <span class="badge bg-secondary">{{ $perm }}</span>
                                                @endforeach

                                                @if(count($remaining) > 0)
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#permissionsModal{{ $role->id }}">
                                                        +{{ count($remaining) }} more
                                                    </button>
                                                @endif
                                            </div>

                                            {{-- Modal for full permissions --}}
                                            @if(count($remaining) > 0)
                                                <div class="modal fade" id="permissionsModal{{ $role->id }}" tabindex="-1" aria-labelledby="permLabel{{ $role->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="permLabel{{ $role->id }}">All Permissions - {{ ucfirst($role->name) }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="d-flex flex-wrap gap-2">
                                                                    @foreach($permissions as $perm)
                                                                        <span class="badge bg-light text-dark border">{{ $perm }}</span>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>

                                        <td class="text-end">
                                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-warning me-1">
                                                Edit
                                            </a>
                                            <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline-block">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this role?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-3">
                                            No roles found.
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

