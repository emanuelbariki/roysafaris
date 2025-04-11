@extends('layouts.app')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Vehicle Type</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Vehicle Type</h4>
                    </div>
                    <div class="card-body">
                        @include('vehicle_types.form', ['action' => route('vehicle-types.store'), 'method' => 'POST'])
                    </div>
                </div>
            </div>
            <!--end card-body-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
</div><!-- container -->
</div><!-- content -->
@endsection