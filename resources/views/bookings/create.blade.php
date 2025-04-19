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
                                            <input type="text" class="form-control" id="ref" name="ref" placeholder="Enter Reference">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="group_name">Group Name</label>
                                            <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter Group Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="country_id">country_id</label>
                                            <select name="country_id" id="" class="form-control">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 hide">
                                        <div class="form-group">
                                            <label for="remarks">Remarks</label>
                                            <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Enter Remarks">
                                        </div>
                                    </div>
                                </div>

                                <h4 class="mb-3">Booking Details</h4>

                                <div class="row g-3">
                                    <!-- File Owner -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="file_owner_display" class="form-label">File Owner</label>
                                            <input type="text" class="form-control" id="file_owner_display" value="{{ Auth::user()->name }}" disabled>
                                            <input type="hidden" id="file_owner" name="file_owner" value="{{ Auth::user()->id }}">
                                        </div>
                                    </div>

                                    <!-- Source -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="channel_id" class="form-label">Source</label>
                                            <select name="channel_id" onchange="displayAgentCode(this)" id="channel_id" class="form-control form-select">
                                                <option value="">Select Source</option>
                                                @foreach ($channels as $channel)
                                                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Agent Code -->
                                    <div class="col-md-2" id="agent_code_div" style="display: none;">
                                        <div class="form-group">
                                            <label for="agent_code" class="form-label">Agents</label>
                                            <select name="agent_code" id="agent_code" class="form-select form-control">
                                                <option value="">Choose Agent</option>
                                                @foreach ($agents as $agent)
                                                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Booking Code -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="booking_code" class="form-label">Booking Code</label>
                                            <input type="text" 
                                                id="booking_code" 
                                                name="booking_code" 
                                                value="{{ str_pad($lastBooking+1, 3, '0', STR_PAD_LEFT) . "/" . now()->format('m/Y') }}" 
                                                class="form-control text-danger fw-bold" 
                                                placeholder="Booking Code" 
                                                required>
                                        </div>
                                    </div>
                                </div>


                                <h4>Travel Info</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="arrival_date">Arrival Date & Time</label>
                                            <input type="datetime-local" class="form-control" id="arrival_date" name="arrival_date" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="pickup_details">Pick-up Details</label>
                                            {{-- <input type="text" class="form-control" id="pickup_details" name="pickup_details"> --}}
                                            <select name="pickup_details" class="form-control" id="">
                                                <option value="Choose"></option>
                                                @foreach ($pickup_dropoff_points as $pickup_dropoff_point)
                                                    <option value="{{ $pickup_dropoff_point->id }}">{{ $pickup_dropoff_point->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="departure_date">Departure Date & Time</label>
                                            <input type="datetime-local" class="form-control" id="departure_date" name="departure_date" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="drop_details">Drop-off Details</label>
                                            {{-- <input type="text" class="form-control" id="drop_details" name="drop_details"> --}}
                                            <select name="drop_details" class="form-control" id="">
                                                <option value="Choose"></option>
                                                @foreach ($pickup_dropoff_points as $pickup_dropoff_point)
                                                    <option value="{{ $pickup_dropoff_point->id }}">{{ $pickup_dropoff_point->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <h4>Guest Counts</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="adults">Adults</label>
                                            <input type="number" class="form-control" id="adults" name="adults">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="children">Children</label>
                                            <input type="number" class="form-control" id="children" name="children">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="infants">Infants</label>
                                            <input type="number" class="form-control" id="infants" name="infants">
                                        </div>
                                    </div>
                                    <div class="hide col-md-2">
                                        <div class="form-group">
                                            <label for="rooms">Rooms</label>
                                            <input type="number" class="form-control" id="rooms" name="rooms">
                                        </div>
                                    </div>
                                </div>

                                <h4>Services</h4>
                                <div class="services mb-4">
                                    @php
                                        $serviceList = ['Accommodation', 'Flight', 'Transfers', 'Restaurant', 'Balloon', 'Mountain', 'Vehicle Hire', 'Activities'];
                                    @endphp
                                    <div class="row">
                                        @foreach($serviceList as $service)
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="service_{{ strtolower(str_replace(' ', '_', $service)) }}" name="services[]" value="{{ strtolower($service) }}">
                                                    <label class="form-check-label" for="service_{{ strtolower(str_replace(' ', '_', $service)) }}">{{ $service }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <h4>Additional Notes</h4>
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
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

    @section('scripts')
    <script>
        function displayAgentCode(obj) {
            console.log("Source selected: " + obj.value);
    
            if (obj.value == 6) {
                document.getElementById('agent_code_div').style.display = 'block';
            } else {
                document.getElementById('agent_code_div').style.display = 'none';
                document.getElementById('agent_code').value = '';
            }
        }
        // On page load, hide the agent code field initially
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('agent_code_div').style.display = 'none';
        });
    </script>
    @endsection
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

            const country_idField = document.getElementById("country_id");
            const remarksField = document.getElementById("remarks");

            country_idField.addEventListener("input", function () {
                if (country_idField.value.toLowerCase().includes("indian")) {
                    remarksField.value = "Provide PAN card copy";
                } else {
                    remarksField.value = "";
                }
            });
        });
    </script>
    @endpush
@endsection