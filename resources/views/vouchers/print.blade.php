@extends('layouts.app')

@section('content')
<style>
@media print {
    .no-print {
        display: none;
    }
}

.voucher-box {
    border: 1px solid #000;
    padding: 20px;
    font-family: Arial, sans-serif;
    font-size: 14px;
}

.table-bordered td,
.table-bordered th {
    border: 1px solid black !important;
}

.header-title {
    text-align: center;
    font-weight: bold;
    font-size: 20px;
    text-transform: uppercase;
}
</style>

<div class="container mt-3">
    <div class="voucher-box">
        <div class="text-center mb-2">
            <strong>ROY SAFARIS LTD</strong><br>
            2 Serengeti Road, P.O. Box 50 Arusha Tanzania<br>
            Tel: +255 27 2970713/4/5 E-mail: info@roysafaris.co.tz Website: www.roysafaris.co.tz<br>
            <h5 class="mt-2">ACCOMODATION VOUCHER No {{ $voucher->current_version }}</h5>
        </div>

        <table class="table table-sm">
            <tr>
                <td><strong>TO</strong></td>
                <td>{{ $voucher->accommodation->name }}</td>
                <td><strong>BOOKING STATUS</strong></td>
                <td><strong>AMENDMENT</strong></td>
            </tr>
            <tr>
                <td><strong>GUEST NAME</strong></td>
                <td>{{ $voucher->booking->group_name }}</td>
                <td><strong>PRIOR VOUCHER NO</strong></td>
                <td>{{ $voucher->prior_version }}</td>
            </tr>
            <tr>
                <td><strong>ARRIVAL</strong></td>
                <td>{{ $voucher->arrival }}</td>
                <td><strong>DEPARTURE</strong></td>
                <td>{{ $voucher->departure }}</td>
            </tr>
            <tr>
                <td><strong>NIGHTS</strong></td>
                <td>{{ $voucher->nights }}</td>
                <td><strong>ARRIVAL TIME</strong></td>
                <td>{{ $voucher->arrival_time }}</td>
            </tr>
        </table>

        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th colspan="5" class="text-center">PAX</th>
                </tr>
                <tr>
                    <th>Adults</th>
                    <th>Children</th>
                    <th>Juniors</th>
                    <th>Infants</th>
                    <th>Total (Excl. Infants)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $voucher->adults }}</td>
                    <td>{{ $voucher->children }}</td>
                    <td>{{ $voucher->juniors }}</td>
                    <td>{{ $voucher->infants }}</td>
                    <td>{{ $voucher->total_pax }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th colspan="4" class="text-center">ROOM BREAKDOWN</th>
                </tr>
                <tr>
                    <th>Singles</th>
                    <th>Doubles</th>
                    <th>Triples</th>
                    <th>Suites</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $roomCounts['Single'] }}</td>
                    <td>{{ $roomCounts['Double'] }}</td>
                    <td>{{ $roomCounts['Triple'] }}</td>
                    <td>{{ $roomCounts['Suite'] }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Detailed List of Selected Rooms --}}
        @if($selectedRooms->count())
        <p class="fw-bold mt-3">Selected Room Details:</p>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Room Name</th>
                    <th>Room Type</th>
                    <th>Total Pax</th>
                    <th>Price (USD)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($selectedRooms as $index => $room)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $room->name }}</td>
                    <td>{{ $room->room_type }}</td>
                    <td>{{ $room->total_pax }}</td>
                    <td>{{ number_format($room->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <p><strong>Meal Plan:</strong> HALF BOARD</p>

        <p><strong>Comments:</strong><br>
            @php
            $names = explode(' ', $voucher->guest_name);
            @endphp
            1. Mr. {{ ucfirst($names[0]) }}<br>
            2. Ms. {{ ucfirst($names[1] ?? '') }}
        </p>

        <table class="table table-sm">
            <tr>
                <td><strong>Payment By:</strong></td>
                <td>ROY SAFARIS</td>
                <td><strong>Extras Direct By Client:</strong></td>
                <td>YES</td>
            </tr>
            <tr>
                <td><strong>Rate Code:</strong></td>
                <td></td>
                <td><strong>Status:</strong></td>
                <td>{{ ucfirst($voucher->status) }}</td>
            </tr>
        </table>

        <p><strong>Voucher Issued On:</strong>
            {{ \Carbon\Carbon::parse($voucher->voucher_issue_date)->format('d/m/Y') }}<br>
            <strong>Int. Reference:</strong> {{ $voucher->internal_ref }}
        </p>

        <div class="mt-4">
            <div style="border:1px solid #000; padding:10px; width: 250px; text-align: center;">
                <strong>{{ $voucher->property_name }}</strong><br>
                CONFIRMED by: Penis<br>
                Date: {{ now()->format('d/m/y') }}
            </div>
        </div>

        <p class="mt-3"><strong>Spandit</strong><br>ROY SAFARIS</p>

        <div class="no-print mt-4">
            <a href="#" class="btn btn-primary" onclick="window.print()">Print Voucher</a>
        </div>
    </div>
</div>
@endsection