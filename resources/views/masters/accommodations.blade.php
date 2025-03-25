@extends('layouts.app')


@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">{{ $title }}</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">RoySafaris</a></li>
                                <li class="breadcrumb-item active">{{ $title }}</li>
                            </ol>
                        </div><!--end col-->
                        {{-- <div class="col-auto align-self-center">
                            <a href="#" class="btn btn-sm btn-outline-primary" id="Dash_Date">
                                <span class="ay-name" id="Day_Name">Today:</span>&nbsp;
                                <span class="" id="Select_date">Jan 11</span>
                                <i data-feather="calendar" class="align-self-center icon-xs ml-1"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i data-feather="download" class="align-self-center icon-xs"></i>
                            </a>
                        </div><!--end col-->   --}}
                    </div><!--end row-->                                                              
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->
        <!-- end page title end breadcrumb -->
       

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add/Edit Data</h4>
                        <p class="text-muted mb-0 hide">Basic example to demonstrate Bootstrap’s form styles.</p> 
                    </div><!--end card-header-->
                    <div class="card-body">
                        <form action="{{ isset($accommodation) ? route('accommodations.update', $accommodation->id) : route('accommodations.store') }}" 
                            method="POST">
                            @csrf
                            @if (isset($accommodation))
                                @method('PUT')
                            @endif
                        
                            <div class="row">

                                <!-- Coordinates -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="locationSearch">Search on Google</label>
                                        <input type="text" class="form-control" id="locationSearch" placeholder="Enter the Business Name">
                                        <input type="hidden" id="coordinates" name="accommodation[coordinates]">
                                    </div>
                                </div>

                                <!-- Parent Hotel -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hotel_chain_id">Parent Hotel</label>
                                        <select name="accommodation[hotel_chain_id]" class="form-control" required>
                                            <option selected disabled>Choose</option>
                                            <option value="">NULL</option>
                                            @foreach ($hotelChains as $hotel)
                                                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        
                               <!-- Accommodation Name --> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Accommodation Name</label>
                                        <input type="text" 
                                        {{-- onkeyup="generateCode(this)"  --}}
                                        class="form-control" id="name" name="accommodation[name]" placeholder="e.g., Arusha Coffee Lodge" required
                                            value="{{ isset($accommodation) ? $accommodation->name : old('name') }}">
                                    </div>
                                </div>

                                <!-- System Code -->
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="code">System Code</label>
                                        <input type="text" class="form-control" id="code" name="accommodation[code]" placeholder="e.g., ACF" required
                                            value="{{ isset($accommodation) ? $accommodation->code : old('code') }}">
                                    </div>
                                </div> --}}

                        
                                <!-- Accommodation Type -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="accommodations_type_id">Accommodation Type</label>
                                        <select name="accommodation[accommodations_type_id]" class="form-control" required>
                                            <option selected disabled>Choose</option>
                                            @foreach ($accommodationTypes as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        
                                <!-- Address -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="accommodation[address]" placeholder="e.g., 137 Serengeti Rd, Arusha" required
                                            value="{{ isset($accommodation) ? $accommodation->address : old('address') }}">
                                    </div>
                                </div>
                        
                                <!-- City -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="accommodation[city]" placeholder="e.g., Arusha" required 
                                            value="{{ isset($accommodation) ? $accommodation->city : old('city') }}">
                                    </div>
                                </div>
                        
                                <!-- Country -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" id="country" name="accommodation[country]" placeholder="e.g., Tanzania" required 
                                            value="{{ isset($accommodation) ? $accommodation->country : old('country') }}">
                                    </div>
                                </div>
                        
                                <!-- Phone -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="accommodation[phone]" placeholder="e.g., +255729898652" required 
                                            value="{{ isset($accommodation) ? $accommodation->phone : old('phone') }}">
                                    </div>
                                </div>
                        
                                <!-- Email -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="accommodation[email]" placeholder="e.g., info@example.com" required 
                                            value="{{ isset($accommodation) ? $accommodation->email : old('email') }}">
                                    </div>
                                </div>
                        
                                <!-- Website -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="website">Website</label>
                                        <input type="url" class="form-control" id="website" name="accommodation[website]" placeholder="e.g., https://example.com" required 
                                            value="{{ isset($accommodation) ? $accommodation->website : old('website') }}">
                                    </div>
                                </div>
                        
                                <!-- Camping Logistics -->
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="camping_logistics">Camping Logistics</label>
                                        <select name="accommodation[camping_logistics]" class="form-control">
                                            <option selected disabled>Choose</option>
                                            <option value="yes" {{ isset($accommodation) && $accommodation->camping_logistics == 'yes' ? 'selected' : '' }}>Yes</option>
                                            <option value="no" {{ isset($accommodation) && $accommodation->camping_logistics == 'no' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div> --}}
                        
                                <!-- Balloon Pickup -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="balloon_pickup">Balloon Pickup</label>
                                        <select name="accommodation[balloon_pickup]" class="form-control">
                                            <option selected disabled>Choose</option>
                                            <option value="yes" {{ isset($accommodation) && $accommodation->balloon_pickup == 'yes' ? 'selected' : '' }}>Yes</option>
                                            <option value="no" {{ isset($accommodation) && $accommodation->balloon_pickup == 'no' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                        
                                {{-- <!-- Voucher Copies -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="voucher_copies">Voucher Copies</label>
                                        <input type="number" class="form-control" id="voucher_copies" name="accommodation[voucher_copies]" placeholder="Number of copies" 
                                            value="{{ isset($accommodation) ? $accommodation->voucher_copies : old('voucher_copies') }}">
                                    </div>
                                </div> --}}
                        
                                <!-- Pay To -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pay_to">Pay To</label>
                                        <select name="accommodation[pay_to]" class="form-control">
                                            <option selected disabled>Choose</option>
                                            <option value="hotel" {{ isset($accommodation) && $accommodation->pay_to == 'hotel' ? 'selected' : '' }}>Hotel</option>
                                            <option value="chain" {{ isset($accommodation) && $accommodation->pay_to == 'chain' ? 'selected' : '' }}>Chain</option>
                                        </select>
                                    </div>
                                </div>
                        
                                <!-- Billing Currency -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="billing_ccy">Billing Currency</label>
                                        <select name="accommodation[billing_ccy]" class="form-control">
                                            <option selected disabled>Choose</option>
                                            <option value="TZS" {{ isset($accommodation) && $accommodation->billing_ccy == 'TZS' ? 'selected' : '' }}>TZS</option>
                                            <option value="USD" {{ isset($accommodation) && $accommodation->billing_ccy == 'USD' ? 'selected' : '' }}>USD</option>
                                            <option value="EUR" {{ isset($accommodation) && $accommodation->billing_ccy == 'EUR' ? 'selected' : '' }}>EUR</option>
                                            <option value="KSH" {{ isset($accommodation) && $accommodation->billing_ccy == 'KSH' ? 'selected' : '' }}>KSH</option>
                                            <option value="YN" {{ isset($accommodation) && $accommodation->billing_ccy == 'YN' ? 'selected' : '' }}>YN</option>
                                        </select>
                                    </div>
                                </div>


                                <!-- Bank Details -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bank_name">Bank Name</label>
                                        <select name="bank_name" class="form-control">
                                            <option selected>Choose</option>
                                            @foreach ($banks as $b)
                                                <option value="{{ $b['full_name'] }}">{{ $b['full_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                 <!-- Voucher Copies -->
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bank_no">Account No</label>
                                        <input type="text" class="form-control" id="bank_no" name="bank_no" placeholder="Account No" 
                                            value="{{ isset($bank_no) ? $accommodation->bank_no : old('bank_no') }}">
                                    </div>
                                </div>

                        
                                <!-- Submit Button -->
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-primary px-4">Save Data</button>
                                </div>
                            </div>
                        </form>                        
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Horizontal form</h4>
                        <p class="text-muted mb-0">Available Records</p>
                    </div><!--end card-header-->
                    <div class="card-body">                                    
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 table-centered table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Accommodation Name</th>
                                        <th>System Code</th>
                                        <th>Type</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accommodations as $index => $a)
                                        <tr>
                                            <td>#{{ $index + 1 }}</td>
                                            <td>{{ $a->name }}</td>
                                            <td>{{ $a->code }}</td>
                                            <td>{{ $a->accommodationType->name }}</td>
                                            <td>{{ $a->address }}</td>
                                            <td>{{ $a->city }}</td>
                                            <td>{{ $a->phone }}</td>
                                            <td>{{ $a->email }}</td>
                                            <td><span class="badge badge-soft-success">{{ $a->status }}</span></td>
                                            <td class="text-right">
                                                <div class="dropdown d-inline-block">
                                                    <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                        <i class="las la-ellipsis-v font-20 text-muted"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">
                                                        <a class="dropdown-item" href="{{ route('accommodations.index', $a->id) }}">Edit</a>
                                                        <a class="dropdown-item" href="{{ route('accommodations.index', $a->id) }}" onclick="return confirm('Are you sure you want to delete this accommodation?')">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table><!--end /table-->                            
                        </div><!--end /tableresponsive-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->

    </div><!-- container -->

</div>
@endsection


@section('scripts')


    <!-- Google Places API -->
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcsiMXmmvBkKjXRp_v2oAuPefr48qxQ3w&libraries=places"></script> --}}
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcsiMXmmvBkKjXRp_v2oAuPefr48qxQ3w&libraries=places&callback=initAutocomplete"></script>


    <script>
        function initAutocomplete() {
            var input = document.getElementById("locationSearch");
            var autocomplete = new google.maps.places.Autocomplete(input);
    
            // Set fields to retrieve from Places API
            autocomplete.setFields(["place_id", "name", "formatted_address", "geometry", "address_components"]);
    
            autocomplete.addListener("place_changed", function () {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    alert("No location found!");
                    return;
                }
    
                // Extract Address Components
                var address = place.formatted_address || "";
                var name = place.name || "no name";
                var city = getCityFromComponents(place.address_components);
                var lat = place.geometry.location.lat();
                var lng = place.geometry.location.lng();
    
                // Fill in the form fields
                document.getElementById("address").value = address;
                document.getElementById("name").value = name;
                document.getElementById("city").value = city;
                document.getElementById("coordinates").value = lat + "," + lng;
    
                // Fetch more details using Place ID
                fetchPlaceDetails(place.place_id);
            });
        }
    
        function fetchPlaceDetails(placeId) {
            var apiKey = "AIzaSyBcsiMXmmvBkKjXRp_v2oAuPefr48qxQ3w";
            var url = `https://maps.googleapis.com/maps/api/place/details/json?place_id=${placeId}&fields=international_phone_number,website&key=${apiKey}`;
    
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.result) {
                        document.getElementById("phone").value = data.result.international_phone_number || "";
                        document.getElementById("website").value = data.result.website || "";                        
                    }
                })
                .catch(error => console.error("Error fetching place details:", error));
        }
    
        function getCityFromComponents(components) {
            for (var i = 0; i < components.length; i++) {
                if (components[i].types.includes("locality")) {
                    return components[i].long_name;
                }
            }
            return "";
        }
        google.maps.event.addDomListener(window, "load", initAutocomplete);

    </script>
    


    <script>
        // function generateCode(obj) {
        //     let name = $(obj).val().trim();
            
        //     if (name.length > 0) {
        //         // Extract first letter of each word and uppercase it
        //         let code = name
        //             .split(" ") // Split by spaces
        //             .map(word => word.charAt(0).toUpperCase()) // Get first letter and uppercase
        //             .join(""); // Join letters together

        //         $("#code").val(code); // Set the generated code to the input
        //     } else {
        //         $("#code").val(""); // Clear code if name is empty
        //     }
        // }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcsiMXmmvBkKjXRp_v2oAuPefr48qxQ3w&libraries=places"></script>
@endsection