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
                        <div class="col-auto align-self-center">
                            <a href="#" class="btn btn-sm btn-outline-primary" id="Dash_Date">
                                <span class="ay-name" id="Day_Name">Today:</span>&nbsp;
                                <span class="" id="Select_date">Jan 11</span>
                                <i data-feather="calendar" class="align-self-center icon-xs ml-1"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i data-feather="download" class="align-self-center icon-xs"></i>
                            </a>
                        </div><!--end col-->  
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
                        <form action="{{ isset($nationalpark) ? route('nationalparks.update', $nationalpark->id) : route('nationalparks.store') }}" 
                            method="POST">
                            @csrf
                            @if (isset($nationalpark))
                                @method('PUT')
                            @endif
                        
                            <div class="row">

                                <!-- Coordinates -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="locationSearch">Search on Google</label>
                                        <input type="text" name="nationalpark[google_name]" class="form-control" id="locationSearch" placeholder="Enter the Business Name">
                                        <input type="hidden" id="coordinates" name="nationalpark[coordinates]">
                                    </div>
                                </div>
                        
                               <!-- National Park Name --> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">National Park Name</label>
                                        <input type="text" 
                                        {{-- onkeyup="generateCode(this)"  --}}
                                        class="form-control" id="name" name="nationalpark[name]" placeholder="e.g., Arusha Coffee Lodge" required
                                            value="{{ isset($nationalpark) ? $nationalpark->name : old('name') }}">
                                    </div>
                                </div>
                        
                                <!-- Address -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="e.g., 137 Serengeti Rd, Arusha" required
                                            value="{{ isset($nationalpark) ? $nationalpark->address : old('address') }}">
                                    </div>
                                </div>
                        
                                <!-- City -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="regulator">Regulator</label>
                                        <input type="text" class="form-control" id="regulator" name="nationalpark[regulator]" placeholder="e.g., TANAPA, GCA, etc" required 
                                            value="{{ isset($nationalpark) ? $nationalpark->regulator : old('regulator') }}">
                                    </div>
                                </div>
                        
                                <!-- Country -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <select onchange="loadcities(this)" class="form-control" name="nationalpark[country_id]" id="country">
                                            <option selected disabled>Choose</option>
                                            @foreach ($countries as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        
                                <!-- City -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city_id">City</label>
                                        <select name="nationalpark[city_id]" class="form-control" id="city">
                                            <option selected disabled>Choose</option>
                                        </select>
                                    </div>
                                </div>

                                
                                <!-- Status -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="nationalpark[status]" class="form-control">
                                            <option value="active" {{ isset($nationalpark) && $nationalpark->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ isset($nationalpark) && $nationalpark->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
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
                                        <th>National Park Name</th>
                                        <th>System Code</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nationalparks as $index => $a)
                                        <tr>
                                            <td>#{{ $index + 1 }}</td>
                                            <td>{{ $a->name }}</td>
                                            <td>{{ $a->code }}</td>
                                            <td><span class="badge badge-soft-success">{{ $a->status }}</span></td>
                                            <td class="text-right">
                                                <div class="dropdown d-inline-block">
                                                    <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                        <i class="las la-ellipsis-v font-20 text-muted"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">
                                                        <a class="dropdown-item" href="{{ route('nationalparks.index', $a->id) }}">Edit</a>
                                                        <a class="dropdown-item" href="{{ route('nationalparks.index', $a->id) }}" onclick="return confirm('Are you sure you want to delete this nationalpark?')">Delete</a>
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