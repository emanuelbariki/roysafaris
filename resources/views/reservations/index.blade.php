@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reservations</h1>
    <a href="{{ route('reservations.create') }}" class="btn btn-primary mb-3">Create Reservation</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Guest Name</th>
                <th>Arrival</th>
                <th>Departure</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->guest_name }}</td>
                    <td>{{ $reservation->arrival }}</td>
                    <td>{{ $reservation->departure }}</td>
                    <td>{{ $reservation->status }}</td>
                    <td>
                        <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection