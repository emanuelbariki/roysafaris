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
                        <form {{ isset($driver) ? route('drivers.update', $driver->id) : route('drivers.store') }}"
                            method="POST">
                            @csrf
                            @if (isset($driver))
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="driver[name]" placeholder="Full Name" required="" value="{{ isset($driver) ? $driver->name : old('name') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="license_no">License No</label>
                                        <input type="text" class="form-control" id="license_no" name="driver[license_no]" placeholder="license_no" required="" value="{{ isset($driver) ? $driver->license_no : old('license_no') }}">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="useremail">Driver Type</label>
                                        <select name="driver[driver_type_id]" class="form-control">
                                            <option selected disabled>Choose</option>
                                            @foreach ($drivertypes as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="useremail">Fleet</label>
                                        <select name="driver[fleet_id]" class="form-control">
                                            <option selected disabled>Choose</option>
                                            @foreach ($fleets as $d)
                                                <option value="{{ $d->id }}">{{ $d->make_model }} | {{ $d->reg_no }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="number" name="driver[phone]" placeholder="255729898652" id="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="driver[email]" id="email" placeholder="email@example.com" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="useremail">Status</label>
                                        <select name="driver[status]" class="form-control">
                                            <option selected disabled>Choose</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">In Active</option>
                                        </select>
                                        {{-- <input type="email" class="form-control" id="useremail" required=""> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                                    
                                {{-- 
                                    name
                                    license_no
                                    driver_type_id
                                    fleet_id
                                    phone
                                    email
                                    status
                                --}}
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>License No</th>
                                    <th>Driver Type</th>
                                    <th>Fleet</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach ($drivers as $index=>$d )
                                        <tr>
                                            <td>#{{ $index+1 }}</td>
                                            <td>{{ $d->name }}</td>
                                            <td>{{ $d->license_no }}</td>
                                            <td>{{ $d->driverType->name }}</td>
                                            <td>{{ $d->fleet->make_model }}</td>
                                            <td>{{ $d->phone }}</td>
                                            <td>{{ $d->email }}</td>
                                            <td><span class="badge badge-soft-success">{{ $d->status }}</span></td>
                                            <td class="text-right">
                                                <div class="dropdown d-inline-block">
                                                    <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                        <i class="las la-ellipsis-v font-20 text-muted"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
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
        <script src="plugins/apex-charts/apexcharts.min.js"></script>
        <script src="plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>
        <script src="assets/pages/jquery.analytics_dashboard.init.js"></script>
@endsection