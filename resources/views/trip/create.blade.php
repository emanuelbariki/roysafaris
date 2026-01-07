@extends('layouts.app')

@push('action-buttons')
    <div class="col-auto align-self-center">
        <a href="{{ route('trips.index') }}" class="btn btn-primary btn-sm">
            Back
        </a>
    </div>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create trip</h4>
                </div>

                <div class="card-body">
                    <form
                        action="{{ isset($driver) ? route('trips.update', $driver->id) : route('trips.store') }}"
                        method="POST">
                        @csrf
                        @if (isset($driver))
                            @method('PUT')
                        @endif
                        {{--
                            trip_name,
                            trip_type_id,
                            driver_id,
                            fleet_id,
                            no_passengers,
                            start_date,
                            end_date,
                            status [Scheduled,Ongoing,Completed],
                            notes)
                        --}}

                        <!-- Trip Details -->
                        <h4>Trip Details</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Trip Name</label>
                                    <input type="text" class="form-control" id="name" name="trip[name]"
                                           placeholder="Group / Booking Name" required
                                           value="{{ isset($trip) ? $trip->name : old('name') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_date">Trip Type</label>
                                    <select name="trip[trip_type_id]" class="form-control" id="">
                                        <option selected disabled>Select Option</option>
                                        @foreach ($triptypes as $t)
                                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" name="trip[start_date]" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="date" class="form-control" name="trip[end_date]" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="no_passengers">No. of Passengers</label>
                                    <input type="number" placeholder="1, 2, 3, etc..." class="form-control"
                                           name="trip[no_passengers]" required>
                                </div>
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="trip[status]" class="form-control" required>
                                        <option value="Scheduled">Scheduled</option>
                                        <option value="Ongoing">Ongoing</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Trip Stops -->
                        <h4>Trip Stops</h4>

                        <div id="trip-stops-container">
                            <table class="table table-bordered table-dark table-sm mb-0 table-centered table-hover">
                                <thead class="bg-dark">
                                <tr>
                                    <th>Pickup</th>
                                    <th>Destination</th>
                                    <th>Distance</th>
                                    <th>ETD</th>
                                    <th>ETA</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody class="stops">
                                <tr>
                                    <td>Kilimanjaro international Airport</td>
                                    <td>African Tulip, Arusha</td>
                                    <td>25 Km</td>
                                    <td>06:30 am</td>
                                    <td>07:30 am</td>
                                    <td><a href="#" onclick="deleteStop(this)"
                                           class="badge badge-soft-danger">Delete</a></td>
                                </tr>
                                </tbody>
                            </table>

                            <td class="mb-5">
                                <br>
                                <button type="button" class="mb-2 btn btn-outline-primary px-3" data-toggle="modal"
                                        data-target="#bd-example-modal-xl">
                                    Add Trip Stop
                                </button>
                            </td>
                        </div>

                        <!-- Trip Services -->
                        <h4>Trip Services</h4>
                        <div id="trip-services-container">
                            <table class="table table-bordered table-dark table-sm mb-0 table-centered table-hover">
                                <thead class="bg-dark">
                                <tr>
                                    <th>Service</th>
                                    <th>Quantity</th>
                                    <th>Notes</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody class="tripservices">
                                <tr>
                                    <td>Lunch Boxes</td>
                                    <td>5</td>
                                    <td>Some notes here</td>
                                    <td><a href="#" onclick="deleteStop(this)"
                                           class="badge badge-soft-danger">Delete</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" onclick="addTripService()" class="btn btn-outline-primary mt-2">Add
                            Service
                        </button>

                        <hr>
                        <h4>Driver Details</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_date">Select Driver</label>
                                    <select name="trip[driver_id]" class="form-control" id="drivers">
                                        <option selected disabled onchange="getDriverFleet(this)">Select Option</option>
                                        @foreach ($drivers as $t)
                                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="start_date">Select Car</label>
                                    <select name="trip[fleet_id]" class="form-control" id="driverFleets">
                                        <option selected disabled>Select Option</option>
                                        @foreach ($fleets as $t)
                                            <option value="{{ $t->id }}">{{ $t->make_model }}
                                                | {{ $t->reg_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="end_date">Instructions</label>
                                    <textarea name="trip[instructions]" id="" class="form-control"
                                              placeholder="Instructions" cols="20" rows="2"></textarea>
                                    {{-- <input type="text" class="form-control" name="trip[end_date]" required> --}}
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary px-4">Save Data</button>
                            </div>
                        </div>
                    </form>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

    </div>
@endsection

@push('modal')
    <div class="modal fade bd-example-modal-xl" id="bd-example-modal-xl" tabindex="-1" role="dialog"
         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myExtraLargeModalLabel">Extra Large Modal</h6>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div><!--end modal-header-->
                <div class="modal-body" style="height: 80vh;">
                    <h5 class="mt-0">Overflowing text to show scroll behavior</h5>
                    <iframe src="{{ config('maps.url') }}" id="myIframe"
                            style="border:none;height: 100%;width:100%;" frameborder="0"></iframe>
                </div><!--end modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" onclick="getIframeData()" data-bs-dismiss="modal"
                            class="btn btn-primary btn-sm">Save changes
                    </button>
                </div><!--end modal-footer-->
            </div><!--end modal-content-->
        </div><!--end modal-dialog-->
    </div><!--end modal-->
@endpush

@push('scripts')
    <!-- JavaScript for Dynamic Fields -->
    <script>
        function getIframeData() {
            let iframe = document.getElementById("myIframe");
            let iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
            let pickup = iframeDoc.getElementById("pickup").value; // Assuming form has an input with id "name"
            let dropoff = iframeDoc.getElementById("destination").value; // Assuming form has an input with id "name"
            let distance = iframeDoc.getElementById("distanceInKm").value; // Assuming form has an input with id "name"
            console.log(pickup);
            console.log(dropoff);
            console.log(distance);
            addStop(pickup, dropoff, distance)
            $('#bd-example-modal-xl').modal('hide');

            // alert("Collected data: " + inputData);
        }

        function addStop(pickup_location, dropoff_location, distance) {
            var row = `
                <tr>
                    <td>
                        <input type="hidden" name="pickup_location[]" value="${pickup_location}">
                        ${pickup_location}
                    </td>
                    <td>
                        <input type="hidden" name="dropoff_location[]" value="${dropoff_location}">
                        ${dropoff_location}
                    </td>
                    <td>
                        <input type="hidden" name="distance[]" value="${distance}">
                        ${distance} Km
                    </td>
                    <td><input type="datetime-local" class="input-danger" name="etd[]"></td>
                    <td><input type="datetime-local" class="input-danger" name="eta[]"></td>
                    <td><a href="#" onclick="deleteStop(this)" class="badge badge-soft-danger">Delete</a></td>
                </tr>
            `;
            $('.stops').append(row);
        }

        function deleteStop(button) {
            $(button).closest('tr').remove();
        }

        function addTripService() {
            var tripServices = @json($tripServices); // Pass the Blade data to JS

            var serviceContainer = `
                <tr>
                    <td>
                        <select class="form-control" name="service_item_id[]">
                            <option selected disabled>Select Option</option>
                            ${tripServices.map(s => `<option value="${s.id}">${s.name}</option>`).join('')}
                        </select>
                    </td>
                    <td><input class="form-control" placeholder="Quantity Here" name="quantity[]" type="number"></td>
                    <td><textarea class="form-control" placeholder="Notes Here" name="note[]"></textarea></td>
                    <td><a href="#" onclick="deleteTripService(this)" class="badge badge-soft-danger">Delete</a></td>
                </tr>
            `;
            // Append the new row to the table body
            $('.tripservices').append(serviceContainer);
        }

        function deleteTripService(element) {
            // Remove the row from the table when the delete link is clicked
            $(element).closest('tr').remove();
        }


        $(document).ready(function () {
            $("#drivers").change(function () {
                getDriverFleet($(this).val());
            });
        });

        function getDriverFleet(driverId) {
            if (!driverId) return;

            $.ajax({
                url: "{{ route('ajax.get_driver_fleet', ':id') }}".replace(':id', driverId), // Laravel route() usage
                type: "GET",
                dataType: "json",
                success: function (response) {
                    let fleetDropdown = $("#driverFleets");
                    fleetDropdown.empty();
                    // fleetDropdown.append('<option selected disabled>Select Option</option>');

                    if (response.length > 0) {
                        $.each(response, function (index, fleet) {
                            fleetDropdown.append(`<option selected value="${fleet.id}">${fleet.make_model} | ${fleet.reg_no}</option>`);
                        });
                    } else {
                        fleetDropdown.append('<option disabled>No Fleet Assigned To Driver</option>');
                    }
                },
                error: function () {
                    alert("Failed to fetch fleet data.");
                }
            });
        }


    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcsiMXmmvBkKjXRp_v2oAuPefr48qxQ3w&libraries=places">
    </script>
@endpush
