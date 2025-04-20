@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Reservations</h4>
        <a href="{{ route('reservations.create') }}" class="btn btn-primary">Create Reservation</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm rounded">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-light">
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
                            <td>{{ $reservation->booking->group_name }}</td>
                            <td>{{ $reservation->arrival }}</td>
                            <td>{{ $reservation->departure }}</td>
                            <td>{{ $reservation->status }}</td>
                            <td class="d-flex justify-content-around">
                            <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('voucher.print.content', $reservation->id) }}" class="btn btn-sm btn-primary">Print Voucher</a>
                                <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this reservation?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $reservations->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
