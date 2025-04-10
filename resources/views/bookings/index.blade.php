@extends('layouts.app')

@section('content')
<div class="container-fluid card-body">
    <h4 class="mb-4">Bookings</h4>

   
    <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                    <a href="{{ route('bookings.create') }}" class="btn btn-success mb-3">+ Add New Booking</a>
                    </div><!--end card-header-->
                    <div class="card-body">                                    
                        <div class="table-responsive">
    <table id="bookingsTable" class="table table-bordered table-striped able-responsive">
        <thead>
            <tr>
                <th>Reference</th>
                <th>Group</th>
                <th>Nationality</th>
                <th>Booking Code</th>
                <th>Arrival</th>
                <th>Departure</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->ref }}</td>
                <td>{{ $booking->group_name }}</td>
                <td>{{ $booking->nationality }}</td>
                <td>{{ $booking->booking_code }}</td>
                <td>{{ $booking->arrival_date }}</td>
                <td>{{ $booking->departure_date }}</td>
                <td>
                    <a href="{{ route('bookings.edit', $booking) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Are you sure?');">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div><!--end card-body-->
</div>
</div>

</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#bookingsTable').DataTable();
});
</script>
@endpush