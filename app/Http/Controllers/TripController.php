<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Fleet;
use App\Models\ServiceItem;
use App\Models\Trip;
use App\Models\TripType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['tripServices'] = ServiceItem::all();
        $data['triptypes'] = TripType::all();
        $data['drivers'] = Driver::all();
        $data['fleets'] = Fleet::all();

        return $this->extendedView('trip.index', $data, 'Trips & Safaris');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

            // Commit the transaction
            DB::commit();

            return redirect()
                ->route('trips.index')
                ->with('success', 'Trip created successfully!');

        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'An error occurred while creating the trip: '.$e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['tripServices'] = ServiceItem::all();
        $data['triptypes'] = TripType::all();
        $data['drivers'] = Driver::all();
        $data['fleets'] = Fleet::all();

        return $this->extendedView('trip.create', $data, 'Trips & Safaris');
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
    public function edit($id)
    {
        $data['trip'] = Trip::findOrFail($id);
        $data['tripServices'] = ServiceItem::all();
        $data['triptypes'] = TripType::all();
        $data['drivers'] = Driver::all();
        $data['fleets'] = Fleet::all();

        return $this->extendedView('trip.create', $data, 'Edit Trip');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
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
        ]);

        try {
            $trip = Trip::findOrFail($id);

            $trip->update([
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

            return redirect()
                ->route('trips.index')
                ->with('success', 'Trip updated successfully!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'An error occurred while updating the trip: '.$e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        //
    }
}
