@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-white">
            <h5 class="mb-0">Agent Details</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Name:</strong> {{ $agent->name }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $agent->email }}</li>
                <li class="list-group-item"><strong>Phone:</strong> {{ $agent->phone }}</li>
                <li class="list-group-item"><strong>Address:</strong> {{ $agent->address }}</li>
            </ul>
            <div class="mt-4">
                <a href="{{ route('agents.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
