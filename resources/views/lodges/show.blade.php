@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm rounded">
            <div class="card-body">
                <h4>Lodge Details</h4>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Name:</strong> {{ $lodge->name }}</li>
                    <li class="list-group-item"><strong>Location:</strong> {{ $lodge->location }}</li>
                    <li class="list-group-item"><strong>Phone:</strong> {{ $lodge->phone }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $lodge->email }}</li>
                    <li class="list-group-item"><strong>Description:</strong> {{ $lodge->description }}</li>
                </ul>
                <a href="{{ route('lodges.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection
