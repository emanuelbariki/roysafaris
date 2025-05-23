<!-- Persons and Rooms Section -->
<div class="mb-4">
    <h6 class="section-header"><i class="fas fa-users me-2"></i>PERSONS & ROOMS</h6>
    <div class="row mt-2">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">PERSONS</label>
                <div class="row g-3">
                    <div class="col-3">
                        <label class="form-label">Adults</label>
                        <input type="number" class="form-control @error('adults') is-invalid @enderror" name="adults"
                            value="{{ old('adults', $booking->adults ?? 0) }}">
                        @error('adults') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-3">
                        <label class="form-label">Children</label>
                        <input type="number" class="form-control @error('children') is-invalid @enderror"
                            name="children" value="{{ old('children', $booking->children ?? 0) }}">
                        @error('children') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-3">
                        <label class="form-label">Infants</label>
                        <input type="number" class="form-control @error('infants') is-invalid @enderror" name="infants"
                            value="{{ old('infants', $booking->infants ?? 0) }}">
                        @error('infants') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-6">
                        <label class="form-label">Total Pax (Excl. Infants)</label>
                        <input type="number" class="form-control"
                            value="{{ (old('adults', $booking->adults ?? 0) + old('children', $booking->children ?? 0) + old('juniors', $booking->juniors ?? 0) 
                            // + old('children', $booking->infants ?? 0) 
                            ) }}"
                            readonly>
                    </div>

                    <div class="col-6">
                        <label class="form-label">Day Room</label>
                        <select class="form-select @error('day_room') is-invalid @enderror" name="day_room">
                            <option value="1"
                                {{ old('day_room', $reservation->day_room ?? '') == '1' ? 'selected' : '' }}>Yes
                            </option>
                            <option value="0"
                                {{ old('day_room', $reservation->day_room ?? '') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('day_room') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <label class="form-label">ROOM TYPES</label>

            <div class="room-type-grid" style="display: grid; grid-template-columns: repeat(6, 1fr); gap: 10px;">
                @foreach($roomTypes as $type)
                <div class="room-type-cell fw-bold d-flex align-items-center" for="room_{{ $type->id }}" onclick="updateRoomCount()">
                    <input onclick="updateRoomCount()" type="checkbox" id="room_{{ $type->id }}" name="room_detail[]" value="{{ $type->id }}" class="form-check-input me-2"
                        {{ in_array($type->id, old('room_detail', $selectedTypes ?? [])) ? 'checked' : '' }}>
                    {{ $type->room_type }}
                </div>
                @endforeach
            </div>
            @error('room_detail') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror

            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <label class="form-label">Total Rooms</label>
                    <input type="number" name="total_rooms" id="totalRooms" readonly
                        class="form-control @error('total_rooms') is-invalid @enderror"
                        value="{{ old('total_rooms', $reservation->total_rooms ?? '') }}">
                    @error('total_rooms') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Total Pax</label>
                    <input type="number" name="total_pax" class="form-control @error('total_pax') is-invalid @enderror"
                        value="{{ (old('adults', $booking->adults ?? 0) + old('children', $booking->children ?? 0) + old('juniors', $booking->juniors ?? 0) 
                            // + old('children', $booking->infants ?? 0) 
                            ) }}" >
                    @error('total_pax') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    // $(document).ready(function () {
        function updateRoomCount() {
            var total = $('input[name="room_detail[]"]:checked').length;
            console.log(total);
            
            $('#totalRooms').val(total);
        }

        // Initial count on page load
        // updateRoomCount();

        // // Update count on checkbox change
        // $('input[name="room_detail[]"]').on('change', function () {
        //     updateRoomCount();
        // });
    // });
</script>
