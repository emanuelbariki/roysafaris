<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\DriverType;
use App\Models\Fleet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
        $tData['driver'] = null;
        if ($request->has('edit')) {
            $tData['driver']     = Driver::find($request->edit);
        }

        $tData['drivertypes']    = DriverType::all();
        $tData['fleets']         = Fleet::all();
        $tData['drivers']        = Driver::all();
        $tData['title']          = "Drivers";
        return view('masters.drivers', $tData);
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
        // dd($request->all());
        //
        // Check if the brand already in db
        $driver = $request->driver;
        $exists = exists(Driver::class, array('email'=>$driver['email'], 'license_no'=>$driver['license_no']));
        if (!$exists) {
            try {
                $driver = $request->driver;
                // dd($driver);
                Driver::create($driver);
                return redirect()->route('drivers.index')->with('success', 'Record added successfully!');
            } catch (\Throwable $th) {
                Log::error(message: $th->getMessage());
                return redirect()->route('drivers.index')->with('error', 'An error occurred while adding the car brand.');
            }
        }

        return redirect()->route('drivers.index')->with('error', 'Record already exists!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $Drivers = Driver::findOrFail($id);
        $validatedData = $request->validate([
            'driver.name' => 'required|string|max:255',
        ]);
        $driver = $validatedData['driver'];
        $Drivers->update($driver);
        return redirect()->route('drivers.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        //
    }


    public function Ajax_getDriverFleet($driverId){

        $driver = Driver::findOrFail($driverId);
        $fleets = Fleet::where('id', $driver->fleet_id)->get(); // Fetch assigned car

        return response()->json($fleets);
    }
}
