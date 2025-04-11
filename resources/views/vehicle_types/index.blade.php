@extends('layouts.app')

@section('content')
<div class="container-fluid card-body">
    <h4 class="mb-4">Vehicle Type</h4>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('vehicle-types.create') }}" class="btn btn-primary mb-3">+ Add New Vehicle</a>
            </div>
            <!--end card-header-->
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Seats</th>
                                <th>Rate</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vehicles as $vehicle)
                            <tr>
                                <td>{{ $vehicle->name }}</td>
                                <td>{{ $vehicle->seating }}</td>
                                <td>{{ $vehicle->rate }}</td>
                                <td>{{ ucfirst($vehicle->status) }}</td>
                                <td>
                                    <a href="{{ route('vehicle-types.edit', $vehicle) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('vehicle-types.destroy', $vehicle) }}" method="POST"
                                        style="display:inline-block">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this vehicle?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end card-body-->
        </div>
    </div>

</div>
@endsection
