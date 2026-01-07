@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <form class="card" action="{{ route('enquiries.update', $enquiry->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-header">
                    <h4 class="card-title text-danger">Client Information</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                   value="{{ old('first_name', $enquiry->first_name) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                   value="{{ old('last_name', $enquiry->last_name) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ old('email', $enquiry->email) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                   value="{{ old('phone', $enquiry->phone) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="tel" class="form-control" id="mobile" name="mobile"
                                   value="{{ old('mobile', $enquiry->mobile) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="country" class="form-label">Country</label>
                            <select name="country_id" id="country" class="select2 form-select form-control" required>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}"
                                            {{ old('country_id', $enquiry->country_id) == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="address" class="form-label">Address / Company</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="{{ old('address', $enquiry->address) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city"
                                   value="{{ old('city', $enquiry->city) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code"
                                   value="{{ old('postal_code', $enquiry->postal_code) }}">
                        </div>
                    </div>
                </div>

                <div class="card-header border-top">
                    <h4 class="card-title text-danger">Travel Details</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="arrival_date" class="form-label">Arrival Date</label>
                            <input type="date" class="form-control" id="arrival_date" name="arrival_date"
                                   value="{{ old('arrival_date', $enquiry->arrival_date) }}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="departure_date" class="form-label">Departure Date</label>
                            <input type="date" class="form-control" id="departure_date" name="departure_date"
                                   value="{{ old('departure_date', $enquiry->departure_date) }}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="flexible_dates" class="form-label">Flexible with dates?</label>
                            <select class="form-select form-control" id="flexible_dates" name="flexible_dates">
                                <option value="no" {{ old('flexible_dates', $enquiry->flexible_dates) === 'no' ? 'selected' : '' }}>
                                    No, these are fixed dates
                                </option>
                                <option value="yes" {{ old('flexible_dates', $enquiry->flexible_dates) === 'yes' ? 'selected' : '' }}>
                                    Yes, I'm flexible
                                </option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="adults" class="form-label">Adults</label>
                            <input type="number" class="form-control" id="adults" name="adults" min="1"
                                   value="{{ old('adults', $enquiry->adults) }}" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="children" class="form-label">Children (2-12)</label>
                            <input type="number" class="form-control" id="children" name="children" min="0"
                                   value="{{ old('children', $enquiry->children ?? 0) }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="infants" class="form-label">Infants (&lt;2)</label>
                            <input type="number" class="form-control" id="infants" name="infants" min="0"
                                   value="{{ old('infants', $enquiry->infants ?? 0) }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="juniors" class="form-label">Juniors (13-17)</label>
                            <input type="number" class="form-control" id="juniors" name="juniors" min="0"
                                   value="{{ old('juniors', $enquiry->juniors ?? 0) }}">
                        </div>
                    </div>
                </div>

                <div class="card-header border-top">
                    <h4 class="card-title text-danger">Budget & Additional Information</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="budget_range" class="form-label">Budget Range (per person)</label>
                            <select class="form-select form-control" id="budget_range" name="budget_range">
                                <option value="" selected disabled>Select Budget Range</option>
                                <option value="1000-2000" {{ old('budget_range', $enquiry->budget_range) === '1000-2000' ? 'selected' : '' }}>
                                    $1,000 - $2,000
                                </option>
                                <option value="2000-3000" {{ old('budget_range', $enquiry->budget_range) === '2000-3000' ? 'selected' : '' }}>
                                    $2,000 - $3,000
                                </option>
                                <option value="3000-5000" {{ old('budget_range', $enquiry->budget_range) === '3000-5000' ? 'selected' : '' }}>
                                    $3,000 - $5,000
                                </option>
                                <option value="5000+" {{ old('budget_range', $enquiry->budget_range) === '5000+' ? 'selected' : '' }}>
                                    $5,000+
                                </option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="referral_source" class="form-label ">How did you find us?</label>
                            <select class="form-select form-control" id="referral_source" name="referral_source" required>
                                <option value="" selected disabled>Select an option</option>
                                @foreach ($channels as $c)
                                    <option value="{{ $c->id }}"
                                            {{ old('referral_source', $enquiry->referral_source) == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select form-control" id="status" name="status" required>
                                <option value="" selected disabled>Select an option</option>
                                <option value="enquiry" {{ old('status', $enquiry->status) === 'enquiry' ? 'selected' : '' }}>
                                    Enquiry
                                </option>
                                <option value="followup" {{ old('status', $enquiry->status) === 'followup' ? 'selected' : '' }}>
                                    Follow Up
                                </option>
                                <option value="confirmed" {{ old('status', $enquiry->status) === 'confirmed' ? 'selected' : '' }}>
                                    Confirmed
                                </option>
                                <option value="cancelled" {{ old('status', $enquiry->status) === 'cancelled' ? 'selected' : '' }}>
                                    Cancelled
                                </option>
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="comments" class="form-label">Additional Comments</label>
                            <textarea class="form-control" id="comments" name="comments" rows="3">{{ old('comments', $enquiry->comments) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card-header border-top">
                    <h4 class="card-title text-danger">Tour Interests</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="special_interests" class="form-label">Special Interests/Requirements</label>
                            <textarea class="form-control" id="special_interests" name="special_interests" rows="2"
                                      placeholder="Any specific animals you want to see, dietary requirements, accessibility needs, etc.">{{ old('special_interests', $enquiry->special_interests) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('enquiries.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary ml-2">Update Enquiry</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
