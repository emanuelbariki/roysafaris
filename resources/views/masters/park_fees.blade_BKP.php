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
                        <form action="{{ isset($parkFee) ? route('parkfees.update', $parkFee->id) : route('parkfees.store') }}" method="POST">
                            @csrf
                            @if (isset($parkFee))
                                @method('PUT')
                            @endif
                        
                            <div class="row">
                        
                                <!-- National Park -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="national_park_id">National Park</label>
                                        <select name="park_fee[national_park_id]" class="form-control" required>
                                            <option selected disabled>Choose</option>
                                            @foreach ($nationalParks as $park)
                                                <option value="{{ $park->id }}" {{ isset($parkFee) && $parkFee->national_park_id == $park->id ? 'selected' : '' }}>
                                                    {{ $park->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        
                                <!-- Fee Type -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fee_type_id">Fee Type</label>
                                        <select name="park_fee[fee_type_id]" class="form-control" required>
                                            <option selected disabled>Choose</option>
                                            @foreach ($feeTypes as $type)
                                                <option value="{{ $type->id }}" {{ isset($parkFee) && $parkFee->fee_type_id == $type->id ? 'selected' : '' }}>
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        
                                <!-- Visitor Category -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="visitor_category_id">Visitor Category</label>
                                        <select name="park_fee[visitor_category_id]" class="form-control" required>
                                            <option selected disabled>Choose</option>
                                            @foreach ($visitorCategories as $category)
                                                <option value="{{ $category->id }}" {{ isset($parkFee) && $parkFee->visitor_category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        
                                <!-- Age Group -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="age_group_id">Age Group</label>
                                        <select name="park_fee[age_group_id]" class="form-control" required>
                                            <option selected disabled>Choose</option>
                                            @foreach ($ageGroups as $group)
                                                <option value="{{ $group->id }}" {{ isset($parkFee) && $parkFee->age_group_id == $group->id ? 'selected' : '' }}>
                                                    {{ $group->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        
                                <!-- Season -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="season_id">Season</label>
                                        <select name="park_fee[season_id]" class="form-control" required>
                                            <option selected disabled>Choose</option>
                                            @foreach ($seasons as $season)
                                                <option value="{{ $season->id }}" {{ isset($parkFee) && $parkFee->season_id == $season->id ? 'selected' : '' }}>
                                                    {{ $season->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        
                                <!-- Currency -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="currency_id">Currency</label>
                                        <select name="park_fee[currency_id]" class="form-control" required>
                                            <option selected disabled>Choose</option>
                                            @foreach ($currencies as $currency)
                                                <option value="{{ $currency->id }}" {{ isset($parkFee) && $parkFee->currency_id == $currency->id ? 'selected' : '' }}>
                                                    {{ $currency->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        
                                <!-- Amount -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" step="0.01" class="form-control" id="amount" name="park_fee[amount]" placeholder="Amount in selected currency" required 
                                            value="{{ isset($parkFee) ? $parkFee->amount : old('amount') }}">
                                    </div>
                                </div>
                        
                                <!-- Notes -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="notes">Notes</label>
                                        <textarea class="form-control" id="notes" name="park_fee[notes]" placeholder="Any additional notes">{{ isset($parkFee) ? $parkFee->notes : old('notes') }}</textarea>
                                    </div>
                                </div>
                        
                                <!-- VAT Rate -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vat_rate">VAT Rate (%)</label>
                                        <input type="number" step="0.01" class="form-control" id="vat_rate" name="park_fee[vat_rate]" value="{{ isset($parkFee) ? $parkFee->vat_rate : old('vat_rate', 18.00) }}" required>
                                    </div>
                                </div>
                        
                                <!-- VAT Inclusive -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="is_vat_inclusive">VAT Inclusive</label>
                                        <select name="park_fee[is_vat_inclusive]" class="form-control" required>
                                            <option selected disabled>Choose</option>
                                            <option value="1" {{ isset($parkFee) && $parkFee->is_vat_inclusive == 1 ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ isset($parkFee) && $parkFee->is_vat_inclusive == 0 ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                        
                                <!-- Effective Date -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="effective_date">Effective Date</label>
                                        <input type="date" class="form-control" id="effective_date" name="park_fee[effective_date]" 
                                            value="{{ isset($parkFee) ? $parkFee->effective_date : old('effective_date') }}">
                                    </div>
                                </div>
                        
                                <!-- Status -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="park_fee[status]" class="form-control">
                                            <option value="active" {{ isset($parkFee) && $parkFee->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ isset($parkFee) && $parkFee->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                        
                                <!-- Submit Button -->
                                <div class="col-md-12 text-right">
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
                                        <th>Park</th>
                                        <th>Fee Type</th>
                                        <th>Visitor Category</th>
                                        <th>Age Group</th>
                                        <th>Season</th>
                                        <th>Currency</th>
                                        <th>Amount</th>
                                        <th>Effective Date</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($parkFees as $index => $a)
                                        <tr>
                                            <td>#{{ $index + 1 }}</td>
                                            <td>{{ $a->nationalPark->name }}</td>
                                            <td>{{ $a->feeType->name }}</td>
                                            <td>{{ $a->visitorCategory->name }}</td>
                                            <td>{{ $a->ageGroup->name }}</td>
                                            <td>{{ $a->season->name }}</td>
                                            <td>{{ $a->currency->code }}</td>
                                            <td>{{ $a->amount }}</td>
                                            <td>{{ $a->effective_date }}</td>
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
@endsection