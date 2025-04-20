<!-- Internal Information Section -->
@php
$reservation = $reservation ?? new \App\Models\Reservation();
@endphp

<div class="card shadow-sm rounded mb-4">
    <div class="card-body">
        <h6 class="section-header mb-3">
            <i class="fas fa-info-circle me-2"></i>INTERNAL INFORMATION
        </h6>
        <div class="row g-3">
            <div class="col-md-3">
                <label for="user_display" class="form-label">User</label>
                <input type="text" id="user_display" value="{{ $reservation->user->name ?? auth()->user()->name }}"
                    class="form-control" readonly>

                <input type="hidden" name="user_id"
                    value="{{ old('user_id', $reservation->user_id ?? auth()->user()->id) }}">
            </div>


            <div class="col-md-3">
                <label for="booking_date" class="form-label">Booking Date</label>
                <input type="date" name="booking_date" id="booking_date"
                    value="{{ old('booking_date', $reservation->booking_date ?? now()->toDateString()) }}"
                    class="form-control @error('booking_date') is-invalid @enderror">
                @error('booking_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- <div class="col-md-3">
                <label for="internal_ref" class="form-label">Internal Ref</label>
                <input type="text" name="internal_ref" id="internal_ref"
                    value="{{ old('internal_ref', $reservation->internal_ref ?? '54111') }}"
                    class="form-control @error('internal_ref') is-invalid @enderror">
                @error('internal_ref') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div> --}}

            <div class="col-md-3">
                <label for="reservation_code" class="form-label">Reservations Code</label>
                <input type="text" name="reservation_code" id="reservation_code"
                    value="{{ old('reservation_code', $reservation->reservation_code ?? $reservationCode) }}"
                    class="form-control @error('reservation_code') is-invalid @enderror">
                @error('reservation_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>
</div>