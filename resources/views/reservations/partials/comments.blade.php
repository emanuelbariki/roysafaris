<!-- Comments Section -->
<div class="mb-4">
    <h6 class="section-header"><i class="fas fa-comment me-2"></i>COMMENTS</h6>
    
    <div class="mt-2">
        <label for="guest_notes" class="form-label">Guest Notes</label>
        <textarea id="guest_notes" name="guest_notes" class="form-control" rows="3">{{ old('guest_notes', $reservation->guest_notes ?? '') }}</textarea>
        @error('guest_notes') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mt-3">
        <label for="internal_remarks" class="form-label">Internal Remarks</label>
        <textarea id="internal_remarks" name="internal_remarks" class="form-control" rows="2">{{ old('internal_remarks', $reservation->internal_remarks ?? '') }}</textarea>
        @error('internal_remarks') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
</div>

<!-- Action Buttons -->
<div class="d-flex justify-content-between mt-4">
    <div>
        <button type="button" class="btn btn-outline-secondary me-2" id="btnCancel">
            <i class="fas fa-times me-1"></i>Cancel
        </button>
        <button type="button" class="btn btn-outline-danger me-2" id="btnDelete">
            <i class="fas fa-trash me-1"></i>Delete Reservation
        </button>
    </div>
    <div>
        <button type="submit" class="btn btn-primary me-2">
            <i class="fas fa-save me-1"></i>Save Changes
        </button>
        <button id="btnConfirm" data-id="{{ $reservation->id }}" class="btn btn-primary">
    <i class="fas fa-check me-1"></i> Confirm Reservation
</button>
    </div>
</div>
