@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <form class="card" action="{{ route('enquiries.store') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h4 class="card-title text-danger">Client Information</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="tel" class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" id="mobile" name="mobile" value="{{ old('mobile') }}">
                            @error('mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="country" class="form-label">Country</label>
                            <select name="country_id" id="country" class="select2 form-select form-control {{ $errors->has('country_id') ? 'is-invalid' : '' }}" required>
                                <option value="" selected disabled>Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="address" class="form-label">Address / Company</label>
                            <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" id="address" name="address" value="{{ old('address') }}">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" id="city" name="city" value="{{ old('city') }}">
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control {{ $errors->has('postal_code') ? 'is-invalid' : '' }}" id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
                            @error('postal_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                            <input type="date" class="form-control {{ $errors->has('arrival_date') ? 'is-invalid' : '' }}" id="arrival_date" name="arrival_date" value="{{ old('arrival_date') }}" required>
                            @error('arrival_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="departure_date" class="form-label">Departure Date</label>
                            <input type="date" class="form-control {{ $errors->has('departure_date') ? 'is-invalid' : '' }}" id="departure_date" name="departure_date" value="{{ old('departure_date') }}" required>
                            @error('departure_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="flexible_dates" class="form-label">Flexible with dates?</label>
                            <select class="form-select form-control {{ $errors->has('flexible_dates') ? 'is-invalid' : '' }}" id="flexible_dates" name="flexible_dates">
                                <option value="no" {{ old('flexible_dates') === 'no' ? 'selected' : '' }}>No, these are fixed dates</option>
                                <option value="yes" {{ old('flexible_dates') === 'yes' ? 'selected' : '' }}>Yes, I'm flexible</option>
                            </select>
                            @error('flexible_dates')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="adults" class="form-label">Adults</label>
                            <input type="number" class="form-control {{ $errors->has('adults') ? 'is-invalid' : '' }}" id="adults" name="adults" min="1" value="{{ old('adults', 1) }}" required>
                            @error('adults')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="children" class="form-label">Children (2-12)</label>
                            <input type="number" class="form-control {{ $errors->has('children') ? 'is-invalid' : '' }}" id="children" name="children" min="0" value="{{ old('children', 0) }}">
                            @error('children')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="infants" class="form-label">Infants (&lt;2)</label>
                            <input type="number" class="form-control {{ $errors->has('infants') ? 'is-invalid' : '' }}" id="infants" name="infants" min="0" value="{{ old('infants', 0) }}">
                            @error('infants')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="juniors" class="form-label">Juniors (13-17)</label>
                            <input type="number" class="form-control {{ $errors->has('juniors') ? 'is-invalid' : '' }}" id="juniors" name="juniors" min="0" value="{{ old('juniors', 0) }}">
                            @error('juniors')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                            <select class="form-select form-control {{ $errors->has('budget_range') ? 'is-invalid' : '' }}" id="budget_range" name="budget_range">
                                <option value="" selected disabled>Select Budget Range</option>
                                <option value="1000-2000" {{ old('budget_range') === '1000-2000' ? 'selected' : '' }}>$1,000 - $2,000</option>
                                <option value="2000-3000" {{ old('budget_range') === '2000-3000' ? 'selected' : '' }}>$2,000 - $3,000</option>
                                <option value="3000-5000" {{ old('budget_range') === '3000-5000' ? 'selected' : '' }}>$3,000 - $5,000</option>
                                <option value="5000+" {{ old('budget_range') === '5000+' ? 'selected' : '' }}>$5,000+</option>
                            </select>
                            @error('budget_range')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="referral_source" class="form-label ">How did you find us?</label>
                            <select class="form-select form-control {{ $errors->has('referral_source') ? 'is-invalid' : '' }}" id="referral_source" name="referral_source" required>
                                <option value="" selected disabled>Select an option</option>
                                @foreach ($channels as $c)
                                    <option value="{{ $c->id }}" {{ old('referral_source') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @error('referral_source')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" id="status" name="status" required>
                                <option value="" selected disabled>Select an option</option>
                                <option value="enquiry" {{ old('status') === 'enquiry' ? 'selected' : '' }}>Enquiry</option>
                                <option value="followup" {{ old('status') === 'followup' ? 'selected' : '' }}>Follow Up</option>
                                <option value="confirmed" {{ old('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="comments" class="form-label">Additional Comments</label>
                            <textarea class="form-control {{ $errors->has('comments') ? 'is-invalid' : '' }}" id="comments" name="comments" rows="3">{{ old('comments') }}</textarea>
                            @error('comments')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-header border-top">
                    <h4 class="card-title text-danger">Tour Interests</h4>
                </div>

                <div class="card-body">
                    <p>Please select all that apply:</p>
                    <div class="row">
                        <div class="col-md-4 interest-checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="accommodationOnly">
                                <label class="form-check-label" for="accommodationOnly">Accommodation only</label>
                            </div>
                        </div>

                        <div class="col-md-4 interest-checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flyingSafari">
                                <label class="form-check-label" for="flyingSafari">Flying Safari</label>
                            </div>
                        </div>

                        <div class="col-md-4 interest-checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="mountainClimbing">
                                <label class="form-check-label" for="mountainClimbing">Mountain climbing</label>
                            </div>
                        </div>

                        <div class="col-md-4 interest-checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="beach">
                                <label class="form-check-label" for="beach">Beach</label>
                            </div>
                        </div>

                        <div class="col-md-4 interest-checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hotelTransfers">
                                <label class="form-check-label" for="hotelTransfers">Hotel & Airport
                                    Transfers</label>
                            </div>
                        </div>

                        <div class="col-md-4 interest-checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="parkFee">
                                <label class="form-check-label" for="parkFee">Park fee</label>
                            </div>
                        </div>

                        <div class="col-md-4 interest-checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="campingSafari">
                                <label class="form-check-label" for="campingSafari">Camping safari</label>
                            </div>
                        </div>

                        <div class="col-md-4 interest-checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lodgeCampSafari">
                                <label class="form-check-label" for="lodgeCampSafari">Lodge & Camp safari</label>
                            </div>
                        </div>

                        <div class="col-md-4 interest-checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="southernCircuit">
                                <label class="form-check-label" for="southernCircuit">Southern Circuit
                                    Safari</label>
                            </div>
                        </div>

                        <div class="col-md-4 interest-checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="excursions">
                                <label class="form-check-label" for="excursions">Excursions</label>
                            </div>
                        </div>

                        <div class="col-md-4 interest-checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lodgeSafari">
                                <label class="form-check-label" for="lodgeSafari">Lodge safari</label>
                            </div>
                        </div>

                        <div class="col-md-4 interest-checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="tailorMade">
                                <label class="form-check-label" for="tailorMade">Tailor-made</label>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3"/>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="special_interests" class="form-label">Special Interests/Requirements</label>
                            <textarea class="form-control {{ $errors->has('special_interests') ? 'is-invalid' : '' }}" id="special_interests" name="special_interests" rows="2"
                                      placeholder="Any specific animals you want to see, dietary requirements, accessibility needs, etc.">{{ old('special_interests') }}</textarea>
                            @error('special_interests')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <h5 class="text-muted">🔒 Internal Use</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="safariRef" class="form-label">Safari Reference</label>
                            <input type="text" class="form-control" id="safariRef" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="enquiryDate" class="form-label">Enquiry Date</label>
                            <input type="date" class="form-control" id="enquiryDate" value="2024-01-17">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="fileOwner" class="form-label">File Owner</label>
                            <div class="input-group">
                                <input type="text" class="form-control" disabled id="fileOwner"
                                       value="{{ Auth::user()->name }}">
                            </div>
                        </div>

                        <div class="hide col-md-6 mb-3">
                            <label for="nextAction" class="form-label">Next Action</label>
                            <input type="text" class="form-control" id="nextAction">
                        </div>
                        <div class="hide col-md-6 mb-3">
                            <label for="nextActionDate" class="form-label">Next Action Date</label>
                            <input type="date" class="form-control" id="nextActionDate">
                        </div>
                        <div class="col-md-6 mb-3 hide">
                            <label for="priority" class="form-label">Priority</label>
                            <select class="form-select form-control" id="priority">
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-secondary" id="saveDraftBtn">
                            Save Draft
                        </button>
                        <button type="submit" class="btn btn-primary ml-2">Submit Enquiry</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
