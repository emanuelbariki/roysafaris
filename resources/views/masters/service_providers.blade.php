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
                        <form action="{{ isset($serviceprovider) ? route('serviceproviders.update', $serviceprovider->id) : route('serviceproviders.store') }}" 
                            method="POST">
                          @csrf
                          @if (isset($serviceprovider))
                              @method('PUT')
                          @endif
                      
                          <div class="row">
                              
                              <!-- Company Name -->
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="name">Company Name</label>
                                      <input type="text" class="form-control" id="name" name="serviceprovider[name]" placeholder="Company Name" required 
                                          value="{{ isset($serviceprovider) ? $serviceprovider->name : old('name') }}">
                                  </div>
                              </div>
                      
                              <!-- Code -->
                              {{-- <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="code">Code</label>
                                      <input type="text" class="form-control" id="code" name="serviceprovider[code]" placeholder="Company Code" 
                                          value="{{ isset($serviceprovider) ? $serviceprovider->code : old('code') }}">
                                  </div>
                              </div> --}}
                      
                              <!-- Parent Company -->
                              {{-- <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="parent_company_id">Parent Company</label>
                                      <input type="text" class="form-control" id="parent_company_id" name="serviceprovider[parent_company_id]" placeholder="Parent Company ID" 
                                          value="{{ isset($serviceprovider) ? $serviceprovider->parent_company_id : old('parent_company_id') }}">
                                  </div>
                              </div> --}}
                      
                              <!-- Phone -->
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="phone">Phone</label>
                                      <input type="text" class="form-control" id="phone" name="serviceprovider[phone]" placeholder="e.g., +255729898652" required 
                                          value="{{ isset($serviceprovider) ? $serviceprovider->phone : old('phone') }}">
                                  </div>
                              </div>
                      
                              <!-- Email -->
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="email">Email</label>
                                      <input type="email" class="form-control" id="email" name="serviceprovider[email]" placeholder="e.g., info@example.com" required 
                                          value="{{ isset($serviceprovider) ? $serviceprovider->email : old('email') }}">
                                  </div>
                              </div>
                      
                              <!-- Website -->
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="website">Website</label>
                                      <input type="url" class="form-control" id="website" name="serviceprovider[website]" placeholder="e.g., https://example.com" required 
                                          value="{{ isset($serviceprovider) ? $serviceprovider->website : old('website') }}">
                                  </div>
                              </div>
                      
                              <!-- Address -->
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="address">Address</label>
                                      <input type="text" class="form-control" id="address" name="serviceprovider[address]" placeholder="Company Address" required 
                                          value="{{ isset($serviceprovider) ? $serviceprovider->address : old('address') }}">
                                  </div>
                              </div>
                      
                              <!-- Country -->
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="country_id">Country</label>
                                      <select onchange="loadcities(this)" name="serviceprovider[country_id]" class="form-control">
                                          <option disabled selected>Choose</option>
                                          @foreach ($countries as $c)
                                              <option value="{{ $c->id }}" {{ isset($serviceprovider) && $serviceprovider->country_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>
                      
                              <!-- City -->
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="city_id">City</label>
                                      <select name="serviceprovider[city_id]" class="form-control" id="city">
                                          <option selected disabled>Choose</option>
                                      </select>
                                  </div>
                              </div>
                      
                              <!-- Type -->
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="type">Company Type</label>
                                      <select name="serviceprovider[type]" class="form-control" id="type">
                                        <option selected disabled>Choose</option>
                                        <option value="agent">Agent</option>
                                        <option value="balloon">Balloon Company</option>
                                        <option value="mountain">Mountain Company</option>
                                        <option value="car_hire">Car Hire</option>
                                        <option value="ground_agent">Ground Agent</option>
                                        <option value="activity">Activity Company</option>
                                        <option value="general">General</option>
                                    </select>
                                  </div>
                              </div>
                      
                              {{-- <!-- Voucher Copies -->
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="voucher_copies">Voucher Copies</label>
                                      <input type="number" class="form-control" id="voucher_copies" name="serviceprovider[voucher_copies]" required 
                                          value="{{ isset($serviceprovider) ? $serviceprovider->voucher_copies : old('voucher_copies', 3) }}">
                                  </div>
                              </div> --}}
                      
                              {{-- <!-- Bill To -->
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="bill_to">Bill To</label>
                                      <input type="text" class="form-control" id="bill_to" name="serviceprovider[bill_to]" placeholder="Billing Information" required 
                                          value="{{ isset($serviceprovider) ? $serviceprovider->bill_to : old('bill_to') }}">
                                  </div>
                              </div> --}}

                              
                                <!-- Bank Details -->
                                <div class="col-md-4">
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
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bank_no">Account No</label>
                                        <input type="text" class="form-control" id="bank_no" name="bank_no" placeholder="Account No" 
                                            value="{{ isset($bank_no) ? $carrier->bank_no : old('bank_no') }}">
                                    </div>
                                </div>
                      
                              <!-- Status -->
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="status">Status</label>
                                      <select name="serviceprovider[status]" class="form-control">
                                          <option value="active" {{ isset($serviceprovider) && $serviceprovider->status == 'active' ? 'selected' : '' }}>Active</option>
                                          <option value="inactive" {{ isset($serviceprovider) && $serviceprovider->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                                    <th>name</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($serviceproviders as $index=>$f)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $f->name }}</td>
                                        <td><span class="badge badge-soft-success">{{ $f->status }}</span></td>
                                        <td class="text-right">
                                            <div class="dropdown d-inline-block">
                                                <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                    <i class="las la-ellipsis-v font-20 text-muted"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">
                                                    <a class="dropdown-item" href="{{ route('serviceproviders.index', ['edit' => $f->id]) }}">Edit</a>
                                                    <a class="dropdown-item text-danger" href="{{ route('serviceproviders.index', ['edit' => $f->id]) }}">Delete</a>
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
<script>
    function loadcities(selectElement) {
        var countryId = selectElement.value;
        
        if (!countryId) {
            return;
        }

        $.ajax({
            url: "{{ route('ajax.fetch.cities') }}", // Define the route in Laravel
            type: "GET",
            data: { country_id: countryId },
            success: function(response) {
                var cityDropdown = $("#city");
                cityDropdown.empty(); // Clear existing options
                cityDropdown.append('<option selected disabled>Choose</option>');

                if (response.length > 0) {
                    $.each(response, function(index, city) {
                        cityDropdown.append('<option value="' + city.id + '">' + city.name + '</option>');
                    });
                }
            },
            error: function(xhr) {
                console.error("Error fetching cities:", xhr);
            }
        });
    }
</script>
@endsection