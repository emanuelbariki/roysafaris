@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Guest Booking Form</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Create Guest Booking</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ isset($booking) ? route('bookings.update', $booking) : route('bookings.store') }}">
                                @csrf
                                @if(isset($booking))
                                    @method('PUT')
                                @endif

                                <h4>Guest Info</h4>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="ref">Reference Number</label>
                                            <input type="text" class="form-control" id="ref" name="ref" placeholder="Enter Reference" required value="{{ old('ref', $booking->ref ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="group_name">Group Name</label>
                                            <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter Group Name" required value="{{ old('group_name', $booking->group_name ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nationality">Nationality</label>
                                            <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Nationality" required value="{{ old('nationality', $booking->nationality ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="remarks">Remarks</label>
                                            <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Enter Remarks" value="{{ old('remarks', $booking->remarks ?? '') }}">
                                        </div>
                                    </div>
                                </div>

                                <h4>Booking Details</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="file_owner">File Owner</label>
                                            <input type="text" class="form-control" id="file_owner" name="file_owner" placeholder="File Owner" value="{{ old('file_owner', $booking->file_owner ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="agent_code">Agent Code</label>
                                            <input type="text" class="form-control" id="agent_code" name="agent_code" placeholder="Agent Code" value="{{ old('agent_code', $booking->agent_code ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="booking_code">Booking Code</label>
                                            <input type="text" class="form-control text-danger font-weight-bold" id="booking_code" name="booking_code" placeholder="Booking Code" required value="{{ old('booking_code', $booking->booking_code ?? '') }}">
                                        </div>
                                    </div>
                                </div>

                                <h4>Travel Info</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="arrival_date">Arrival Date & Time</label>
                                            <input type="datetime-local" class="form-control" id="arrival_date" name="arrival_date" required value="{{ old('arrival_date', isset($booking->arrival_date) ? \Carbon\Carbon::parse($booking->arrival_date)->format('Y-m-d\TH:i') : '') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="pickup_details">Pick-up Details</label>
                                            <input type="text" class="form-control" id="pickup_details" name="pickup_details" value="{{ old('pickup_details', $booking->pickup_details ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="departure_date">Departure Date & Time</label>
                                            <input type="datetime-local" class="form-control" id="departure_date" name="departure_date" required value="{{ old('departure_date', isset($booking->departure_date) ? \Carbon\Carbon::parse($booking->departure_date)->format('Y-m-d\TH:i') : '') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="drop_details">Drop-off Details</label>
                                            <input type="text" class="form-control" id="drop_details" name="drop_details" value="{{ old('drop_details', $booking->drop_details ?? '') }}">
                                        </div>
                                    </div>
                                </div>

                                <h4>Guest Counts</h4>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="adults">Adults</label>
                                            <input type="number" class="form-control" id="adults" name="adults" value="{{ old('adults', $booking->adults ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="children">Children</label>
                                            <input type="number" class="form-control" id="children" name="children" value="{{ old('children', $booking->children ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="infants">Infants</label>
                                            <input type="number" class="form-control" id="infants" name="infants" value="{{ old('infants', $booking->infants ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="rooms">Rooms</label>
                                            <input type="number" class="form-control" id="rooms" name="rooms" value="{{ old('rooms', $booking->rooms ?? '') }}">
                                        </div>
                                    </div>
                                </div>

                                <h4>Services</h4>
                                <div class="services mb-4">
                                    @php
                                        $serviceList = ['Accommodation', 'Flight', 'Transfers', 'Restaurant', 'Balloon', 'Mountain', 'Vehicle Hire', 'Activities'];
                                        $selectedServices = isset($booking) ? (is_array($booking->services) ? $booking->services : json_decode($booking->services, true)) : [];
                                    @endphp
                                    <div class="row">
                                        @foreach($serviceList as $service)
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="service_{{ strtolower(str_replace(' ', '_', $service)) }}" name="services[]" value="{{ strtolower($service) }}"
                                                    {{ in_array(strtolower($service), old('services', $selectedServices)) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="service_{{ strtolower(str_replace(' ', '_', $service)) }}">{{ $service }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <h4>Additional Notes</h4>
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes', $booking->notes ?? '') }}</textarea>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-sm-12 text-right">
                                        <button class="btn btn-primary px-4" type="submit">
                                            {{ isset($booking) ? 'Update Booking' : 'Submit Booking' }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const bookingForm = document.querySelector("form");
            const serviceCheckboxes = document.querySelectorAll("input[name='services[]']");

            bookingForm.addEventListener("submit", function (e) {
                let isChecked = false;
                serviceCheckboxes.forEach(cb => { if (cb.checked) isChecked = true });
                if (!isChecked) {
                    e.preventDefault();
                    alert("Please select at least one service.");
                }
            });

            const nationalityField = document.getElementById("nationality");
            const remarksField = document.getElementById("remarks");

            nationalityField.addEventListener("input", function () {
                if (nationalityField.value.toLowerCase().includes("indian")) {
                    remarksField.value = "Provide PAN card copy";
                } else {
                    remarksField.value = "";
                }
            });
        });
    </script>
    @endpush
@endsection