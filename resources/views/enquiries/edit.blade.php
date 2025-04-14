<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Enquiry</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
@extends('layouts.app')

@section('content')
<style>
    .form-section {
        background: #f8f9fa;
        padding: 20px 25px;
        margin-bottom: 30px;
        border-radius: 10px;
        border: 1px solid #dee2e6;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
    .form-section h5 {
        margin-bottom: 20px;
        font-weight: 600;
        color: #343a40;
    }
    .required-field::after {
        content: " *";
        color: red;
    }
</style>

<div class="container mt-4 mb-5">
    <h3 class="mb-4">Edit Enquiry</h3>

    <form action="{{ route('enquiries.update', $enquiry->id) }}" method="POST" id="enquiryForm">
        @csrf
        @method('PUT')

        <!-- Client Information -->
        <div class="form-section">
            <h5>Client Information</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="firstName" class="form-label required-field">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="first_name" value="{{ old('first_name', $enquiry->first_name) }}" required>
                </div>
                <div class="col-md-6">
                    <label for="lastName" class="form-label required-field">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="last_name" value="{{ old('last_name', $enquiry->last_name) }}" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label required-field">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $enquiry->email) }}" required>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label required-field">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $enquiry->phone) }}" required>
                </div>
                <div class="col-md-6">
                    <label for="mobile" class="form-label">Mobile</label>
                    <input type="tel" class="form-control" id="mobile" name="mobile" value="{{ old('mobile', $enquiry->mobile) }}">
                </div>
                <div class="col-md-6">
                    <label for="country" class="form-label required-field">Country</label>
                    <select name="country_id" id="country" class="form-select form-control" required>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ old('country_id', $enquiry->country_id) == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label for="address" class="form-label">Address/Company</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $enquiry->address) }}">
                </div>
                <div class="col-md-6">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $enquiry->city) }}">
                </div>
                <div class="col-md-6">
                    <label for="postalCode" class="form-label">Postal Code</label>
                    <input type="text" class="form-control" id="postalCode" name="postal_code" value="{{ old('postal_code', $enquiry->postal_code) }}">
                </div>
            </div>
        </div>

        <!-- Travel Details -->
        <div class="form-section">
            <h5>Travel Details</h5>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="arrivalDate" class="form-label required-field">Arrival Date</label>
                    <input type="date" class="form-control" id="arrivalDate" name="arrival_date" value="{{ old('arrival_date', $enquiry->arrival_date) }}" required>
                </div>
                <div class="col-md-4">
                    <label for="departureDate" class="form-label required-field">Departure Date</label>
                    <input type="date" class="form-control" id="departureDate" name="departure_date" value="{{ old('departure_date', $enquiry->departure_date) }}" required>
                </div>
                <div class="col-md-4">
                    <label for="flexibleDates" class="form-label">Flexible with dates?</label>
                    <select class="form-select form-control" id="flexibleDates" name="flexible_dates">
                        <option value="no" {{ old('flexible_dates', $enquiry->flexible_dates) == 'no' ? 'selected' : '' }}>No, these are fixed dates</option>
                        <option value="yes" {{ old('flexible_dates', $enquiry->flexible_dates) == 'yes' ? 'selected' : '' }}>Yes, I'm flexible</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="adults" class="form-label required-field">Adults</label>
                    <input type="number" class="form-control" id="adults" name="adults" min="1" value="{{ old('adults', $enquiry->adults) }}" required>
                </div>
                <div class="col-md-3">
                    <label for="children" class="form-label">Children (2-12)</label>
                    <input type="number" class="form-control" id="children" name="children" min="0" value="{{ old('children', $enquiry->children) }}">
                </div>
                <div class="col-md-3">
                    <label for="infants" class="form-label">Infants (&lt;2)</label>
                    <input type="number" class="form-control" id="infants" name="infants" min="0" value="{{ old('infants', $enquiry->infants) }}">
                </div>
                <div class="col-md-3">
                    <label for="juniors" class="form-label">Juniors (13-17)</label>
                    <input type="number" class="form-control" id="juniors" name="juniors" min="0" value="{{ old('juniors', $enquiry->juniors) }}">
                </div>
            </div>
        </div>

        <!-- Budget & Additional Info -->
        <div class="form-section">
            <h5>Budget & Additional Information</h5>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="budgetRange" class="form-label">Budget Range (per person)</label>
                    <select class="form-select form-control" id="budgetRange" name="budget_range">
                        <option value="" disabled>Select Budget Range</option>
                        <option value="1000-2000" {{ old('budget_range', $enquiry->budget_range) == '1000-2000' ? 'selected' : '' }}>$1,000 - $2,000</option>
                        <option value="2000-3000" {{ old('budget_range', $enquiry->budget_range) == '2000-3000' ? 'selected' : '' }}>$2,000 - $3,000</option>
                        <option value="3000-5000" {{ old('budget_range', $enquiry->budget_range) == '3000-5000' ? 'selected' : '' }}>$3,000 - $5,000</option>
                        <option value="5000+" {{ old('budget_range', $enquiry->budget_range) == '5000+' ? 'selected' : '' }}>$5,000+</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="referralSource" class="form-label required-field">How did you find us?</label>
                    <select class="form-select form-control" id="referralSource" name="referral_source" required>
                        <option value="" disabled>Select an option</option>
                        <option value="google" {{ old('referral_source', $enquiry->referral_source) == 'google' ? 'selected' : '' }}>Google Search</option>
                        <option value="social" {{ old('referral_source', $enquiry->referral_source) == 'social' ? 'selected' : '' }}>Social Media</option>
                        <option value="recommendation" {{ old('referral_source', $enquiry->referral_source) == 'recommendation' ? 'selected' : '' }}>Friend/Family Recommendation</option>
                        <option value="travel_agent" {{ old('referral_source', $enquiry->referral_source) == 'travel_agent' ? 'selected' : '' }}>Travel Agent</option>
                        <option value="other" {{ old('referral_source', $enquiry->referral_source) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label required-field">Status</label>
                    <select class="form-select form-control" id="status" name="status" required>
                        <option value="" selected disabled>Select an option</option>
                        <option value="followup" {{ old('status', $enquiry->status) == 'followup' ? 'selected' : '' }}>Follow Up</option>
                        <option value="confirmed" {{ old('status', $enquiry->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ old('status', $enquiry->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="comments" class="form-label">Additional Comments</label>
                    <textarea class="form-control" id="comments" name="comments" rows="3">{{ old('comments', $enquiry->comments) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Form Buttons -->
        <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-outline-secondary" onclick="saveDraft()">Save Draft</button>
            <div>
                <button type="reset" class="btn btn-danger me-2" onclick="return confirm('Reset the form?')">Reset Form</button>
                <button type="submit" class="btn btn-primary">Submit Enquiry</button>
            </div>
        </div>
    </form>
</div>

<script>
    function saveDraft() {
        alert('Save draft clicked. Implement backend/localStorage logic here.');
    }
</script>
<script src="{{ asset('js/validations.js') }}"></script>
@endsection

</body>
</html>