<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    public function index()
    {
        
        $bookings = Booking::latest()->paginate(10);
        $title = 'Bookings';
        return view('bookings.index', compact('bookings', 'title'));
    }

    public function create()
    {
        return view('bookings.create', [
            'title' => 'Create Booking',
        ]);
    }

    public function store(BookingRequest $request)
    {
        $data = $request->validated();
        $data['services'] = json_encode($request->services);

        Booking::create($data);
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function show(Booking $booking)
    {
        $title = 'Booking Details';
        return view('bookings.show', compact('booking','title'));
    }

    public function edit(Booking $booking)
    {
        $title = 'Edit Booking';
        return view('bookings.edit', compact('booking', 'title'));
    }

    public function update(BookingRequest $request, Booking $booking)
    {
        $data = $request->validated();
        $data['services'] = json_encode($request->services);

        $booking->update($data);
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
