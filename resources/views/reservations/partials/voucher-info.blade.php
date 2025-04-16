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
                <label for="current_version" class="form-label">Current Ver. No</label>
                <input type="text" name="current_version" id="current_version"
                    value="{{ old('current_version', $reservation->current_version ?? '29649') }}"
                    class="form-control @error('current_version') is-invalid @enderror" readonly>
                @error('current_version') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="prior_version" class="form-label">Prior Ver. No</label>
                <input type="text" name="prior_version" id="prior_version"
                    value="{{ old('prior_version', $reservation->prior_version ?? '288819') }}"
                    class="form-control @error('prior_version') is-invalid @enderror" readonly>
                @error('prior_version') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="voucher_issue_date" class="form-label">Issue Date</label>
                <input type="date" name="voucher_issue_date" id="voucher_issue_date"
                    value="{{ old('voucher_issue_date', $reservation->voucher_issue_date ?? '2025-03-20') }}"
                    class="form-control @error('voucher_issue_date') is-invalid @enderror">
                @error('voucher_issue_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-4">
            <h6 class="section-header"><i class="fas fa-file-alt me-2"></i>VOUCHER INFO</h6>
            <form id="voucherForm">
                <div class="row g-3 mt-2">
                    <div class="col-md-4">
                        <label class="form-label">Current Ver. No</label>
                        <input type="text" name="current_version"
                            value="{{ old('current_version', $voucher->current_version ?? '29649') }}"
                            class="form-control" readonly>
                        @error('current_version') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Prior Ver. No</label>
                        <input type="text" name="prior_version"
                            value="{{ old('prior_version', $voucher->prior_version ?? '288819') }}" class="form-control"
                            readonly>
                        @error('prior_version') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Issue Date</label>
                        <input type="date" name="issue_date"
                            value="{{ old('issue_date', $voucher->issue_date ?? '2025-03-20') }}" class="form-control">
                        @error('issue_date') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="d-flex mt-3">
                    <button id="btnPrint" class="btn btn-outline-primary me-2">
                        <i class="fas fa-print me-1"></i>Print Voucher
                    </button>

                    <button id="btnDuplicate" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-copy me-1"></i>Print Duplicate
                    </button>

                    <button id="btnAmend" class="btn btn-outline-info me-2">
                        <i class="fas fa-edit me-1"></i>Print Amendment
                    </button>

                    <button id="btnEmail" class="btn btn-outline-success">
                        <i class="fas fa-envelope me-1"></i>Email Voucher
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>