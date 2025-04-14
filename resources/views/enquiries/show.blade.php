@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-12">
            <div class="form-section">
                <h5><i class="fas fa-info-circle me-2"></i> Enquiry Details</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" value="{{ $enquiry->first_name }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" value="{{ $enquiry->last_name }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ $enquiry->email }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" value="{{ $enquiry->phone }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="tel" class="form-control" id="mobile" value="{{ $enquiry->mobile }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" value="{{ $enquiry->country }}" readonly>
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Address/Company</label>
                        <input type="text" class="form-control" id="address" value="{{ $enquiry->address }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" value="{{ $enquiry->city }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="postalCode" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="postalCode" value="{{ $enquiry->postal_code }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="arrivalDate" class="form-label">Arrival Date</label>
                        <input type="date" class="form-control" id="arrivalDate" value="{{ $enquiry->arrival_date }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="departureDate" class="form-label">Departure Date</label>
                        <input type="date" class="form-control" id="departureDate" value="{{ $enquiry->departure_date }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="flexibleDates" class="form-label">Flexible with dates?</label>
                        <input type="text" class="form-control" id="flexibleDates" value="{{ $enquiry->flexible_dates ? 'Yes' : 'No' }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="adults" class="form-label">Adults</label>
                        <input type="number" class="form-control" id="adults" value="{{ $enquiry->adults }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="children" class="form-label">Children (2-12)</label>
                        <input type="number" class="form-control" id="children" value="{{ $enquiry->children }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="infants" class="form-label">Infants (<2)</label>
                        <input type="number" class="form-control" id="infants" value="{{ $enquiry->infants }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="juniors" class="form-label">Juniors (13-17)</label>
                        <input type="number" class="form-control" id="juniors" value="{{ $enquiry->juniors }}" readonly>
                    </div>
                    <div class="col-12">
                        <label for="specialInterests" class="form-label">Special Interests/Requirements</label>
                        <textarea class="form-control" id="specialInterests" rows="2" readonly>{{ $enquiry->special_interests }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="budgetRange" class="form-label">Budget Range (per person)</label>
                        <input type="text" class="form-control" id="budgetRange" value="{{ $enquiry->budget_range }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="referralSource" class="form-label">How did you find us?</label>
                        <input type="text" class="form-control" id="referralSource" value="{{ $enquiry->referral_source }}" readonly>
                    </div>
                    <div class="col-12">
                        <label for="comments" class="form-label">Additional Comments</label>
                        <textarea class="form-control" id="comments" rows="3" readonly>{{ $enquiry->comments }}</textarea>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('enquiries.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Enquiries
                </a>
                <a href="{{ route('enquiries.edit', $enquiry->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Enquiry
                </a>
            </div>
        </div>
    </div>
</div>
@endsection