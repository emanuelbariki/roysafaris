<?php

namespace App\Http\Controllers;

use App\Models\FleetClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FleetClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $tData['fleetclass'] = null;
        if ($request->has('edit')) {
            $tData['fleetclass'] = FleetClass::find($request->edit);
        }
        $tData['fleetclasses'] = FleetClass::all();

        $tData['title'] = "Fleet Classs";
        return view('masters.fleet_classes', $tData);
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
        // Check if the brand already in db
        $exists = exists(FleetClass::class, $request->fleetclass);
        if (!$exists) {
            try {
                $fleetclass = $request->fleetclass;
                FleetClass::create($fleetclass);
                return redirect()->route('fleetclasses.index')->with('success', 'Record added successfully!');
            } catch (\Throwable $th) {
                Log::error(message: $th->getMessage());
                return redirect()->route('fleetclasses.index')->with('error', 'An error occurred while adding the car brand.');
            }
        }

        return redirect()->route('fleetclasses.index')->with('error', 'Record already exists!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FleetClass $fleetClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FleetClass $fleetClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $FleetClasses = FleetClass::findOrFail($id);
        
        $validatedData = $request->validate([
            'fleetclass.name' => 'required|string|max:255',
        ]);

        $fleetclass = $validatedData['fleetclass'];
        // $fleetclass['modified_by'] = Auth::id();

        $FleetClasses->update($fleetclass);

        return redirect()->route('fleetclasses.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FleetClass $fleetClass)
    {
        //
    }
}
