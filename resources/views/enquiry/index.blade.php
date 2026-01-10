@extends('layouts.app')

@can('create::enquiry')
    @push('action-buttons')
        <div class="col-auto align-self-center">
            <a href="{{ route('enquiries.create') }}" class="btn btn-primary btn-sm">
                <i class="mdi mdi-plus mr-1 icon-xl"></i>
                Add Enquiry
            </a>
        </div>
    @endpush
@endcan

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($enquiries as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->first_name . ' ' .$item->last_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>
                                    @canany(['edit::enquiry', 'delete::enquiry'])
                                        @can('edit::enquiry')
                                            <a href="{{ route('enquiries.edit', $item->id) }}"
                                               class="btn btn-primary btn-icon-square-sm"
                                               title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endcan

                                        @can('delete::enquiry')
                                            <form action="{{ route('enquiries.destroy', $item->id) }}" method="POST"
                                                  style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger btn-icon-square-sm"
                                                        onclick="return confirm('Are you sure you want to delete enquiry?')"
                                                        title="Delete">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    @endcanany
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
