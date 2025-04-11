<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="container mt-4">
    @csrf
    @if($method === 'PUT')
    @method('PUT')
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label for="name" class="form-label">Vehicle Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $vehicleType->name ?? '') }}" required
                class="form-control">
        </div>

        <div class="col-md-6">
            <label for="seating" class="form-label">Seating Capacity</label>
            <input type="number" name="seating" id="seating" value="{{ old('seating', $vehicleType->seating ?? '') }}"
                class="form-control">
        </div>

        <div class="col-md-6">
            <label for="transmission" class="form-label">Transmission Type</label>
            <select name="transmission" id="transmission" class="form-control">
                <option value="">-- Select Transmission --</option>
                <option value="Automatic"
                    {{ old('transmission', $vehicleType->transmission ?? '') == 'Automatic' ? 'selected' : '' }}>
                    Automatic</option>
                <option value="Manual"
                    {{ old('transmission', $vehicleType->transmission ?? '') == 'Manual' ? 'selected' : '' }}>Manual
                </option>
                <option value="CVT"
                    {{ old('transmission', $vehicleType->transmission ?? '') == 'CVT' ? 'selected' : '' }}>CVT</option>
                <option value="Dual-Clutch"
                    {{ old('transmission', $vehicleType->transmission ?? '') == 'Dual-Clutch' ? 'selected' : '' }}>
                    Dual-Clutch</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="drive" class="form-label">Drive Type</label>
            <select name="drive" id="drive" class="form-control">
                <option value="">-- Select Drive Type --</option>
                <option value="FWD" {{ old('drive', $vehicleType->drive ?? '') == 'FWD' ? 'selected' : '' }}>Front-Wheel
                    Drive (FWD)</option>
                <option value="RWD" {{ old('drive', $vehicleType->drive ?? '') == 'RWD' ? 'selected' : '' }}>Rear-Wheel
                    Drive (RWD)</option>
                <option value="AWD" {{ old('drive', $vehicleType->drive ?? '') == 'AWD' ? 'selected' : '' }}>All-Wheel
                    Drive (AWD)</option>
                <option value="4WD" {{ old('drive', $vehicleType->drive ?? '') == '4WD' ? 'selected' : '' }}>Four-Wheel
                    Drive (4WD)</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="fuel" class="form-label">Fuel Type</label>
            <select name="fuel" id="fuel" class="form-control">
                <option value="">-- Select Fuel Type --</option>
                <option value="Petrol" {{ old('fuel', $vehicleType->fuel ?? '') == 'Petrol' ? 'selected' : '' }}>Petrol
                </option>
                <option value="Diesel" {{ old('fuel', $vehicleType->fuel ?? '') == 'Diesel' ? 'selected' : '' }}>Diesel
                </option>
                <option value="Hybrid" {{ old('fuel', $vehicleType->fuel ?? '') == 'Hybrid' ? 'selected' : '' }}>Hybrid
                </option>
                <option value="Electric" {{ old('fuel', $vehicleType->fuel ?? '') == 'Electric' ? 'selected' : '' }}>
                    Electric</option>
                <option value="Gas" {{ old('fuel', $vehicleType->fuel ?? '') == 'Gas' ? 'selected' : '' }}>Gas</option>
            </select>
        </div>


        <div class="col-md-6 d-flex align-items-center">
            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" id="ac" name="ac" value="1"
                    {{ old('ac', $vehicleType->ac ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="ac">
                    Air Conditioning
                </label>
            </div>
        </div>

        <div class="col-md-6">
            <label for="rate" class="form-label">Daily Rate</label>
            <input type="text" name="rate" id="rate" value="{{ old('rate', $vehicleType->rate ?? '') }}"
                class="form-control">
        </div>

        <div class="col-md-6">
            <label for="status" class="form-label">Status</label>
                <select name="status" id="drive" class="form-control">
                <option value="">-- Select Drive Type --</option>
                <option value="active" {{ old('status', $vehicleType->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $vehicleType->status ?? '') == 'inactive' ? 'selected' : '' }}>In-Active</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="available_from" class="form-label">Available From</label>
            <input type="date" name="available_from" id="available_from"
                value="{{ old('available_from', $vehicleType->available_from ?? '') }}" class="form-control">
        </div>

        <div class="col-md-6">
            <label for="available_until" class="form-label">Available Until</label>
            <input type="date" name="available_until" id="available_until"
                value="{{ old('available_until', $vehicleType->available_until ?? '') }}" class="form-control">
        </div>
    </div>

    <div class="mt-4 text-end">
        <button class="btn btn-primary px-4" type="submit">
            {{ $method === 'PUT' ? 'Update' : 'Create' }}
        </button>
    </div>
</form>