<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use App\Models\Channel;
use App\Models\Country;
use App\Models\PickupDropoffPoint;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Log;

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
        $tData['lastBooking'] = Booking::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(); //Starts zero each month
        $tData['title'] = 'Create Booking';
        $tData['services'] = [
            'Airport Transfer',
            'Hotel Accommodation',
            'Tour Guide',
            'Car Rental',
            'Meal Plan'
        ];
        $tData['pickup_dropoff_points'] = PickupDropoffPoint::all();
        $tData['countries'] = Country::all();
        $tData['agents'] = ServiceProvider::where('type', 'agent')->get();
        $tData['channels'] = Channel::all();
        return view('bookings.create', $tData);
    }

    public function store(Request $request)
    {
        // $data = $request->validated(); // for now
        try {
            $data = $request->all();
            $data['services'] = json_encode($request->services);

            $booking = new Booking();
            $booking->ref   = $data['ref'] ?? null;
            $booking->group_name    = $data['group_name'] ?? null;
            $booking->country_id    = $data['country_id'] ?? 1;
            $booking->remarks       = $data['remarks'] ?? null;
            $booking->file_owner    = $data['file_owner'] ?? null;
            $booking->channel_id    = $data['channel_id'] ?? null;
            $booking->agent_code    = $data['agent_code'] ?? null;
            $booking->booking_code  = $data['booking_code'] ?? null;
            $booking->arrival_date  = $data['arrival_date'] ?? null;
            $booking->pickup_details    = $data['pickup_details'] ?? null;
            $booking->departure_date    = $data['departure_date'] ?? null;
            $booking->drop_details  = $data['drop_details'] ?? null;
            $booking->adults        = $data['adults'] ?? null;
            $booking->children      = $data['children'] ?? null;
            $booking->infants       = $data['infants'] ?? null;
            $booking->rooms         = $data['rooms'] ?? null;
            $booking->services      = json_encode($request->services ?? []);
            $booking->notes         = $data['notes'] ?? null;
            $booking->modified_by   = $data['modified_by'] ?? null;
            $booking->status        = $data['status'] ?? null;
            $booking->booking_status    = $data['booking_status'] ?? "open";
            $booking->status    = "active";
            $booking->save();
            // Log the successful booking creation
            Log::info('Booking created successfully: ', $booking->toArray());
        
            return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
        } catch (\Exception $e) {
            // Log the actual error for debugging
            Log::error('Booking creation failed: ' . $e->getMessage());
        
            // Redirect back with error message
            return redirect()->back()->with('error', 'Failed to create booking. Please try again or contact system administrator.');
        }
        
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
