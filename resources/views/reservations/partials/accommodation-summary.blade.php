
<!-- Accommodation Summary Section -->
<div class="mb-4">
    <h6 class="section-header"><i class="fas fa-list-ul me-2"></i>ACCOMMODATION SUMMARY</h6>
    <div class="table-responsive mt-2">
        <table class="table table-bordered">
            <thead class="header-row">
                <tr>
                    <th>Guest Profiles</th>
                    <th>Arrival</th>
                    <th>Hotel Code</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($otherReservations) && $otherReservations->isNotEmpty())
                    @foreach ($otherReservations as $reservation)
                        <tr>
                            <td>{{ $reservation->booking->group_name }}</td>
                            <td>{{ $reservation->arrival }}</td>
                            <td>{{ $reservation->accommodation->name }}</td>
                            <td>{{ $reservation->status }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">No accommodation summary available.</td>
                    </tr>
                    
                @endif
            </tbody>
        </table>
    </div>
</div>