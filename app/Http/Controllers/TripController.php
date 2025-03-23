<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Fleet;
use App\Models\ServiceItem;
use App\Models\Trip;
use App\Models\TripType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tData['title']          = "Trips & Safaris";
        $tData['tripServices']   = ServiceItem::all();
        $tData['triptypes']      = TripType::all();
        $tData['drivers']        = Driver::all();
        $tData['fleets']         = Fleet::all();
        return view('trips.trips', $tData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        dd($request->all());
        // Validate the incoming request data
        $validatedData = $request->validate([
            'trip.name' => 'required|string|max:255',
            'trip.trip_type_id' => 'required|integer',
            'trip.start_date' => 'required|date',
            'trip.end_date' => 'required|date',
            'trip.no_passengers' => 'required|integer',
            'trip.status' => 'required|string',
            'trip.driver_id' => 'required|integer',
            'trip.fleet_id' => 'required|integer',
            'trip.instructions' => 'nullable|string',
            'pickup_location' => 'required|array',
            'dropoff_location' => 'required|array',
            'etd' => 'required|array',
            'eta' => 'required|array',
            'service_item_id' => 'required|array',
            'quantity' => 'required|array',
            'note' => 'nullable|array',
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create the Trip
            $trip = Trip::create([
                'trip_name' => $validatedData['trip']['name'],
                'trip_type_id' => $validatedData['trip']['trip_type_id'],
                'start_date' => $validatedData['trip']['start_date'],
                'end_date' => $validatedData['trip']['end_date'],
                'no_passengers' => $validatedData['trip']['no_passengers'],
                'status' => $validatedData['trip']['status'],
                'driver_id' => $validatedData['trip']['driver_id'],
                'fleet_id' => $validatedData['trip']['fleet_id'],
                'notes' => $validatedData['trip']['instructions'],
            ]);

            // Create TripStops
            foreach ($validatedData['pickup_location'] as $index => $pickupLocation) {
                TripStop::create([
                    'trip_id' => $trip->id,
                    'pickup_location' => $pickupLocation,
                    'dropoff_location' => $validatedData['dropoff_location'][$index],
                    'etd' => $validatedData['etd'][$index],
                    'eta' => $validatedData['eta'][$index],
                    'note' => $validatedData['note'][$index] ?? null,
                ]);
            }

            // Create TripServices
            foreach ($validatedData['service_item_id'] as $index => $serviceItemId) {
                TripService::create([
                    'trip_id' => $trip->id,
                    'service_item_id' => $serviceItemId,
                    'quantity' => $validatedData['quantity'][$index],
                    'note' => $validatedData['note'][$index] ?? null,
                ]);
            }

            // Commit the transaction
            DB::commit();

            return response()->json([
                'message' => 'Trip created successfully!',
                'trip' => $trip,
            ], 201);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            return response()->json([
                'message' => 'An error occurred while creating the trip.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        //
    }
}
