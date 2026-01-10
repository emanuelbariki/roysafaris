@php use App\Enums\Nationality; @endphp
@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@can('create::booking')
    @push('action-buttons')
        <div class="col-auto align-self-center">
            <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-sm">
                <i class="mdi mdi-plus mr-1 icon-xl"></i>
                Add Booking
            </a>
        </div>
    @endpush
@endcan

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped dt-responsive table-hover nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Group</th>
                            <th>Nationality</th>
                            <th>Booking Code</th>
                            <th>Arrival</th>
                            <th>Departure</th>
                            @canany(['edit::booking', 'delete::booking'])
                                <th>Actions</th>
                            @endcanany
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->ref }}</td>
                                <td>{{ $booking->group_name }}</td>
                                <td>
                                    @if($booking->nationality)
                                        {{ Nationality::from($booking->nationality)->getName() }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $booking->booking_code }}</td>
                                <td>{{ Carbon::parse($booking->arrival_date)->format('M d, Y') }}</td>
                                <td>{{ Carbon::parse($booking->departure_date)->format('M d, Y') }}</td>
                                @canany(['edit::booking', 'delete::booking'])
                                    <td>
                                        @can('edit::booking')
                                            <a href="{{ route('bookings.edit', $booking) }}"
                                               class="btn btn-primary btn-icon-square-sm"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan

                                        @can('delete::booking')
                                            <form action="{{ route('bookings.destroy', $booking) }}" method="POST"
                                                  style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger btn-icon-square-sm ml-1"
                                                        onclick="return confirm('Are you sure you want to delete this booking?')"
                                                        title="Delete">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                @endcanany
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
