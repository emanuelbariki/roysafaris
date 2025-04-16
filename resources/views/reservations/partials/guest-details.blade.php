<div class="mb-4">
    <h6 class="section-header"><i class="fas fa-user me-2"></i>GUEST DETAILS</h6>
    <div class="row g-3 mt-2">

        <div class="col-md-3">
            <label class="form-label">Guest Name</label>
            <input type="text" name="guest_name" id="name" value="{{ old('guest_name', $reservation->guest_name ?? '') }}" class="form-control @error('guest_name') is-invalid @enderror" required>
            @error('guest_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-3">
            <label class="form-label">Agent Name</label>
            <select class="form-select form-control @error('agent_id') is-invalid @enderror" name="agent_id">
                <option value="">Select Agent</option>
                @foreach($agents as $agent)
                    <option value="{{ $agent->id }}" {{ old('agent_id', $reservation->agent_id ?? '') == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
                @endforeach
            </select>
            @error('agent_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-3">
            <label class="form-label">Booking Code</label>
            <input type="text" class="form-control @error('reservation_code') is-invalid @enderror" name="reservation_code" value="{{ old('reservation_code', $reservationCode ?? '') }}">
            @error('reservation_code') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-3">
            <label class="form-label">Country</label>
            <select class="form-select form-control @error('country_id') is-invalid @enderror" name="country_id">
                <option value="">Select Country</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ old('country_id', $reservation->country_id ?? '') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                @endforeach
            </select>
            @error('country_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-3">
            <label class="form-label">Arrival</label>
            <input type="date" class="form-control @error('arrival') is-invalid @enderror" name="arrival" value="{{ old('arrival', $reservation->arrival ?? '') }}">
            @error('arrival') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-3">
            <label class="form-label">Departure</label>
            <input type="date" class="form-control @error('departure') is-invalid @enderror" name="departure" value="{{ old('departure', $reservation->departure ?? '') }}">
            @error('departure') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-3">
            <label class="form-label">Nights</label>
            <input type="text" class="form-control @error('nights') is-invalid @enderror" name="nights" value="{{ old('nights', $reservation->nights ?? '') }}" readonly>
            @error('nights') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-3">
            <label class="form-label">Arrival Time</label>
            <input type="time" name="arrival_time" class="form-control @error('arrival_time') is-invalid @enderror" value="{{ old('arrival_time', $reservation->arrival_time ?? '') }}">
            @error('arrival_time') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Lodge/Camp Code</label>
            <select class="form-select form-control @error('lodge_id') is-invalid @enderror" name="lodge_id">
                <option value="">Select Lodge</option>
                @foreach($lodges as $lodge)
                    <option value="{{ $lodge->id }}" {{ old('lodge_id', $reservation->lodge_id ?? '') == $lodge->id ? 'selected' : '' }}>{{ $lodge->name }}</option>
                @endforeach
            </select>
            @error('lodge_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Property Name</label>
            <input type="text" class="form-control @error('property_name') is-invalid @enderror" name="property_name" value="{{ old('property_name', $reservation->property_name ?? '') }}">
            @error('property_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

    </div>
</div>
