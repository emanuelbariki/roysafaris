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
                        <form action="{{ isset($fleet) ? route('fleets.update', $fleet->id) : route('fleets.store') }}" method="POST">
                            @csrf
                            @if (isset($fleet))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="make_model">Make & Model</label>
                                        <input type="text" class="form-control" id="make_model" name="fleet[make_model]" placeholder="Toyota LandCrusier, Toyota Alphard, etc" required="" value="{{ isset($fleet) ? $fleet->make_model : old('make_model') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="reg_no">Registration No</label>
                                        <input type="text" class="form-control" id="reg_no" name="fleet[reg_no]" placeholder="T750 CYM" required="" value="{{ isset($fleet) ? $fleet->reg_no : old('reg_no') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="useremail">Fleet Type</label>
                                        <select name="fleet[fleet_type_id]" class="form-control">
                                            <option selected disabled>Choose</option>
                                            @foreach ($fleettypes as $f)
                                                <option value="{{ $f->id }}">{{ $f->name }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="useremail">Fleet Class</label>
                                        <select name="fleet[fleet_class_id]" class="form-control">
                                            <option selected disabled>Choose</option>
                                            @foreach ( $fleetclasses as $f)
                                                <option value="{{ $f->id }}">{{ $f->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="seats">No. Of Seats</label>
                                        <input type="number" name="fleet[seats]" placeholder="1,2,3 etc..." id="seats" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="purchase_date">Purchase Date</label>
                                        <input type="date" name="fleet[purchase_date]" id="purchase_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mileage">Mileage</label>
                                        <input type="number" name="fleet[mileage]" placeholder="5000,56000, etc..." id="mileage" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="useremail">Status</label>
                                        <select name="fleetclass[status]" class="form-control">
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
                        <p class="text-muted mb-0">Be sure to use <code class="highlighter-rouge">.col-form-label-sm</code> 
                            or <code class="highlighter-rouge">.col-form-label-lg</code> to your <code class="highlighter-rouge">&lt;label&gt;</code>s 
                            or <code class="highlighter-rouge">&lt;legend&gt;</code>s 
                            to correctly follow the size of <code class="highlighter-rouge">.form-control-lg</code> and 
                            <code class="highlighter-rouge">.form-control-sm</code>.
                        </p>
                    </div><!--end card-header-->
                    <div class="card-body">                                    
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 table-centered table-hover">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Fleet Type</th>
                                    <th>Fleet Class</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($fleets as $index => $f)
                                    <tr>
                                        <td># {{ $index+1 }}</td>
                                        <td>{{ $f->make_model }}</td>
                                        <td>{{ $f->fleetType->name }}</td>
                                        <td>{{ $f->fleetClass->name }}</td>
                                        <td><span class="badge badge-soft-success">{{ $f->status }}</span></td>
                                        <td class="text-right">
                                            <div class="dropdown d-inline-block">
                                                <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                    <i class="las la-ellipsis-v font-20 text-muted"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">
                                                    <a class="dropdown-item" href="{{ route('fleets.index', ['edit' => $f->id]) }}">Edit</a>
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

@endsection