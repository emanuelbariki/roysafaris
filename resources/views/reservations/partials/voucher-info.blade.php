<!-- Voucher Section -->
@php
$reservation = $reservation ?? new \App\Models\Reservation();
@endphp

<div class="card shadow-sm rounded mb-4">
    <div class="card-body">
        <h6 class="section-header mb-3">
            <i class="fas fa-file-alt me-2"></i>VOUCHER INFO
        </h6>
        <div class="row g-3">
            <div class="col-md-4">
                <label for="voucher_no" class="form-label">Current Voucher. No</label>
                <input type="text" name="voucher_no" id="voucher_no"
                    value="{{ old('voucher_no', $reservation->voucher->id ?? str_pad($latestId,4,"0",STR_PAD_LEFT) ) }}"
                    class="form-control @error('voucher_no') is-invalid @enderror" readonly>
                @error('voucher_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- <div class="col-md-4">
                <label for="prior_version" class="form-label">Prior Ver. No</label>
                <input type="text" name="prior_version" id="prior_version"
                    value="{{ old('prior_version', $reservation->prior_version ?? '288819') }}"
                    class="form-control @error('prior_version') is-invalid @enderror" readonly>
                @error('prior_version') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div> --}}

            <div class="col-md-4">
                <label for="voucher_issue_date" class="form-label">Issue Date</label>
                <input type="date" name="voucher_issue_date" id="voucher_issue_date"
                value="{{ old('voucher_issue_date', $reservation->voucher->issue_date ?? \Carbon\Carbon::now()->toDateString()) }}"
                class="form-control @error('voucher_issue_date') is-invalid @enderror">
                @error('voucher_issue_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

    </div>
</div>