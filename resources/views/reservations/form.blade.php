                @php $reservation = $reservation ?? new \App\Models\Reservation(); 
                $selectedTypes = $reservation->room_detail ?? [];
                @endphp
                @include('reservations.partials.header')
                @include('reservations.partials.guest-details')
                @include('reservations.partials.persons-rooms')
                @include('reservations.partials.payments')
                @include('reservations.partials.internal-info')
                @include('reservations.partials.accommodation-summary')
                @include('reservations.partials.voucher-info')
                @include('reservations.partials.comments')
                @include('reservations.partials.footer')
