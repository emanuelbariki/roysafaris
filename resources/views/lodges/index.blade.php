@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between mb-3">
            <h4>Lodges</h4>
            <a href="{{ route('lodges.create') }}" class="btn btn-primary">Add Lodge</a>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lodges as $lodge)
                            <tr>
                                <td>{{ $lodge->name }}</td>
                                <td>{{ $lodge->location }}</td>
                                <td>{{ $lodge->email }}</td>
                                <td class="d-flex justify-content-around">
                                    <a href="{{ route('lodges.show', $lodge) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('lodges.edit', $lodge) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('lodges.destroy', $lodge) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this lodge?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $lodges->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
