@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow rounded">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create New Enquiry</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('enquiries.store') }}" method="POST" id="enquiryForm">
                        @csrf

                        {{-- Client Information --}}
                        <h5 class="border-bottom pb-2 mb-4">Client Information</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="col-md-6">
                                <label for="mobile" class="form-label">Mobile</label>
                                <input type="tel" class="form-control" id="mobile" name="mobile">
                            </div>
                            <div class="col-md-6">
                                <label for="country" class="form-label">Country</label>
                                <select name="country_id" id="country" class="form-select form-control" required>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="address" class="form-label">Address / Company</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city">
                            </div>
                            <div class="col-md-6">
                                <label for="postal_code" class="form-label">Postal Code</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code">
                            </div>
                        </div>

                        {{-- Travel Details --}}
                        <h5 class="border-bottom mt-5 pb-2 mb-4">Travel Details</h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="arrival_date" class="form-label">Arrival Date</label>
                                <input type="date" class="form-control" id="arrival_date" name="arrival_date" required>
                            </div>
                            <div class="col-md-4">
                                <label for="departure_date" class="form-label">Departure Date</label>
                                <input type="date" class="form-control" id="departure_date" name="departure_date" required>
                            </div>
                            <div class="col-md-4">
                                <label for="flexible_dates" class="form-label">Flexible with dates?</label>
                                <select class="form-select form-control" id="flexible_dates" name="flexible_dates">
                                    <option value="no">No, these are fixed dates</option>
                                    <option value="yes">Yes, I'm flexible</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="adults" class="form-label">Adults</label>
                                <input type="number" class="form-control" id="adults" name="adults" min="1" value="1" required>
                            </div>
                            <div class="col-md-3">
                                <label for="children" class="form-label">Children (2-12)</label>
                                <input type="number" class="form-control" id="children" name="children" min="0" value="0">
                            </div>
                            <div class="col-md-3">
                                <label for="infants" class="form-label">Infants (&lt;2)</label>
                                <input type="number" class="form-control" id="infants" name="infants" min="0" value="0">
                            </div>
                            <div class="col-md-3">
                                <label for="juniors" class="form-label">Juniors (13-17)</label>
                                <input type="number" class="form-control" id="juniors" name="juniors" min="0" value="0">
                            </div>
                        </div>

                        {{-- Budget & Info --}}
                        <h5 class="border-bottom mt-5 pb-2 mb-4">Budget & Additional Information</h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="budget_range" class="form-label">Budget Range (per person)</label>
                                <select class="form-select form-control" id="budget_range" name="budget_range">
                                    <option value="" selected disabled>Select Budget Range</option>
                                    <option value="1000-2000">$1,000 - $2,000</option>
                                    <option value="2000-3000">$2,000 - $3,000</option>
                                    <option value="3000-5000">$3,000 - $5,000</option>
                                    <option value="5000+">$5,000+</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="referral_source" class="form-label ">How did you find us?</label>
                                <select class="form-select form-control" id="referral_source" name="referral_source" required>
                                    <option value="" selected disabled>Select an option</option>
                                    @foreach ($channels as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select form-control" id="status" name="status" required>
                                    <option value="" selected disabled>Select an option</option>
                                    <option value="followup">Follow Up</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="comments" class="form-label">Additional Comments</label>
                                <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                            </div>
                        </div>
                                            <!-- Tour Interests Section -->
                    
                        <h5><i class="fas fa-binoculars me-2"></i> Tour Interests</h5>
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
                                    <label class="form-check-label" for="hotelTransfers">Hotel & Airport Transfers</label>
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
                                    <label class="form-check-label" for="southernCircuit">Southern Circuit Safari</label>
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
                        <div class="mt-3">
                            <label for="specialInterests" class="form-label">Special Interests/Requirements</label>
                            <textarea class="form-control" id="specialInterests" rows="2" placeholder="Any specific animals you want to see, dietary requirements, accessibility needs, etc."></textarea>
                        </div>
                                        <!-- Internal Use Section -->
                                        
                        <h5><i class="fas fa-lock me-2"></i> Internal Use</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="safariRef" class="form-label">Safari Reference</label>
                                <input type="text" class="form-control" id="safariRef" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="enquiryDate" class="form-label">Enquiry Date</label>
                                <input type="date" class="form-control" id="enquiryDate" value="2024-01-17">
                            </div>
                            <div class="col-md-6">
                                <label for="fileOwner" class="form-label">File Owner</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" disabled id="fileOwner" value="{{ Auth::user()->name }}">
                                    {{-- <button class="btn btn-outline-secondary" type="button" id="updateOwnerBtn">Update</button> --}}
                                </div>
                            </div>
                            <div class="hide col-md-6">
                                <label for="nextAction" class="form-label">Next Action</label>
                                <input type="text" class="form-control" id="nextAction">
                            </div>
                            <div class="hide col-md-6">
                                <label for="nextActionDate" class="form-label">Next Action Date</label>
                                <input type="date" class="form-control" id="nextActionDate">
                            </div>
                            <div class="col-md-6 hide">
                                <label for="priority" class="form-label">Priority</label>
                                <select class="form-select form-control" id="priority">
                                    <option value="low">Low</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="high">High</option>
                                    <option value="urgent">Urgent</option>
                                </select>
                            </div>
                        </div>
                    

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary" id="saveDraftBtn">Save Draft</button>
                            <button type="submit" class="btn btn-primary">Submit Enquiry</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <script src="{{ asset('js/validations.js') }}" defer></script>
@endsection