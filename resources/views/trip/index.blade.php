@extends('layouts.app')

@push('action-buttons')
    <div class="col-auto align-self-center">
        <a href="{{ route('trips.create') }}" class="btn btn-primary btn-sm">
            <i class="mdi mdi-plus mr-1 icon-xl"></i>
            Add Trip
        </a>
    </div>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    Trip table
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush

@push('scripts')
    <script>
        var dataTable;

        $(document).ready(function () {
            dataTable = $('#datatable').DataTable();
        });
    </script>
@endpush
