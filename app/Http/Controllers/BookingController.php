<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use App\Models\Channel;
use App\Models\Country;
use App\Models\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'countries' => Country::all(),
            'channels' => Channel::all(),
            'agents' => ServiceProvider::where('type','agent')->get(),
            'booking_id' => Booking::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count() //Starts zero each month
        ]);
    }

    public function store(BookingRequest $request)
    {
        $data = $request->validated();
        // $data['services'] = json_encode($request->services);
        $data['file_owner']          = Auth::user()->id;
        $data['arrival_date']        = Carbon::parse($data['arrival_date'])->format('Y-m-d H:i:s');
        $data['departure_date']      = Carbon::parse($data['departure_date'])->format('Y-m-d H:i:s');
        $data['booking_status']      = "open";
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
