@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Guest Booking</h4>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf

                        <h4>Guest Info</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ref">Reference Number</label>
                                    <input type="text" class="form-control @error('ref') is-invalid @enderror" id="ref" name="ref"
                                           value="{{ old('ref') }}"
                                           placeholder="Enter Reference">
                                    @error('ref')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="group_name">Group Name</label>
                                    <input type="text" class="form-control @error('group_name') is-invalid @enderror" id="group_name" name="group_name"
                                           value="{{ old('group_name') }}"
                                           placeholder="Enter Group Name" required>
                                    @error('group_name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nationality">Nationality</label>
                                    <select name="nationality" id="nationality" class="select2 form-control @error('nationality') is-invalid @enderror">
                                        <option value="">Select Nationality</option>
                                        @foreach(\App\Enums\Nationality::groupedByRegion() as $region => $nationalities)
                                            <optgroup label="{{ $region }}">
                                                @foreach($nationalities as $nationality)
                                                    <option value="{{ $nationality->value }}" {{ old('nationality') === $nationality->value ? 'selected' : '' }}>
                                                        {{ $nationality->getName() }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    @error('nationality')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <input type="text" class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks"
                                           value="{{ old('remarks') }}"
                                           placeholder="Enter Remarks">
                                    @error('remarks')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <h4 class="mb-3">Booking Details</h4>

                        <div class="row g-3">
                            <!-- File Owner -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="file_owner_display" class="form-label">File Owner</label>
                                    <input type="text" class="form-control" id="file_owner_display"
                                           value="{{ Auth::user()->name }}" disabled>
                                    <input type="hidden" id="file_owner" name="file_owner"
                                           value="{{ old('file_owner', Auth::user()->id) }}">
                                </div>
                            </div>

                            <!-- Source -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="channel_id" class="form-label">Source</label>
                                    <select name="channel_id" onchange="displayAgentCode(this)" id="channel_id"
                                            class="select2 form-control form-select @error('channel_id') is-invalid @enderror">
                                        <option value="">Select Source</option>
                                        @foreach ($channels as $channel)
                                            <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('channel_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Agent Code -->
                            <div class="col-md-2" id="agent_code_div" style="display: {{ old('channel_id') == 6 || (!old('channel_id') && Request::old('channel_id') == 6) ? 'block' : 'none' }};">
                                <div class="form-group">
                                    <label for="agent_code" class="form-label">Agents</label>
                                    <select name="agent_code" id="agent_code" class="form-select form-control @error('agent_code') is-invalid @enderror">
                                        <option value="">Choose Agent</option>
                                        @foreach ($agents as $agent)
                                            <option value="{{ $agent->id }}" {{ old('agent_code') == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('agent_code')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Booking Code -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="booking_code" class="form-label">Booking Code</label>
                                    <input type="text"
                                           id="booking_code"
                                           name="booking_code"
                                           value="{{ old('booking_code', str_pad($lastBooking+1, 3, '0', STR_PAD_LEFT) . '/' . now()->format('m/Y')) }}"
                                           class="form-control text-danger fw-bold @error('booking_code') is-invalid @enderror"
                                           placeholder="Booking Code"
                                           required>
                                    @error('booking_code')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <h4>Travel Info</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="arrival_date">Arrival Date & Time</label>
                                    <input type="datetime-local" class="form-control @error('arrival_date') is-invalid @enderror" id="arrival_date"
                                           name="arrival_date" value="{{ old('arrival_date') }}" required>
                                    @error('arrival_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pickup_details">Pick-up Details</label>
                                    <select name="pickup_details" class="select2 form-control @error('pickup_details') is-invalid @enderror" id="pickup_details">
                                        <option value="">Choose</option>
                                        @foreach ($pickup_dropoff_points as $pickup_dropoff_point)
                                            <option value="{{ $pickup_dropoff_point->id }}" {{ old('pickup_details') == $pickup_dropoff_point->id ? 'selected' : '' }}>{{ $pickup_dropoff_point->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pickup_details')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="departure_date">Departure Date & Time</label>
                                    <input type="datetime-local" class="form-control @error('departure_date') is-invalid @enderror" id="departure_date"
                                           name="departure_date" value="{{ old('departure_date') }}" required>
                                    @error('departure_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="drop_details">Drop-off Details</label>
                                    <select name="drop_details" class="select2 form-control @error('drop_details') is-invalid @enderror" id="drop_details">
                                        <option value="">Choose</option>
                                        @foreach ($pickup_dropoff_points as $pickup_dropoff_point)
                                            <option value="{{ $pickup_dropoff_point->id }}" {{ old('drop_details') == $pickup_dropoff_point->id ? 'selected' : '' }}>{{ $pickup_dropoff_point->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('drop_details')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <h4>Guest Counts</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="adults">Adults</label>
                                    <input type="number" class="form-control @error('adults') is-invalid @enderror" id="adults" name="adults"
                                           value="{{ old('adults') }}">
                                    @error('adults')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="children">Children</label>
                                    <input type="number" class="form-control @error('children') is-invalid @enderror" id="children" name="children"
                                           value="{{ old('children') }}">
                                    @error('children')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="infants">Infants</label>
                                    <input type="number" class="form-control @error('infants') is-invalid @enderror" id="infants" name="infants"
                                           value="{{ old('infants') }}">
                                    @error('infants')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rooms">Rooms</label>
                                    <input type="number" class="form-control @error('rooms') is-invalid @enderror" id="rooms" name="rooms"
                                           value="{{ old('rooms') }}">
                                    @error('rooms')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <h4>Services</h4>
                        @error('services')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="services mb-4">
                            @php
                                $serviceList = ['Accommodation', 'Flight', 'Transfers', 'Restaurant', 'Balloon', 'Mountain', 'Vehicle Hire', 'Activities'];
                                $selectedServices = old('services', []);
                            @endphp
                            <div class="row">
                                @foreach($serviceList as $service)
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input @error('services.*') is-invalid @enderror"
                                                   id="service_{{ strtolower(str_replace(' ', '_', $service)) }}"
                                                   name="services[]" value="{{ strtolower($service) }}"
                                                   {{ in_array(strtolower($service), (array) $selectedServices) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                   for="service_{{ strtolower(str_replace(' ', '_', $service)) }}">{{ $service }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <h4>Additional Notes</h4>
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-12 text-right">
                                <a href="{{ route('bookings.index') }}" class="btn btn-secondary px-4">Cancel</a>
                                <button class="btn btn-primary px-4" type="submit">
                                    Submit Booking
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
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
        document.addEventListener('DOMContentLoaded', function () {
            const channelId = document.querySelector('select[name="channel_id"]');
            if (channelId && channelId.value != 6) {
                document.getElementById('agent_code_div').style.display = 'none';
            }
        });
    </script>

    <script>

        document.addEventListener("DOMContentLoaded", function () {
            const bookingForm = document.querySelector("form");
            const serviceCheckboxes = document.querySelectorAll("input[name='services[]']");

            bookingForm.addEventListener("submit", function (e) {
                let isChecked = false;
                serviceCheckboxes.forEach(cb => {
                    if (cb.checked) isChecked = true
                });
                if (!isChecked) {
                    e.preventDefault();
                    alert("Please select at least one service.");
                }
            });
        });
    </script>
@endpush
