@extends('layouts.app')

@can('create::agent')
    @push('action-buttons')
        <div class="col-auto align-self-center">
            <a href="{{route('accommodations.create')}}" class="btn btn-primary btn-sm">
                <i class="mdi mdi-plus mr-1 icon-xl"></i>
                Add Accommodation
            </a>
        </div>
    @endpush
@endcan

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered mb-0 table-centered table-hover">
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
                                    <td>{{ $loop->iteration }}</td>
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
                                            <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown"
                                               href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                <i class="las la-ellipsis-v font-20 text-muted"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">
                                                <a class="dropdown-item"
                                                   href="{{ route('accommodations.edit', $a->id) }}">Edit</a>
                                                <a class="dropdown-item text-danger"
                                                   href="#"
                                                   onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this accommodation?')) { document.getElementById('delete-form-{{ $a->id }}').submit(); }">Delete</a>
                                                <form id="delete-form-{{ $a->id }}" action="{{ route('accommodations.destroy', $a->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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
