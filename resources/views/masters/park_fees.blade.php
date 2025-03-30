@extends('layouts.app')

@section('css')
<style>
    .form-section {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .form-header {
        border-bottom: 2px solid #0d6efd;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    .required-field::after {
        content: " *";
        color: red;
    }
</style>
@endsection

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
                        <form id="parkFeesForm" action="{{ isset($parkfee) ? route('parkfees.update', $parkfee->id) : route('parkfees.store') }}" 
                            method="POST">
                            @csrf
                            @if (isset($parkfee))
                                @method('PUT')
                            @endif
                            <!-- Park Information Section -->
                            <div class="form-section">
                                <h4 class="form-header">Park Information</h4>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="parkSelect" class="form-label required-field">Park</label>
                                        <select class="form-select form-control" name="fee[national_park_id]" id="parkSelect" required>
                                            <option value="" selected disabled>Select a park</option>
                                            @foreach ($nationalParks as $n )
                                                <option value="{{ $n->id }}">{{ $n->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="seasonSelect" class="form-label required-field">Season</label>
                                        <select class="form-select form-control" name="fee[season_id]" id="seasonSelect" required>
                                            <option selected disabled>Choose</option>
                                            @foreach ($seasons as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Buttons -->
                            <div class="d-flex justify-content-between mt-4 mb-4">
                                <span class="btn btn-dark" onclick="addFee()">
                                    <i class="fas fa-plus me-2"></i> Add Fee
                                </span>
                            </div>

                            <span class="fee-pool">
                                
                            </span>
                            


                            <!-- Special Fee Information (Hidden by default) -->
                            <div class="form-section" id="specialFeeSection" style="display: none;">
                                <h4 class="form-header">Special Fee Details</h4>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="specialFeeName" class="form-label">Special Fee Name</label>
                                        <input type="text" class="form-control" id="specialFeeName">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text" class="form-control" id="location">
                                    </div>
                                    <div class="col-12">
                                        <label for="specialFeeDescription" class="form-label">Description</label>
                                        <textarea class="form-control" id="specialFeeDescription" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Notes -->
                            <div class="hide mb-3">
                                <label for="notes" class="form-label">Additional Notes</label>
                                <textarea class="form-control" id="notes" rows="3"></textarea>
                            </div>

                            <!-- Effective Date -->
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="effectiveDate" class="form-label">Effective Date</label>
                                    <input type="date" class="form-control" name="fee[effectiveDate]" id="effectiveDate">
                                </div>
                            </div>

                            <!-- Form Buttons -->
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Save Fee Data
                                </button>
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
<script>
    // Global variables to store options from the controller
    var feeTypes = [];
    var visitorCategories = [];
    var ageGroups = [];
    var currencies = [];

    // Fetch data from the controller
    function loadFeeData() {
        $.ajax({
            url: '{{ route('parkFeesData') }}', // Update this URL to match your backend route
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                feeTypes = response.feeTypes;
                visitorCategories = response.visitorCategories;
                ageGroups = response.ageGroups;
                currencies = response.currencies;
            },
            error: function () {
                console.error('Failed to load fee data');
            }
        });
    }

    // Call function on page load
    $(document).ready(function () {
        loadFeeData();
    });

    // Function to generate dropdown options dynamically
    function generateDropdownOptions(data) {
        let options = '<option value="" selected disabled>Select an option</option>';
        data.forEach(item => {
            options += `<option value="${item.id}">${item.name}</option>`;
        });
        return options;
    }

    // Function to add a new fee section
    function addFee() {
        let uniqueId = new Date().getTime(); // Unique identifier for IDs

        let row = `
            <div class="form-section single_fee">
                <h4 class="form-header">Fee Information <span onclick="removeRow(this)" class="btn btn-sm btn-danger mb-6 float-right ">Delete</span></h4>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="feeType-${uniqueId}" class="form-label required-field">Fee Type</label>
                        <select class="form-select form-control feeType" name="feeType[]" id="feeType-${uniqueId}" required>
                            ${generateDropdownOptions(feeTypes)}
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="visitorCategory-${uniqueId}" class="form-label required-field">Visitor Category</label>
                        <select class="form-select form-control visitorCategory" name="visitorCategory[]" id="visitorCategory-${uniqueId}" required>
                            ${generateDropdownOptions(visitorCategories)}
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="ageGroup-${uniqueId}" class="form-label required-field">Age Group</label>
                        <select class="form-select form-control ageGroup" name="ageGroup[]" id="ageGroup-${uniqueId}" required>
                            ${generateDropdownOptions(ageGroups)}
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-4">
                        <label for="currency-${uniqueId}" class="form-label required-field">Currency</label>
                        <select class="form-select form-control currency" name="currency[]" id="currency-${uniqueId}" required>
                            ${generateDropdownOptions(currencies)}
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="amount-${uniqueId}" class="form-label required-field">Amount</label>
                        <div class="input-group">
                            <span class="input-group-text currencySymbol">$</span>
                            <input type="number" class="form-control amount" name="amount[]" id="amount-${uniqueId}" step="0.01" min="0" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="vatRate-${uniqueId}" class="form-label">VAT Rate (%)</label>
                        <input type="number" class="form-control vatRate" name="vatRate[]" id="vatRate-${uniqueId}" value="18" min="0" max="100">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-check form-check-primary mb-3">
                            <input class="form-check-input vatInclusive" name="vatInclusive[]" value="1" type="checkbox" id="vatInclusive-${uniqueId}">
                            <label class="form-check-label" for="vatInclusive-${uniqueId}">
                                Price includes VAT
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" name="isOneTimeFee[]" type="checkbox" value="1" id="isOneTimeFee">
                            <label class="form-check-label" for="isOneTimeFee">
                                One-time fee (not daily)
                            </label>
                        </div>
                    </div>

                    <!-- <div class="col-md-6">
                    //     <div class="form-check">
                    //         <input class="form-check-input isSpecialFee" type="checkbox" id="isSpecialFee-${uniqueId}">
                    //         <label class="form-check-label" for="isSpecialFee-${uniqueId}">
                    //             This is a special fee (WMA, etc.)
                    //         </label>
                    //     </div>
                    // </div> -->

                </div>
            </div>`;

        // Append new fee section to .fee_pool
        $('.fee-pool').append(row);
    }

    function removeRow(obj){
        var parent = $(obj).closest('.single_fee');
        parent.remove();
    }


    // Toggle special fee section
    document.getElementById('isSpecialFee').addEventListener('change', function() {
        const specialFeeSection = document.getElementById('specialFeeSection');
        if (this.checked) {
            specialFeeSection.style.display = 'block';
        } else {
            specialFeeSection.style.display = 'none';
        }
    });

    // Update currency symbol when currency changes
    document.getElementById('currency').addEventListener('change', function() {
        const currencySymbol = document.getElementById('currencySymbol');
        if (this.value === '2') { // TZS
            currencySymbol.textContent = 'TZS';
        } else { // USD
            currencySymbol.textContent = 'USD';
        }
    });

    // Form submission handler
    document.getElementById('parkFeesForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Here you would collect the form data and send it to your server
        alert('Form data would be submitted to the server here.');
        // You could use fetch() or AJAX to send the data to your backend
    });
</script>
@endsection