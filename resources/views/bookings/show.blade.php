@extends('layouts.app')

@section('content')
    <h1>Booking Details</h1>
    <p><strong>Name:</strong> {{ $booking->customer_id }}</p>
    <p><strong>Email:</strong> {{ $booking->email }}</p>
    <p><strong>Date:</strong> {{ $booking->booking_date }}</p>
    <p><strong>Status:</strong> {{ $booking->status }}</p>
@endsection
