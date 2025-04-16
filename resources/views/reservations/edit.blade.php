
    <form action="{{ route('reservations.update', $reservation) }}" method="POST">
        @csrf
        @method('PUT')
        @include('reservations.form', ['reservation' => $reservation])
        <div class="mt-4">
                <button type="submit" class="btn btn-primary">Submit Reservation</button>
        </div>
    </form>
