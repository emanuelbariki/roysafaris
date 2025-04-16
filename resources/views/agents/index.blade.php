@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Agents</h4>
        <a href="{{ route('agents.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Agent
        </a>
    </div>

    <div class="card shadow-sm rounded">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agents as $agent)
                        <tr>
                            <td>{{ $agent->name }}</td>
                            <td>{{ $agent->email }}</td>
                            <td>{{ $agent->phone }}</td>
                            <td>
                                <a href="{{ route('agents.show', $agent) }}" class="btn btn-sm btn-info text-white">View</a>
                                <a href="{{ route('agents.edit', $agent) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('agents.destroy', $agent) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this agent?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-3">No agents found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $agents->links() }}
    </div>
</div>
@endsection
