<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Channel;
use App\Models\Country;
use App\Models\PickupDropoffPoint;
use App\Models\ServiceProvider;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class BookingController extends Controller
{
    /**
     * Display a listing of bookings.
     */
    public function index(): View
    {
        $this->authorize('view::booking');

        $data['bookings'] = Booking::query()->latest()->get();
        return $this->extendedView('bookings.index', $data, 'bookings');
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(BookingRequest $request): RedirectResponse
    {
        $this->authorize('create::booking');

        try {
            $data = $request->validated();
            $data['services'] = json_encode($request->services);
            $data['file_owner'] = (string)auth()->id();

            Booking::query()->create($data);

            // Log the successful booking creation
            Log::info('Booking created successfully:', $data);

            return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
        } catch (Exception $e) {
            // Log the actual error for debugging
            Log::error('Booking creation failed: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('flash_error', 'Failed to create booking. Please try again or contact system administrator.');
        }

    }

    /**
     * Show the form for creating a new booking.
     */
    public function create(): View
    {
        $this->authorize('create::booking');

        $data['lastBooking'] = Booking::query()->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(); //Starts zero each month
        $data['title'] = 'Create Booking';
        $data['services'] = [
            'Airport Transfer',
            'Hotel Accommodation',
            'Tour Guide',
            'Car Rental',
            'Meal Plan'
        ];
        $data['pickup_dropoff_points'] = PickupDropoffPoint::all();
        $data['countries'] = Country::all();
        $data['agents'] = ServiceProvider::where('type', 'agent')->get();
        $data['channels'] = Channel::all();
        return $this->extendedView('bookings.create', $data, 'create booking');
    }

    public function show(Booking $booking)
    {
        $title = 'Booking Details';
        return view('bookings.show', compact('booking', 'title'));
    }

    /**
     * Show the form for editing the specified booking.
     */
    public function edit(Booking $booking): View
    {
        $this->authorize('edit::booking');

        $data['booking'] = $booking;
        $data['title'] = 'Edit Booking';
        $data['services'] = [
            'Airport Transfer',
            'Hotel Accommodation',
            'Tour Guide',
            'Car Rental',
            'Meal Plan'
        ];
        $data['pickup_dropoff_points'] = PickupDropoffPoint::all();
        $data['countries'] = Country::all();
        $data['agents'] = ServiceProvider::where('type', 'agent')->get();
        $data['channels'] = Channel::all();
        return $this->extendedView('bookings.edit', $data, 'edit booking');
    }

    /**
     * Update the specified booking in storage.
     */
    public function update(BookingRequest $request, Booking $booking): RedirectResponse
    {
        $this->authorize('edit::booking');

        $data = $request->validated();
        $data['services'] = json_encode($request->services);
        $data['file_owner'] = $data['file_owner'] ?? (string)auth()->id();

        $booking->update($data);
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified booking from storage.
     */
    public function destroy(Booking $booking): RedirectResponse
    {
        $this->authorize('delete::booking');

        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
